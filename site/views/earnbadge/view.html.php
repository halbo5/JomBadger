<?php
/**
 * @package   JomBadger
 * @subpackage Components
 * components/com_openbadges/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the JomBadger Component : view when earning a badge
 * Test if badge is validated and sends to mozilla's backpack
 */

class JomBadgerViewearnbadge extends JView
{
	

	
	function display($tpl = null)
	{
		//variables initialization
		$model =& $this->getModel();
		$db = $model->connectDB();
		$userid = $model->getUserId();
		$user =& JFactory::getUser();
		$badgeRecipientName=$user->name;
        $badgeRecipientEmail=$user->email;
		$date = date('Y-m-d');
		$lang =& JFactory::getLanguage();
		$this->langtag=$lang->getTag();
		$this->langtag=str_replace("-","_",$this->langtag);
		
		//Parameters
		$path=JURI::base();
		$app=&JFactory::getApplication('site');
        $params = &$app->getParams('com_jombadger');	  
        $input = $app->input;
        $this->appid=$params->getValue('appid');
		$apiurl=$params->get('apiurl');
        if (!$apiurl){$apiurl="http://beta.openbadges.org/issuer.js";}
        
		//adding some css and javascript
        $document = JFactory::getDocument();
		$document->addStyleSheet('components/com_jombadger/openbadges.css');
		//insert javascript facebook plugin for jquery
		$jq=$model->jqFBplugin($this->langtag);
		$document->addScriptDeclaration($jq);
		//add last version of jquery
		$document->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js");    
        
		//we look for badge's datas
		$this->badge = ($this->get('badge'))?$this->get('badge'):"";
		$evidence=$input->get('evidence');
		$evidence=isset($evidence)?$evidence:"";
		$id_record=$input->getInt('id_record');
		$id_record=isset($id_record)?$id_record:"";//is set when we come from mybadges page
		
		$date = date('Y-m-d');
		$salt=$model->rand_string(8);
		$hashed_email = hash('sha256', $badgeRecipientEmail  . $salt);
		$record=array();
		$record['recipient']="sha256$".$hashed_email;
		$record['salt']=$salt;
		$record['earneremail']=$badgeRecipientEmail;
		$record['evidence']=$evidence;
		$record['earnername']=$badgeRecipientName;
		$record['badgeversion']=$params->get('version');
		$record['badgename']=$this->badge->name;
		$record['badgeimage']=$this->badge->image;
		$record['badgedescription']=$this->badge->description;
		$record['badgecriteria']=$this->badge->criteria_url;
		$record['badgeexpires']=$this->badge->expires;
		$record['badgeissuedon']=$date;
		$record['badgeissuerorigin']=$params->get('issuerurl');
		$record['badgeissuername']=$params->get('issuername');
		$record['badgeissuerorg']=$params->get('issuerorg');
		$record['badgeissuercontact']=$params->get('issuercontact');
		
							
		//test if badge is validated for current user
		if ($badgeRecipientEmail!="")
			{
			$validated = $model->getValidated($db,$badgeRecipientEmail,$id_record);
			}
		else {$validated=0;}
		if ($validated>0)
			{
				//action to win badge is validated
				
				//store result of badge won in ob_records table
				
				//first we test if badge is not already recorded for this user
				$verif=$model->verifBadge($db,$record);
				
				if ($verif=="" && $id_record=="")
					{//if function does not return value, record does not exist
					$store=$model->storeBadge($record);
					}
				else {
					$id_record=($id_record!="")?$id_record:$verif;
					
					$store=1;//we affect something to $store so badge is considered valid in default.php
				}
				if ($store)
					{
						//delete proof of action validated in jb_validated
						//var_dump($db->insertid());var_dump($id_record);
						$id_record=($id_record)?$id_record:$db->insertid();
						$delete_validated=$model->deleteValidated($db,$badgeRecipientEmail);
						
						//var_dump($id_record);echo "<br>";
						
						$recordedBadgeUrl=$path."index.php?option=com_jombadger&view=earnbadge&debug=true&format=json&id=".$id_record;
						
						//var_dump($recordedBadgeUrl);
						
						$javascript=$model->createJavascript($id_record,$recordedBadgeUrl,$this->badge->name,$badgeRecipientName);
						$document->addScript($apiurl);
						$document->addScriptDeclaration($javascript);		
					}
	
		
			}
		else {
			//badge cannot be issued
			$validated="0";
			}
		
		
		$this->assignRef( 'verif', $verif );
		$this->assignRef( 'validated', $validated );
		$this->assignRef( 'id_record', $id_record );
		$this->assignRef( 'store', $store );
		$this->assignRef( 'userid', $userid );
		$this->assignRef( 'criteria_url', $this->badge->criteria_url );
		/*
		$this->assignRef( 'couleur_bordure', $couleur_bordure );
		$this->assignRef( 'couleur_fond', $couleur_fond );
		$this->assignRef( 'pub_developpeur', $pub_developpeur );
		$this->assignRef( 'connecte', $connecte );
		*/
		
		parent::display($tpl);
	}
}
