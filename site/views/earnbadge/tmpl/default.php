<?php

/**
* @Copyright Copyright (C) 2012 Alain Bolli
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
******/

// No direct access

defined('_JEXEC') or die('Restricted access');

$validated=$this->validated;
$store=$this->store;
$userid=$this->userid;
$criteria_url=$this->criteria_url;

If ($userid<1)
{
		//Have to be connected to read the page
		echo "<h2>Vous devez être connecté pour voir le contenu de cette page.</h2>";
		return;
}

/*
$titre_page=$this->titre_page;
$couleur_bordure=$this->couleur_bordure;
$couleur_fond=$this->couleur_fond;
$pub_developpeur=$this->pub_developpeur;
$gratuit=$this->gratuit;
$connecte=$this->connecte;
*/




/*echo "******** Debug ************<br />";
var_dump($titre_page);echo "<br><br>";var_dump($gratuit);echo "<br><br>";var_dump($connecte);echo "<br><br>";echo "<br><br>";var_dump($sms);
echo "<br />******** Debug ************<br />";
*/

echo "<h1>$titre_page</h1>";
echo "<p>$text_before</p>";
echo "<br />";

if ($validated=="0")
	{
		//no validated action to receive a badge
		echo "<p>".JTEXT::_('COM_OPENBADGES_TEXT_NOTVALIDATED')."</p>";
		echo "<p>".JTEXT::_("COM_OPENBADGES_TEXT_KNOWMORE")." :</p>";
		echo "<p><a href='".$criteria_url."'>".JText::_('COM_OPENBADGES_CONTINUE')."</a></p>";
	}
else {
		//action to receive badge validated, we can continue
		if ($store)
			{
				//badge has been created for earner
				echo "<h3>".JText::_( 'COM_OPENBADGES_BADGE_STORE_OK' )."</h3>";
				echo "<p>".JText::_('COM_OPENBADGES_BADGE_SENDTO_BACKPACK')."</p>";
				echo "<div class='backPackLink'>".JText::_('COM_OPENBADGES_CONTINUE')."</div>";
				//echo "<p><a href=''>".JText::_('COM_OPENBADGES_CONTINUE')."</a></p>";
			}
		else {
			echo "<p>".JText::_('COM_OPENBADGES_BADGE_STORE_ERROR')."</p>";
		}
		
		
		
	}
	

if ($pub_developpeur=="yes") {
echo "<br /><p class='mzd_petit'>".JTEXT::_("COM_MUZEEDEDI_DEVELOPPE_PAR")." <a href='http://www.cdprof.com'>cdprof.com</a> ".JTEXT::_("COM_MUZEEDEDI_POUR_RADIO")." <a href='http://www.muzeeli.fr'>Muzeeli</a></p>";
 }
 ?>