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



class openbadgesViewbadge extends JView
{
	
	protected $form;
	protected $item;
	protected $script;
	protected $canDo;
	
	function display($tpl = null)
{
    //get the badge
    $item        =& $this->get('Item');
    //get the form fields
    $form = $this->get('Form');
    //add javascript to validate forms
    $script = $this->get('Script');
     
    $this->form=$form;
    $this->item=$item;
    $this->script = $script;
    
    // What Access Rights does this user have? What can (s)he do?
	$this->canDo = OpenBadgesHelper::getActions($this->item->id_badge);
    
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
	$isNew = ($this->item->id_badge == 0);
	
    JToolBarHelper::title($isNew ?   JText::_( 'COM_OPENBADGES_TITLE_BADGE_NEW' )
    							:JText::_( 'COM_OPENBADGES_TITLE_BADGE_EDIT'),'openbadges');
    if ($isNew)
    {
    	//for new records, check the create permission
    	if ($this->canDo->get('core.create'))
    	{
    		JToolBarHelper::apply('badge.apply', 'JTOOLBAR_APPLY');
    		JToolBarHelper::save('badge.save', 'JTOOLBAR_SAVE');
    	}	
    	JToolBarHelper::cancel('badge.cancel', 'JTOOLBAR_CANCEL');
    }
    else {
    	if ($this->canDo->get('core.edit'))
			{	
				// We can save the record
				JToolBarHelper::apply('badge.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('badge.save', 'JTOOLBAR_SAVE');
			}
		if ($this->canDo->get('core.create')) 
			{
				JToolBarHelper::custom('badge.save2copy', 'save-copy.png', 'save-copy_f2.png',
				                       'JTOOLBAR_SAVE_AS_COPY', false);
			}
		JToolBarHelper::cancel('badge.cancel', 'JTOOLBAR_CLOSE');
    }				
    
}

protected function setDocument() 
	{
		$isNew = ($this->item->id_badge < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_OPENBADGES_BADGE_CREATING')
		                           : JText::_('COM_OPENBADGES_BADGE_EDITING'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_openbadges"
		                                  . "/views/badge/submitbutton.js");
		JText::script('COM_OPENBADGES_BADGE_ERROR_UNACCEPTABLE');                          
	}


}