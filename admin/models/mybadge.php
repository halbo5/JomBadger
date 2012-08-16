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


class openbadgesModelmybadge extends JModelAdmin
{
	
public function testBadge($params) 
	{
		$test=array();
		//test params present
		$issuerurl		= $params->get('issuerurl');
		$issuername		= $params->get('issuername');
		$test['params']=($issuerurl!="" && $issuername!="")?1:0;
			
		//test if 1 category created
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id');
		$query->from('#__categories');
		$query->where('extension=\'com_openbadges\'');
		$db->setQuery((string)$query);
		$db->query();
		$rows = $db->getNumRows();
		$test['category']=($rows>0)?1:0;
		
		//test if two badges created
		$query = $db->getQuery(true);
		$query->select('id_badge');
		$query->from('#__ob_badges');
		$db->setQuery((string)$query);
		$db->query();
		$rowsbadges = $db->getNumRows();
		$test['badges']=($rowsbadges>1)?1:0;
		
		//test if 1 badge issued
		$query = $db->getQuery(true);
		$query->select('id_record');
		$query->from('#__ob_records');
		$db->setQuery((string)$query);
		$db->query();
		$rowsrecords = $db->getNumRows();
		$test['records']=($rowsrecords>0)?1:0;
		
		//test if plugin installed
		$query = $db->getQuery(true);
		$query->select('extension_id');
		$query->from('#__extensions');
		$query->where('element=\'obvalidate\'');
		$db->setQuery((string)$query);
		$db->query();
		$rowsplugin = $db->getNumRows();
		$test['plugin']=($rowsplugin>0)?1:0;
		
		//total of values in array to know if badge earned
		foreach ($test as $value)
			{
			$total+=$value;
			}
		$test['total']=$total;
		if ($total==5)
			{
				$send=$this->sendEarner();
			}
		
		return $test;
	}
	

protected function sendEarner()
	{
		$user	= JFactory::getUser();
		$earneremail = $user->email;
		$earneremail=urlencode($earneremail);
    	$url="http://www.bolli.fr/api/ob_installed.php?earneremail=$earneremail";
    	$send=file_get_contents($url);
    	return $send;
	}

	
function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}
	
public function getForm($data = array(), $loadData = true) 
	{
		/* Get the form.
		$form = $this->loadForm('com_openbadges.badge', 'badge',
		                        array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;*/
	}
	
}