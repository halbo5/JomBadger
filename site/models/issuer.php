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


class JomBadgerModelissuer extends JModelLegacy
{
	
	
function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}

function getIssuerArray($db,$id_issuer)
	{
		$query = $db->getQuery(true);
		$query->select('issuer_name,issuer_url,issuer_email,issuer_description,issuer_image');
		$query->from('#__jb_issuer');
		$query->where('id_issuer=\''.$id_issuer.'\'');
		$db->setQuery((string)$query);
		$issuer = $db->loadObject();
		
		//create array for json
		$json=array();
		$json['name']=$issuer->issuer_name;
		$json['description']=$issuer->issuer_description;
		$json['image']=$issuer->issuer_image;
		$json['url']=$issuer->issuer_url;
		$json['email']=$issuer->issuer_email;
		return $json;
	}
	
}