<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class JomBadgerHelper 
{

/**
*Send back :
*0 if problem
*1 if datas saved
*2 if datas already present
*******/


function validate($usermail,$badgeid)
	{
	$db	   =& JFactory::getDBO();
	$query = "SELECT * FROM #__jb_validated WHERE usermail='$usermail' AND badgeid='$badgeid'";
	$db->setQuery($query);
	$result=$db->query();
	$nbrows=$db->getNumRows();
	if ($nbrows>0)
		{
		//data already there
		$validated="2";
		return $validated;
		}
	$query = "INSERT INTO #__jb_validated (id_validated,usermail,badgeid) VALUES ('','$usermail','$badgeid')";
	$db->setQuery($query);
	$result2=$db->query();
	if ($result2)
		{
		//data saved
		$validated="1";
		return $validated;
		}
	else {
		//problem !
		$validated="0";
		return $validated;
		}
	}
}
?>