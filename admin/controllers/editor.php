<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controllerform');


class JomBadgerControllereditor extends JControllerForm
{

	function __construct() {
		//by default, the list view is the plural of the edit view, we change that here
      $this->view_list = 'openbadges';
      
      parent::__construct();
   }
   
function saveLanguage()
	{
		$app = &JFactory::getApplication();
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$saveLangfile	= JRequest::getVar( 'langFileTxtBox');
		$sfilePath		= base64_decode(JRequest::getVar( 'sfileP', '', 'post', 'string' ));
		$currlang		= JRequest::getVar( 'curlang','','post');
		$currfile		= JRequest::getVar( 'curfile','','post');
		 
		 if(!empty($saveLangfile) && is_writable($sfilePath) && file_exists($sfilePath)){
				$fp = fopen($sfilePath, "w+");
				fwrite($fp,$saveLangfile);
				fclose($fp);
				$msg = JText::_( 'COM_JOMBADGER_LANGUAGE_SAVED' );
				$errtxt = '';
			}
			else{
				$msg = JText::_( 'COM_JOMBADGER_LANGUAGE_NOTSAVED' );
				$errtxt = 'error';
			}
		$this->setRedirect( 'index.php?option=com_jombadger&view=editor&lang='.$currlang.'&mfile='.$currfile, $msg,$errtxt );
	}

}