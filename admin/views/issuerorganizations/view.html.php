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


class JomBadgerViewissuerorganizations extends JViewLegacy
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
	
    $this->assignRef('userid', $userid);
    
    JombadgerHelper::addSubmenu('jombadger');
    
    // What Access Rights does this user have? What can (s)he do?
	$this->canDo = JomBadgerHelper::getActions();
  
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
		JToolBarHelper::title( JText::_('COM_JOMBADGER_TITLE_ISSUERORGANIZATIONS'),'jombadger');
		if ($this->canDo->get('core.create'))
			{
			JToolBarHelper::addNew('issuerorganization.add');
			}
    	if ($this->canDo->get('core.delete')) 
    		{
			JToolBarHelper::deleteList('','issuerorganizations.delete');
    		}
		if ($this->canDo->get('core.edit')) 
    		{
    		JToolBarHelper::editList('issuerorganization.edit');
    		}
    	
    	if ($this->canDo->get('core.admin'))
    		{
    		JToolBarHelper::divider();
    		JToolBarHelper::preferences( 'com_jombadger','500','600' );
    		}
    	JToolBarHelper::help( 'screen.issuerorganizations',true );
	}
	
protected function setDocument() 
	{
		//set the title in the browser
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JOMBADGER_BROWSERTITLE'));
	}

}