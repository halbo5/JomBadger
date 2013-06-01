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

jimport('joomla.application.component.controller');


class JomBadgerController extends JControllerLegacy
{
	
	function ajax_transfer_backpack()
	 {
		$input = JFactory::getApplication()->input;
		$id_record = $input->get('id_record', '', 'post');
	 	
	 	$db	   =& JFactory::getDBO();
		$query = "UPDATE #__jb_records SET transfered='1' where id_record='".$id_record."'";
		$db->setQuery($query);
		$result=$db->query();
	}	
	
}
