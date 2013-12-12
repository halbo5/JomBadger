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

jimport( 'joomla.application.component.modeladmin' );


class JomBadgerModelbadge extends JModelAdmin
{

public function getTable($type = 'jb_badges', $prefix = 'Table', $config = array()) 
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
		$form = $this->loadForm('com_jombadger.badge', 'badge',
		                        array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		
		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data))
		{
			// Disable fields for display.
			//$form->setFieldAttribute('ordering', 'disabled', 'true');
			$form->setFieldAttribute('state', 'disabled', 'true');
			//$form->setFieldAttribute('publish_up', 'disabled', 'true');
			//$form->setFieldAttribute('publish_down', 'disabled', 'true');
		
			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			//$form->setFieldAttribute('ordering', 'filter', 'unset');
			$form->setFieldAttribute('state', 'filter', 'unset');
			//$form->setFieldAttribute('publish_up', 'filter', 'unset');
			//$form->setFieldAttribute('publish_down', 'filter', 'unset');
		}
		
		
		
		return $form;
	}

/**
* 
* This javascript is for validating the edit badge form
*/
public function getScript() 
	{
		return 'administrator/components/com_jombadger/models/forms/openbadges.js';
	}
	
	
protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_jombadger.edit.badge.data', array());
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