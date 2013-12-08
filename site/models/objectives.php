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

jimport( 'joomla.application.component.modelitem' );


class JomBadgerModelobjectives extends JModelItem
{

	//protected $badges;
	
public function getTable($type = 'jb_articles', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
function connectDB()
	{
		// Connection to database 
		$db	   =& JFactory::getDBO();
		return $db;
	}
	
function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}
	
function getUserArticlesCount($db,$userid)
	{
		$query = $db->getQuery(true);
		$query->select('id,component,articleid,userid');
		$query->from('#__jb_articles');
		$query->where('userid=\''.$userid.'\'');
		$db->setQuery((string)$query);
		$db->execute();
		$num_rows=$db->getNumRows();
		return $num_rows;
	}
	
function getGoalId()
	{
		//request the selected id
		$input = JFactory::getApplication()->input;
		$articlesbadge = $input->getInt('articlesbadge');
		return $articlesbadge;
	}
	

}