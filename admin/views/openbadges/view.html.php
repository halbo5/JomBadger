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
		
		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
		
		JToolBarHelper::title( JText::_('COM_JOMBADGER_TITLE_BADGES'),'jombadger');
		if ($this->canDo->get('core.create'))
		{
			JToolBarHelper::addNew('badge.add');
		}
    	if ($this->canDo->get('core.delete')) 
    	{
			JToolBarHelper::deleteList('','openbadges.delete');
    	}
		if ($this->canDo->get('core.edit')) 
    	{
    		JToolBarHelper::editList('badge.edit');
    	}
    	if ($this->canDo->get('core.edit.state')) {
    	
    		JToolbarHelper::publish('openbadges.publish', 'JTOOLBAR_PUBLISH', true);
    		JToolbarHelper::unpublish('openbadges.unpublish', 'JTOOLBAR_UNPUBLISH', true);
    	}
    	if ($this->canDo->get('core.admin'))
    	{
    		JToolBarHelper::divider();
    		JToolBarHelper::preferences( 'com_jombadger','500','600' );
    	}
    	JToolBarHelper::help( 'screen.openbadges',true );
    	
    	/*JHtmlSidebar::setAction('index.php?option=com_jombadger&view=openbadges');
    	
    	JHtmlSidebar::addFilter(
    	JText::_('JOPTION_SELECT_PUBLISHED'),
    	'filter_state',
    	JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
    	);
    	
    	JHtmlSidebar::addFilter(
    	JText::_('JOPTION_SELECT_CATEGORY'),
    	'filter_category_id',
    	JHtml::_('select.options', JHtml::_('category.options', 'com_jombadger'), 'value', 'text', $this->state->get('filter.category_id'))
    	);
    	
    	JHtmlSidebar::addFilter(
    	JText::_('JOPTION_SELECT_ACCESS'),
    	'filter_access',
    	JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'))
    	);
    	
    	JHtmlSidebar::addFilter(
    	JText::_('JOPTION_SELECT_LANGUAGE'),
    	'filter_language',
    	JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'))
    	);
    	
    	JHtmlSidebar::addFilter(
    	JText::_('JOPTION_SELECT_TAG'),
    	'filter_tag',
    	JHtml::_('select.options', JHtml::_('tag.options', true, true), 'value', 'text', $this->state->get('filter.tag'))
    	);*/
    	
	}
	
protected function setDocument() 
	{
		//set the title in the browser
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JOMBADGER_BROWSERTITLE'));
	}

}