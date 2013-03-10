<?php
/**
 * @package   jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * JomBadger Form Field class for the JomBadger component
 */
class JFormFieldJomBadger extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'openbadges';
 
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions() 
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id_badge,#__jb_badges.name as name,#__categories.title as category,catid');
		$query->from('#__jb_badges');
		$query->leftJoin('#__categories on catid=#__categories.id');
		$db->setQuery((string)$query);
		$badges = $db->loadObjectList();
		$options = array();
		if ($badges)
		{
			foreach($badges as $badge) 
			{
				$options[] = JHtml::_('select.option', $badge->id_badge, $badge->name.
				                      ($badge->catid ? ' (' . $badge->category . ')' : ''));
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}