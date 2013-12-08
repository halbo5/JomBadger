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


class JomBadgerControllerissuer extends JControllerForm
{

	function __construct() {
		//by default, the list view is the plural of the edit view, we change that here
      $this->view_list = 'openbadges';
   
      parent::__construct();
   }
   
   function save() {
   	//send email after saving validation of badge issue
   	$savevalidation=parent::save();
   	if ($savevalidation)
   		{
   		// Initialise variables.
    	$data           = JRequest::getVar('jform', array(), 'post', 'array');
    	$config =& JFactory::getConfig();
    	$component = &JComponentHelper::getComponent('com_jombadger');
		$params = new JRegistry;
    	$params->loadString($component->params);
    	$issuerurl=$params->get('issuerurl');
    	$issuername=$params->get('issuername');
    	$issuerorg=$params->get('issuerorg');
    	$issuercontact=$params->get('issuercontact');
	    $sendername=($issuerorg!="")?$issuerorg:$issuername;
	    $sendername=($sendername!="")?$sendername:$config->get('config.fromname');
	    $sendermail=($issuercontact!="")?$issuercontact:$config->get('config.mailfrom');
	    $sender = array($sendermail,$sendername);
	    $subject=JText::_('COM_JOMBADGER_ISSUER_EMAILSUBJECT');
	    $path=JURI::root();
	    $url=$path."index.php?option=com_jombadger&view=earnbadge&badgeid=".$data['badgeid']."&email=".$data['usermail'];
	    //save validation
	    //API JomBadger
	    $api_OBJ = JPATH_SITE.'/components/com_jombadger/helper.php';
	    if ( file_exists($api_OBJ))
	    {
	    	require_once ($api_OBJ);
	    	JomBadgerHelper::validate($data['usermail'],$data['badgeid']);
	    }
	    //fin API JomBadger
	        	
	    //create mail body message
	    $message="<p>".JTEXT::_("COM_JOMBADGER_ISSUER_HELLO").",</p>";
	    $message.="<p>".JTEXT::_("COM_JOMBADGER_ISSUER_EMAILCONTENT1")." :<a href='".$issuerurl."'>".$sendername."</a></p>";
	    $message.="<p>".JTEXT::_("COM_JOMBADGER_ISSUER_EMAILCONTENT2")." :<br />";
	    $message.="<a href='".$url."'>".$url."</a></p>";
	    $message.="<p>".JTEXT::_("COM_JOMBADGER_ISSUER_GOODBYE").",</p>";
	    $message.=$sendername;
		        
	   	$mailer =& JFactory::getMailer();
		$mailer->addRecipient($data['usermail']);
		$mailer->setSubject($subject);
		$mailer->isHTML(true);
		$mailer->setBody($message);
		$mailer->setSender($sender);
		$test =& $mailer->Send();
		if ($test)
			{
			$this->setMessage(JText::_('COM_JOMBADGER_ISSUER_MAILSUCCESS'));
			}	
		else {
			$this->setMessage(JText::_('COM_JOMBADGER_ISSUER_MAILFAILED'));
			}
   		}
   		else {
   			$this->setMessage(JText::_('COM_JOMBADGER_ISSUER_DATANOTSAVED'));
   		}	
   }
}