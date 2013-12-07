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



class JomBadgerViewmybadge extends JViewLegacy
{
	
	
	protected $canDo;
	
	function display($tpl = null)
{
    
    $component = &JComponentHelper::getComponent('com_jombadger');
	$params = new JRegistry;
    $params->loadString($component->params);
	
    
	$model=$this->getModel();
	$testBadge=$model->testBadge($params);
	
	$this->testBadge=$testBadge;
	JombadgerHelper::addSubmenu('jombadger');
	
    // What Access Rights does this user have? What can (s)he do?
	$this->canDo = JomBadgerHelper::getActions();
    
    $this->addToolBar();
    $this->sidebar = JHtmlSidebar::render();
 
    parent::display($tpl);
    
    // Set the document
	$this->setDocument();
    
	
}

protected function addToolBar()
{
	$input = JFactory::getApplication()->input;
	$input->set('hidemainmenu', false);
	$user = JFactory::getUser();
	$userId = $user->id;
	
    JToolBarHelper::title(JText::_( 'COM_JOMBADGER_TITLE_MYBADGE' ),'jombadger');
    
    	//for new records, check the create permission
    	if ($this->canDo->get('core.create'))
    	{
    		//TODO
    	}
    	JToolBarHelper::help( 'screen.openbadges',true );
		JToolBarHelper::cancel('badge.cancel', 'JTOOLBAR_CLOSE');
   						
    
}

protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JOMBADGER_TITLE_MYBADGE')); 
		$document->addStyleSheet('components/com_jombadger/openbadges.css');                      
	}


}