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

class JomBadgerViewobjectives extends JViewLegacy
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
		
		$this->countarticles=$params->get('countarticles');
		$this->numberarticles=$params->get('numberarticles');
		$this->articlesbadge=$model->getGoalId();
		
		$userid = $model->getUserId();
		
		$date = date('Y-m-d');
		$lang =& JFactory::getLanguage();
		$this->langtag=$lang->getTag();
		$this->langtag=str_replace("-","_",$this->langtag);
        
        //adding some css and javascript
        $document = JFactory::getDocument();
		$document->addStyleSheet('components/com_jombadger/openbadges.css');
		
		//add latest version of jquery
		//$document->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js");    
        
		
		
		
			
		//test if counting articles objective is activated
		if ($this->countarticles==1)
			{
				$num_articles = $model->getUserArticlesCount($db,$userid);
				
				
				
				}
		
		$this->assignRef( 'userid', $userid );
		$this->assignRef( 'num_articles', $num_articles);
		$this->assignRef( 'count_articles', $this->countarticles);
		$this->assignRef( 'number_articles', $this->numberarticles);
		$this->assignRef( 'articlesbadge', $this->articlesbadge);
		
		parent::display($tpl);
	}
}
