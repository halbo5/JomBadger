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



class JomBadgerViewbadge extends JViewLegacy
{
	

	
	function display($tpl = null)
	{
		$model =& $this->getModel();
		$db	   =& JFactory::getDBO();
		$app=&JFactory::getApplication('site');
		$input = $app->input;
		$id=$input->getInt('id_badge');
		//echo $id;exit;
		$jsonArray=$model->getBadgeArray($db,$id);
		$json=json_encode($jsonArray);
		$json=stripslashes($json);
		echo $json;
	}
}
