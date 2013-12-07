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


class JomBadgerViewissued extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $canDo;
	
	function display($tpl = null)
{
	$model =& $this->getModel();
	$userid = $model->getUserId();

	$this->items=$this->get('Items');
	$this->pagination = $this->get('Pagination');
	//filter
	$this->state		= $this->get('State');
	
	JombadgerHelper::addSubmenu('jombadger');
	
    $this->assignRef('userid', $userid);
    // What Access Rights does this user have? What can (s)he do?
	$this->canDo = JomBadgerHelper::getActions();
	
	//$this->languages=$model->languages();
  
    // Set the toolbar
	$this->addToolBar();
	$this->sidebar = JHtmlSidebar::render();
    
    parent::display($tpl);
    
	// Set the document
	$this->setDocument();
}

protected function addToolBar() 
	{
		//creates the toolbar
		JToolBarHelper::title( JText::_('COM_JOMBADGER_TITLE_ISSUED'),'jombadger');
    	
    	if ($this->canDo->get('core.admin'))
    	{
    		JToolBarHelper::preferences( 'com_jombadger','500','600' );
    	}
    	JToolBarHelper::help( 'screen.openbadges',true );
	}
	
protected function setDocument() 
	{
		//set the title in the browser
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JOMBADGER_ISSUED_BROWSERTITLE'));
	}

}