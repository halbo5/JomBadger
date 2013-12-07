<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');



class JomBadgerViewmybadges extends JViewLegacy
{
	

	
	function display($tpl = null)
	{
		$model =& $this->getModel();
		
		$document = JFactory::getDocument();
		$document->addStyleSheet('components/com_jombadger/openbadges.css');
     	$user	= JFactory::getUser();
		$mail = $user->email;
        		
		//$path=JURI::base();
		//$app=&JFactory::getApplication('site');
        //$params = &$app->getParams('com_muzeededi');	
		//$titre_page=$params->get('titre_page');
		
		
		//var_dump($results);exit;
		
		$this->badgesvalidated=$model->getBadgesValidated($mail);
		$this->badgesissued=$model->getBadgesIssued($mail);
		//$this->categories=$model->getCategories();
		$this->userid=$model->getUserId();		
		
		parent::display($tpl);
	}
}
