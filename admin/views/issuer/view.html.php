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



class JomBadgerViewissuer extends JView
{
	
	protected $form;
	protected $script;
	protected $canDo;
	
	function display($tpl = null)
{
    //get the form fields
    $form = $this->get('Form');
    //add javascript to validate forms
    $script = $this->get('Script');
     
    $this->form=$form;
    $this->script = $script;
    
    // What Access Rights does this user have? What can (s)he do?
	$this->canDo = JomBadgerHelper::getActions();
    
    $this->addToolBar();
 
    parent::display($tpl);
    
    // Set the document
	$this->setDocument();
    
	
}

protected function addToolBar()
{
	$input = JFactory::getApplication()->input;
	$input->set('hidemainmenu', true);
	$user = JFactory::getUser();
	$userId = $user->id;
		
    JToolBarHelper::title(JText::_( 'COM_JOMBADGER_ISSUER_TITLE' ),'jombadger');
    //check the create permission
    	if ($this->canDo->get('core.create'))
    	{
    		JToolBarHelper::apply('issuer.apply', 'JTOOLBAR_APPLY');
    		JToolBarHelper::save('issuer.save', 'JTOOLBAR_SAVE');
    	}	
    	JToolBarHelper::cancel('issuer.cancel', 'JTOOLBAR_CLOSE');
    
}

protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JOMBADGER_ISSUER_TITLE'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_jombadger"
		                                  . "/views/badge/submitbutton.js");
		JText::script('COM_JOMBADGER_BADGE_ERROR_UNACCEPTABLE');                          
	}


}