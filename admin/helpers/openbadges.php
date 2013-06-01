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
		//JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_USERS'),
								//'index.php?option=com_jombadger&view=users', $submenu == 'users');
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_CATEGORIES'),
		                         'index.php?option=com_categories&view=categories&extension=com_jombadger',
		                         $submenu == 'categories');
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_ISSUEDBADGES'),
		                         'index.php?option=com_jombadger&view=issued',
		                         $submenu == 'issued');
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_ISSUER_ORGANIZATIONS'),
								'index.php?option=com_jombadger&view=issuerorganizations', $submenu == 'issuerorganizations');
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_MYBADGE'),
		                         'index.php?option=com_jombadger&view=mybadge',
		                         $submenu == 'mybadge');
		JSubMenuHelper::addEntry(JText::_('COM_JOMBADGER_SUBMENU_EDITOR'),
		                         'index.php?option=com_jombadger&view=editor',
		                         $submenu == 'editor');
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
	
	
	/**
	 * Get a list of filter options for the blocked state of a user.
	 *
	 * @return  array  An array of JHtmlOption elements.
	 *
	 * @since   1.6
	 */
	static function getStateOptions()
	{
		// Build the filter options.
		$options = array();
		$options[] = JHtml::_('select.option', '0', JText::_('JENABLED'));
		$options[] = JHtml::_('select.option', '1', JText::_('JDISABLED'));
	
		return $options;
	}
	
	
	/**
	 * Get a list of filter options for the activated state of a user.
	 *
	 * @return  array  An array of JHtmlOption elements.
	 *
	 * @since   1.6
	 */
	static function getActiveOptions()
	{
		// Build the filter options.
		$options = array();
		$options[] = JHtml::_('select.option', '0', JText::_('COM_USERS_ACTIVATED'));
		$options[] = JHtml::_('select.option', '1', JText::_('COM_USERS_UNACTIVATED'));
	
		return $options;
	}
	
	/**
	 * Get a list of the user groups for filtering.
	 *
	 * @return  array  An array of JHtmlOption elements.
	 *
	 * @since   1.6
	 */
	static function getGroups()
	{
		$db = JFactory::getDbo();
		$db->setQuery(
				'SELECT a.id AS value, a.title AS text, COUNT(DISTINCT b.id) AS level' .
				' FROM #__usergroups AS a' .
				' LEFT JOIN '.$db->quoteName('#__usergroups').' AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
				' GROUP BY a.id, a.title, a.lft, a.rgt' .
				' ORDER BY a.lft ASC'
		);
		$options = $db->loadObjectList();
	
		// Check for a database error.
		if ($db->getErrorNum())
		{
			JError::raiseNotice(500, $db->getErrorMsg());
			return null;
		}
	
		foreach ($options as &$option)
		{
			$option->text = str_repeat('- ', $option->level).$option->text;
		}
	
		return $options;
	}
	
	/**
	 * Creates a list of range options used in filter select list
	 * used in com_users on users view
	 *
	 * @return  array
	 *
	 * @since   2.5
	 */
	public static function getRangeOptions()
	{
		$options = array(
				JHtml::_('select.option', 'today', JText::_('COM_USERS_OPTION_RANGE_TODAY')),
				JHtml::_('select.option', 'past_week', JText::_('COM_USERS_OPTION_RANGE_PAST_WEEK')),
				JHtml::_('select.option', 'past_1month', JText::_('COM_USERS_OPTION_RANGE_PAST_1MONTH')),
				JHtml::_('select.option', 'past_3month', JText::_('COM_USERS_OPTION_RANGE_PAST_3MONTH')),
				JHtml::_('select.option', 'past_6month', JText::_('COM_USERS_OPTION_RANGE_PAST_6MONTH')),
				JHtml::_('select.option', 'past_year', JText::_('COM_USERS_OPTION_RANGE_PAST_YEAR')),
				JHtml::_('select.option', 'post_year', JText::_('COM_USERS_OPTION_RANGE_POST_YEAR')),
		);
		return $options;
	}	
}
