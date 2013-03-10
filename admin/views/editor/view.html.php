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


class JomBadgerVieweditor extends JViewLegacy
{
	
	function display($tpl = null) 
	{
		
		$app =& JFactory::getApplication();		
		$model =& $this->getModel();
		$this->userid = $model->getUserId();
		$this->canDo = JomBadgerHelper::getActions();
		
		$params   = JComponentHelper::getParams('com_languages');
  		$this->curlang =$params->get('site', 'en-GB');
  		$this->operr = JRequest::getVar( 'op',0);
  		$this->openlang = JRequest::getVar( 'lang');
  		$this->openfile = JRequest::getVar( 'mfile');
  		$this->selfile = JRequest::getVar('mfile');
		$this->sellang = JRequest::getVar('lang');
		if ($this->openfile!='')
			{
			list($this->type,$this->openfile)=explode('/',$this->openfile);
			}
		if($this->openlang=='' && $this->openfile=='')
			{
			$this->fpath = JPATH_ROOT . '/components/com_jombadger/language/'.$this->curlang.'/'.$this->curlang.'.com_jombadger.ini';
			}
		else{
			if ($this->type=="administrator")
				{
				$this->fpath = JPATH_ROOT . '/administrator/components/com_jombadger/language/'.$this->openlang.'/'.$this->openlang.'.'.$this->openfile;	
				}
			else {
				$this->fpath = JPATH_ROOT . '/components/com_jombadger/language/'.$this->openlang.'/'.$this->openlang.'.'.$this->openfile;
				}
			}
			
	$fpath=$this->fpath;
	
	if($model->is__Filewritable($fpath)==1)
	{
		$this->isLangFileWritable = ' (<span style="color:red">'.JText::_('COM_JOMBADGER_FILE_NOTWRITABLE').'</span>)';
	}elseif($model->is__Filewritable($fpath)==0){
		$this->isLangFileWritable =' (<span style="color:red">'.JText::_('COM_JOMBADGER_FILE_NOTFOUND').'</span>)';
	}elseif($model->is__Filewritable($fpath)==2){
		$this->isLangFileWritable =' (<span style="color:green">'.JText::_('COM_JOMBADGER_FILE_WRITABLE').'</span>)';
	}else{
		$this->isLangFileWritable ='';
	}
	
	$this->openlangfile='';
    if($this->operr==0)
	  { 
			if($this->openlang=='' && $this->openfile=='')
			{
				$this->openlangfile  = $model->openfiles(JPATH_ROOT . '/components/com_jombadger/language/'.$this->curlang.'/'.$this->curlang.'.com_jombadger.ini');
			}
			else
			{
				$this->openlangfile  =$model->openfiles($fpath);
			}
		}
		
	$this->languages=$model->languages();
		
		
		
		// Set the toolbar
		$this->addToolBar();
    
   		
		
		
		
		parent::display($tpl);
    
		// Set the document
		$this->setDocument();
		
	}
	
protected function addToolBar() 
	{
		//creates the toolbar
		JToolBarHelper::title( JText::_('COM_JOMBADGER_LANGUAGE_EDITOR'),'jombadger');
    	
    	if ($this->canDo->get('core.admin'))
    	{
    		JToolBarHelper::custom( 'editor.saveLanguage', 'save.png', 'save.png', 'COM_JOMBADGER_EDITOR_SAVE',false,false);
    		JToolBarHelper::preferences( 'com_jombadger','500','600' );
    	}
    	JToolBarHelper::help( 'screen.openbadges',true );
    	JToolBarHelper::cancel( 'cancel', 'JTOOLBAR_CLOSE' );
	}
	
protected function setDocument() 
	{
		//set the title in the browser
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JOMBADGER_EDITOR_BROWSERTITLE'));
		$document->addStyleSheet('components/com_jombadger/openbadges.css'); 
	}
	
}
