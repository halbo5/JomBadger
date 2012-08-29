<?php

/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// No direct access

defined('_JEXEC') or die('Restricted access');


echo "<h2>".JText::_('COM_JOMBADGER_TITLE_LIST_BADGESVALIDATED')."</h2>";

$nbv=count($this->badgesvalidated);
if ($nbv!=0)
	{
	echo "<table class='jb_zebra'><thead>";
	echo "<tr><td></td></tr>";
	echo "</thead><tbody>";
	
	foreach($this->badgesvalidated as $badge)
	  	{
	    	echo "<tr><td><img src='".$badge->image."' /></td>";
	        echo "<td>".$badge->name."</td><td>".$badge->description."</td>";
	        echo "<td><a href='".$badge->criteria_url."'>".JText::_('COM_JOMBADGER_BADGE_DETAILS')."</a></td>";
	        echo "<td><a href='index.php?option=com_jombadger&view=earnbadge&badgeid=".$badge->id_badge."'>".JText::_('COM_JOMBADGER_MYBADGES_GENERATE')."</a></td>";
	       echo "</tr>";
	      }
	echo "</tbody></table>";
	}
else {
	echo JText::_("COM_JOMBADGER_MYBADGES_NOVALIDATED").".";
}

echo "<h2>".JText::_('COM_JOMBADGER_TITLE_LIST_BADGESISSUED')."</h2>";
$nbi=count($this->badgesissued);
if ($nbi!=0)
	{
	echo "<table class='jb_zebra'><thead>";
	echo "<tr><td></td></tr>";
	echo "</thead><tbody>";
	foreach($this->badgesissued as $badge)
	  	{
	    	echo "<tr><td><img src='".$badge->badgeimage."' /></td>";
	        echo "<td>".$badge->badgename."</td><td>".$badge->badgedescription."</td>";
	        echo "<td><a href='".$badge->badgecriteria."'>".JText::_('COM_JOMBADGER_BADGE_DETAILS')."</a></td>";
	        echo "<td>".$badge->badgeissuedon."</td>";
	        if ($badge->transfered==1)
	        	{
	        	echo "<td></td>";
	        	}
	        else {
	        	echo "<td><a href='index.php?option=com_jombadger&view=earnbadge&id_record=".$badge->id_record."'>".JText::_('COM_JOMBADGER_MYBADGES_TRANSFER')."</a></td>";
	        	}
	        echo "</tr>";
	      }
	echo "</tbody></table>";
	}
else {
	echo JText::_("COM_JOMBADGER_MYBADGES_NOISSUED").".";
}
  	      
        /*
            

	

if ($pub_developpeur=="yes") {
echo "<br /><p class='mzd_petit'>".JTEXT::_("COM_MUZEEDEDI_DEVELOPPE_PAR")." <a href='http://www.cdprof.com'>cdprof.com</a> ".JTEXT::_("COM_MUZEEDEDI_POUR_RADIO")." <a href='http://www.muzeeli.fr'>Muzeeli</a></p>";
 }*/
 ?>