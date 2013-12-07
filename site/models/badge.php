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


class JomBadgerModelbadge extends JModelLegacy
{
	
	
function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}

function getBadgeArray($db,$id_badge)
	{
		$query = $db->getQuery(true);
		$query->select('name,image,description,criteria_url,expires,issuerid,alignmentid,tags');
		$query->from('#__jb_badges');
		$query->where('id_badge=\''.$id_badge.'\'');
		$db->setQuery((string)$query);
		$badge = $db->loadObject();
		$path=JURI::base();
		
		//create array for json
		$json=array();
		$json['name']=$badge->name;
		$json['description']=$badge->description;
		$json['image']=$badge->image;
		$json['criteria']=$badge->criteria_url;
		$json['tags']=$badge->tags;
		$json['issuer']=$path."index.php?option=com_jombadger&view=issuer&format=json&id_issuer=".$badge->issuerid;
		return $json;
	}
	
}