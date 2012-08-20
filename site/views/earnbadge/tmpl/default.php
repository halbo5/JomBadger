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
		echo "<h2>".JText::_("COM_JOMBADGER_EARNBADGE_NOTCONNECTED")."</h2>";
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
		echo "<p>".JTEXT::_('COM_JOMBADGER_TEXT_NOTVALIDATED')."</p>";
		echo "<p>".JTEXT::_("COM_JOMBADGER_TEXT_KNOWMORE")." :</p>";
		echo "<p><a href='".$criteria_url."'>".JText::_('COM_JOMBADGER_CONTINUE')."</a></p>";
	}
else {
		//action to receive badge validated, we can continue
		if ($store)
			{
				//badge has been created for earner
				echo "<h3>".JText::_( 'COM_JOMBADGER_BADGE_STORE_OK' )."</h3>";
				echo "<p>".JText::_('COM_JOMBADGER_BADGE_SENDTO_BACKPACK')."</p>";
				echo "<div class='backPackLink'>".JText::_('COM_JOMBADGER_CONTINUE')."</div>";
				//echo "<p><a href=''>".JText::_('COM_JOMBADGER_CONTINUE')."</a></p>";
			?>
				<div id="badge-error">Oups :-)</div>
				<div id="errMsg"></div>
				<div id="badgeSuccess"><?php echo JText::_('COM_JOMBADGER_TRANSFER_SUCCESS');?></div>
			
			<?php if (JURI::base()=="http://www.bolli.fr/")
					{
					?>
				<!--  <div id="fb-root"></div> -->
				<script src='http://connect.facebook.net/fr_FR/all.js'></script>
				<p><a onclick='postToFeed(); return false;'>Post to Feed</a></p>
    			<p id='msg'></p>

   				<script> 
   				FB.init({appId: "352260288187019", status: true, cookie: true});
  				function postToFeed() {
			        // calling the API ...
			        var obj = {
			          method: 'feed',
			          link: '<?php echo $criteria_url; ?>',
			          picture: '<?php echo $this->badge->image; ?>',
			          name: '<?php echo $this->badge->name; ?>',
			          caption: 'Badge earned !',
			          description: '<?php echo $this->badge->description; ?>'
			        };
			
			        function callback(response) {
			          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
			        }
			
			        FB.ui(obj, callback);
			      }
			    
			    </script>
			<?php }//fin de la vérification qu'on est bien sur bolli.fr
			
			}
		else {
			echo "<p>".JText::_('COM_JOMBADGER_BADGE_STORE_ERROR')."</p>";
		}
		
		
		
	}
	

if ($pub_developpeur=="yes") {
echo "<br /><p class='mzd_petit'>".JTEXT::_("COM_MUZEEDEDI_DEVELOPPE_PAR")." <a href='http://www.cdprof.com'>cdprof.com</a> ".JTEXT::_("COM_MUZEEDEDI_POUR_RADIO")." <a href='http://www.muzeeli.fr'>Muzeeli</a></p>";
 }
 ?>