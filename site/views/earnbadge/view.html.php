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

class JomBadgerViewearnbadge extends JViewLegacy
{
	

	
	function display($tpl = null)
	{
		//variables initialization
		$model =& $this->getModel();
		$db = $model->connectDB();
		
		//Parameters
		$path=JURI::base();
		$app=&JFactory::getApplication('site');
		$params = &$app->getParams('com_jombadger');
		$input = $app->input;
		$store=$input->get('store',''); //store is set if page is loaded after submitting form for changing name or email
		$validated=$input->get('validated','');//validated is set if page is loaded after submitting form for changing name or email
		$submit=$input->get('submit','');//$submit n'est pas vide si le formulaire  a été validé
		
		$userid = $model->getUserId();
		if ($userid>0 && $submit=='')
			{
			//mail and name are from connected user
			$user =& JFactory::getUser();
			$badgeRecipientName=$user->name;
        	$badgeRecipientEmail=$user->email;
			}
		else {
			//mail and name are given in url
			$badgeRecipientName=$input->get('name','','string');
			$badgeRecipientEmail=$input->get('email','','string');
		}
		$date = date('Y-m-d');
		$lang =& JFactory::getLanguage();
		$this->langtag=$lang->getTag();
		$this->langtag=str_replace("-","_",$this->langtag);
        
        $this->appid=$params->get('appid');
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
		$evidence=isset($evidence)?$evidence:"";//TODO : seems $evidence is always empty ! Where is the evidence url created ?
		$id_record=$input->getInt('id_record');
		$id_record=isset($id_record)?$id_record:"";//is set when we come from mybadges page
		
		
		if ($submit!="")
		{
		//creating record
		$date = date('c');
		$salt=$model->rand_string(8);
		$hashed_email = hash('sha256', $badgeRecipientEmail  . $salt);
		$record=array();
		$record['uid']=uniqid();
		$record['identity']="sha256$".$hashed_email;
		$record['identity_type']="email";
		$record['salt']=$salt;
		$record['earneremail']=$badgeRecipientEmail;
		$record['evidence']=$evidence;
		$record['earnername']=$badgeRecipientName;
		$record['badgeid']=$this->badge->id_badge;
		//$record['badgeversion']=$params->get('version');
		//$record['badgename']=$this->badge->name;
		//$record['badgeimage']=$this->badge->image;
		//$record['badgedescription']=$this->badge->description;
		//$record['badgecriteria']=$this->badge->criteria_url;
		$record['badgeexpires']=$this->badge->expires;
		$record['badgeissuedon']=$date;
		//$record['badgeissuerorigin']=$params->get('issuerurl');
		//$record['badgeissuername']=$params->get('issuername');
		//$record['badgeissuerorg']=$params->get('issuerorg');
		//$record['badgeissuercontact']=$params->get('issuercontact');
		$record['verify_type']="hosted";//TODO : could also be signed
		//$record['verify_url']="";
		}
							
		//test if badge is validated for current user or user given in url
		if ($validated=="")
			{
			if ($badgeRecipientEmail!="")
				{
				$validated = $model->getValidated($db,$badgeRecipientEmail,$id_record);
				}
			//else {$validated=0;}
			}
		if ($validated>0 && $submit!='')
			{
				//action to win badge is validated and form has been submitted
				
				//store result of badge won in jb_records table
				
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
						$id_record=($id_record)?$id_record:$store;
						$delete_validated=$model->deleteValidated($db,$badgeRecipientEmail);
						
						$recordedBadgeUrl=$path."index.php?option=com_jombadger&view=earnbadge&debug=true&format=json&id_record=".$id_record;
						
						$javascript=$model->createJavascript($id_record,$recordedBadgeUrl,$this->badge->name,$badgeRecipientName);
						$document->addScript($apiurl);
						$document->addScriptDeclaration($javascript);		
					}
	
		
			}
	
		
		
		$this->assignRef( 'verif', $verif );
		$this->assignRef( 'validated', $validated );
		$this->assignRef( 'id_record', $id_record );
		$this->assignRef( 'store', $store );
		$this->assignRef( 'userid', $userid );
		$this->assignRef( 'badgeRecipientEmail', $badgeRecipientEmail );
		$this->assignRef( 'badgeRecipientName', $badgeRecipientName );
		$this->assignRef( 'badgeid', $this->badge->id_badge );
		$this->assignRef( 'criteria_url', $this->badge->criteria_url );
		$this->assignRef( 'submit', $submit );
		
		parent::display($tpl);
	}
}
