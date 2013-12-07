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

jimport( 'joomla.application.component.model' );


class JomBadgerModelopenbadges extends JModelLegacy
{
	
	
function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}

function getBadges()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id_badge,#__jb_badges.name as name, #__jb_badges.image as image, #__jb_badges.description as description, criteria_url,expires, catid');
		$query->from('#__jb_badges');
		$query->leftjoin('#__categories on catid=#__categories.id');
		$query->order('name');
		$db->setQuery((string)$query);
		$badges = $db->loadObjectList();
		return $badges;
	}
	
function getCategories()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,title,description');
		$query->from('#__categories');
		$query->where('extension=\'com_jombadger\'');
		$query->order('title');
		$db->setQuery((string)$query);
		$categories = $db->loadObjectList();
		return $categories;
	}

}