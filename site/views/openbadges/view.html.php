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



class JomBadgerViewopenbadges extends JViewLegacy
{
	

	
	function display($tpl = null)
	{
		$model =& $this->getModel();
		
		$document = JFactory::getDocument();
		$document->addStyleSheet('components/com_jombadger/openbadges.css');
		
		$this->badges=$model->getBadges();
		$this->categories=$model->getCategories();
		$this->userid=$model->getUserId();		
		
		parent::display($tpl);
	}
}
