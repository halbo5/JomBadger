<?php
/**
 * @package   openbadges
 * @subpackage Components
 * components/com_openbadges/openbadges.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');



class openbadgesViewopenbadges extends JView
{
	

	
	function display($tpl = null)
	{
		$model =& $this->getModel();
		
		$document = JFactory::getDocument();
		$document->addStyleSheet('components/com_openbadges/openbadges.css');
     
        		
		//$path=JURI::base();
		//$app=&JFactory::getApplication('site');
        //$params = &$app->getParams('com_muzeededi');	
		//$titre_page=$params->get('titre_page');
		
		
		//var_dump($results);exit;
		
		$this->badges=$model->getBadges();
		$this->categories=$model->getCategories();
		$this->userid=$model->getUserId();		
		
		parent::display($tpl);
	}
}
