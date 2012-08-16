<?php 
/**
 * @package   openbadges
 * @subpackage Components
 * components/com_openbadges/openbadges.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// No direct access to this file
defined('_JEXEC') or die;

abstract class OpenBadgesHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_OPENBADGES_SUBMENU_BADGES'),
		                         'index.php?option=com_openbadges', $submenu == 'badges');
		JSubMenuHelper::addEntry(JText::_('COM_OPENBADGES_SUBMENU_CATEGORIES'),
		                         'index.php?option=com_categories&view=categories&extension=com_openbadges',
		                         $submenu == 'categories');
		JSubMenuHelper::addEntry(JText::_('COM_OPENBADGES_SUBMENU_MYBADGE'),
		                         'index.php?option=com_openbadges&view=mybadge',
		                         $submenu == 'mybadge');
		// set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-openbadges ' .
		                               '{background-image: url(../media/com_openbadges/images/icon48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_OPENBADGES_ADMINISTRATION_CATEGORIES'));
		}
	}
	
	/**
	 * 
	 * for using of ACL
	 * @param int $badgeId badge's id
	 */
public static function getActions($badgeId = 0)
	{	
		jimport('joomla.access.access');
		$user	= JFactory::getUser();
		$result	= new JObject;
 
		if (empty($badgeId)) {
			$assetName = 'com_openbadges';
		}
		else {
			$assetName = 'com_openbadges.badge.'.(int) $badgeId;
		}
 
		$actions = JAccess::getActions('com_openbadges', 'component');
 
		foreach ($actions as $action) {
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}
 
		return $result;
	}
	
}
