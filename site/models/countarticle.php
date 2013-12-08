<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012-2013 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/


// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );


class JomBadgerModelcountArticle extends JModelLegacy
{
	
	
function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}

function getUserCount($db,$userid)
	{
		$query = $db->getQuery(true);
		$query->select('id,component,articleid,userid');
		$query->from('#__jb_articles');
		$query->where('userid=\''.$userid.'\'');
		$db->setQuery((string)$query);
		$badge = $db->loadObject();
		$path=JURI::base();

	}
	
}