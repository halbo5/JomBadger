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


class JomBadgerModelearnbadge extends JModelItem
{

	protected $badges;
	
public function getTable($type = 'jb_badges', $prefix = 'Table', $config = array()) 
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

function rand_string( $length ) { //this function just obscures the users name and badge in the url get string 
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
	
	return $str;
}

function getBadgeId()
	{
			//request the selected id
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('badgeid');
			return $id;
	}

public function getBadge($id = 1) 
	{
		if (!is_array($this->badges))
		{
			$this->badges = array();
		}
 
		if (!isset($this->badges[$id])) 
		{
            //request the selected id
			$id=$this->getBadgeId();
			// Get a Tablebadges instance
			$table = $this->getTable('jb_badges');
			// Load the badge
			$table->load($id);
			$this->badges[$id]=$table;
		}
 
		return $this->badges[$id];
	}
	
	
/*public function getBadgeRecorded($id) 
	{
		if (!is_array($this->records))
		{
			$this->records = array();
		}
 
		if (!isset($this->records[$id])) 
		{
			// Get a Tablerecords instance
			$table = $this->getTable('jb_records');
			// Load the badge
			$table->load($id);
			$this->records[$id]=$table;
		}
 
		return $this->records[$id];
	}*/
	
	
public function getValidated($db,$usermail,$id_record)
	{
		//request the selected id
		$id = $this->getBadgeId();
		if ($id!="")
			{//if nbrows >0 there are badges validated that can be generated and transmitted
			$query = "SELECT id_validated FROM #__jb_validated WHERE usermail='$usermail' AND badgeid='$id'";
			$db->setQuery($query);
			$result=$db->query();
			$nbrows=$db->getAffectedRows();
			return $nbrows;	
			}
		else {
			if ($id_record!="")
			{
				//if nbrows >0 there are badges already generated that can be transmitted
				$query = "SELECT id_record FROM #__jb_records WHERE earneremail='$usermail' AND id_record='$id_record'";
				//var_dump($query);
				$db->setQuery($query);
				$result=$db->query();
				$nbrows=$db->getAffectedRows();
				return $nbrows;
			}
			else {
				$nbrows=0;//no badges to generate or to validate
				return $nbrows;
			}
		}	
	}
	
public function deleteValidated($db,$usermail)
	{
		//delete datas for badge validation once the badge is created
		
		$id = $this->getBadgeId();//look for badgeid in url or page parameters
		
			$query = "DELETE FROM #__jb_validated WHERE usermail='$usermail' AND badgeid='$id'";
			$db->setQuery($query);
			$result=$db->query();
			$nbrows=$db->getAffectedRows();
			return $nbrows;
	}
	
	
public function verifBadge($db,$record)
	{
		//test if record already exists for this badge and user
		//$id = $this->getBadgeId();
		$query = "SELECT id_record FROM #__jb_records WHERE evidence='".$record['evidence'];
		$query.=									"' AND earneremail='".$record['earneremail'];
		$query.=									"' AND earnername='".$record['earnername'];
		$query.=									"' AND badgeid='".$record['badgeid'];
		//$query.=									"' AND badgeimage='".$record['badgeimage'];
		//$query.=									"' AND badgedescription='".$record['badgedescription'];
		//$query.=									"' AND badgecriteria='".$record['badgecriteria'];
		$query.=									"' AND badgeexpires='".$record['badgeexpires']."'";
		//$query.=									"' AND badgeissuerorigin='".$record['badgeissuerorigin'];
		//$query.=									"' AND badgeissuername='".$record['badgeissuername'];
		//$query.=									"' AND badgeissuerorg='".$record['badgeissuerorg'];
		//$query.=									"' AND badgeissuercontact='".$record['badgeissuercontact']."'";
			
		$db->setQuery($query);
		$db->query();
		$result=$db->loadResult($db);
		//var_dump($result);exit;
		return $result;	
	}
	
public function storeBadge($record)
	{
		
		 $row =& $this->getTable('jb_records');
    // Bind the form fields to the badges table
    if (!$row->bind($record)) {
        $this->setError($this->_db->getErrorMsg());
        return false;
    }
 
    // Make sure the badges record is valid
    if (!$row->check()) {
        $this->setError($this->_db->getErrorMsg());
        return false;
    }
 
    // Store the badge to the database
    if (!$row->store()) {
        $this->setError($this->_db->getErrorMsg());
        return false;
    }

    return $row->id_record;
		
		
	}
	
public function createJsonArray($db,$id)
	{
		//create JSON content for backpack
		$query = $db->getQuery(true);
		$query->select('uid,evidence,identity,identity_type,salt,badgeid,badgeexpires,badgeissuedon,verify_type');
		$query->from('#__jb_records');
		$query->where('id_record=\''.$id.'\'');
		$db->setQuery($query);
		$result=$db->loadAssoc();
		$path=JURI::base();
		//var_dump($result);exit;
		
		$recipient=array();
		$recipient['type']=$result['identity_type'];
		$recipient['hashed']=true;
		$recipient['salt']=$result['salt'];
		$recipient['identity']=$result['identity'];
		
		$verify=array();
		$verify['type']=$result['verify_type'];
		$verify['url']=$path."index.php?option=com_jombadger&view=earnbadge&format=json&id_record=".$id;
		
		$json=array();
		$json['uid']=$result['uid'];
		$json['recipient']=$recipient;
		$json['evidence']=$result['evidence'];
		$json['issuedOn']=$result['badgeissuedon'];
		$json['expires']=$result['badgeexpires'];
		$json['badge']=$path."index.php?option=com_jombadger&view=badge&format=json&id_badge=".$result['badgeid'];
		$json['verify']=$verify;
		
		return $json;
		
	}

public function createJavascript($id_record,$recordedBadgeUrl,$badgeName,$recipientName)
	{
		//create the javascript for contacting openbadges api
		$javascript="jQuery.noConflict();";
		$javascript.="jQuery(document).ready(function($) {";
		//$javascript.="$('.js-required').hide();";
		//$javascript.="if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){  //The Issuer API isn't supported on MSIE Bbrowsers";
		//$javascript.="$('.backPackLink').hide();$('.login-info').hide();$('.browserSupport').show();";
		//$javascript.="}";
		//Function that issues the badge";
		$javascript.="$('.backPackLink').click(function() {";
		$javascript.="var assertionUrl = '".$recordedBadgeUrl."';";
       	$javascript.="OpenBadges.issue([''+assertionUrl+''], function(errors, successes){"; 
		$javascript.="if (errors.length > 0 ) {";
		$javascript.="$('#errMsg').text(errors.toSource());";
		//$javascript.="$('#badge-error').show();";	
		//$javascript.="var data = 'ERROR, ".$badgeName.", ".$recipientName.", ' +  errors.toSource();";
		$javascript.="}";
		$javascript.="if (successes.length > 0) {";
     	$javascript.="$('.backPackLink').hide();$('.login-info').hide();$('#badgeSuccess').show();";
		//$javascript.="var data = 'SUCCESS, ".$badgeName.", ".$recipientName."';";
		$javascript.="$.ajax({";
  		$javascript.="type: \"POST\",";
  		$javascript.="url: '".$path."index.php?option=com_jombadger&task=ajax_transfer_backpack&id_record=".$id_record."',";
  		$javascript.="data: { id_record: $id_record }";
		$javascript.="})";//end of l'ajax
		$javascript.="}});});});";
       	//$javascript.="});});});";
		return $javascript;
	}
	
public function jqFBplugin($lang) 
{	
	
	$uri =& JURI::getInstance();
	$path=$uri->getHost();
	$channel="//".$path."/components/com_jombadger/channel.php?lang=".$lang;

	$javascript=<<<EOD
	(function( $ ) {

$.fn.fb = function(appId, options) {

var settings = $.extend({
appId : appId,
channel : '$channel',
status : true,
cookie : true,
xfbml : true,
oauth : true
}, options);

window.fbInit = window.fbInit || false;
if (window.fbInit) {
$(document).trigger('fb:initialized');
if (settings.xfbml) {
FB.XFBML.parse();
}
return;
}

// Aync Init
window.fbAsyncInit = function() {
window.fbInit = true;
$(document).trigger('fb:initializing');
FB.init(settings);
$(document).trigger('fb:initialized');
};

// Append fb-root
var fbRoot = 'fb-root';
if (!document.getElementById(fbRoot)) {
var element = document.createElement('div');
element.id = fbRoot;
document.body.appendChild(element);
}

// Add Facebook Javascript SDK
var js, id = 'facebook-jssdk';
if (!document.getElementById(id)) {
js = document.createElement('script');
js.id = id;
js.async = true;
js.src = "//connect.facebook.net/$lang/all.js";
document.getElementsByTagName('head')[0].appendChild(js);
}
};
})( jQuery );
EOD;
return $javascript;
}

}