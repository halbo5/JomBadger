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


echo "<h1>".JText::_('COM_JOMBADGER_TITLE_LIST_CATEGORIES')."</h1>";

foreach($this->categories as $category)
  	{
    	echo "<table><thead>";
        echo "<tr colspan='4'><th>".$category->title."</th></tr></thead>";
        echo "<tbody>";
        echo "<tr colspan='4'><td>".$category->description."</td></tr>";
        
        foreach ($this->badges as $badge)
        	if ($category->id==$badge->catid)
        		{
        			echo "<tr><td><img src='".$badge->image."' /></td>";
        			echo "<td>".$badge->name."</td><td>".$badge->description."</td>";
        			echo "<td><a href='".$badge->criteria_url."'>".JText::_('COM_JOMBADGER_BADGE_DETAILS')."</a></td></tr>";
        		}
        echo "</tbody></table>";
  	}      
        /*
            

	

if ($pub_developpeur=="yes") {
echo "<br /><p class='mzd_petit'>".JTEXT::_("COM_MUZEEDEDI_DEVELOPPE_PAR")." <a href='http://www.cdprof.com'>cdprof.com</a> ".JTEXT::_("COM_MUZEEDEDI_POUR_RADIO")." <a href='http://www.muzeeli.fr'>Muzeeli</a></p>";
 }*/
 ?>