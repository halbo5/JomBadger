<?php 
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// No direct access to this file
defined('_JEXEC') or die;

abstract class JomBadgerHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_BADGES'),
		                         'index.php?option=com_jombadger', $submenu == 'badges');
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_ISSUER'),
		                         'index.php?option=com_jombadger&view=issuer', $submenu == 'issuer');
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_CATEGORIES'),
		                         'index.php?option=com_categories&view=categories&extension=com_jombadger',
		                         $submenu == 'categories');
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_MYBADGE'),
		                         'index.php?option=com_jombadger&view=mybadge',
		                         $submenu == 'mybadge');
		// set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-jombadger ' .
		                               '{background-image: url(../media/com_jombadger/images/icon48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_JOMBADGER_ADMINISTRATION_CATEGORIES'));
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
			$assetName = 'com_jombadger';
		}
		else {
			$assetName = 'com_jombadger.badge.'.(int) $badgeId;
		}
 
		$actions = JAccess::getActions('com_jombadger', 'component');
 
		foreach ($actions as $action) {
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}
 
		return $result;
	}
	
}
