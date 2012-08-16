<?php
/**
 * @package   openbadges
 * @subpackage Components
 * components/com_openbadges/openbadges.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.modeladmin' );


class openbadgesModelbadge extends JModelAdmin
{

public function getTable($type = 'ob_badges', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
/**
 * 
 * Loads the form fields (badge edit form)
 * @param unknown_type $data
 * @param unknown_type $loadData
 */	
public function getForm($data = array(), $loadData = true) 
	{
		// Get the form.
		$form = $this->loadForm('com_openbadges.badge', 'badge',
		                        array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}

/**
* 
* This javascript is for validating the edit badge form
*/
public function getScript() 
	{
		return 'administrator/components/com_openbadges/models/forms/openbadges.js';
	}
	
	
protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_openbadges.edit.badge.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
	
function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}
	
}