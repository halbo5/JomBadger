<?php

/**
* @Copyright Copyright (C) 2012 Alain Bolli
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
******/

// No direct access

defined('_JEXEC') or die('Restricted access');

$verif=$this->verif;
$validated=$this->validated;
$store=$this->store;
$userid=$this->userid;
$criteria_url=$this->criteria_url;
$id_record=$this->id_record;

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

?>
<script>
$j=jQuery.noConflict();
$j(document).ready(function($) {
  // Add the function to run after FB is initialized
    $(document).on('fb:initialized', function() {
    	function loginStatus(response){
				if (response.authResponse) {
						//user is already logged in and connected
						FB.api('/me', function(info) {
    					login(response, info);
						});
			} else {
						//user is not connected to your app or logged out
					    showLoader(true);
					    FB.login(function(response) {
        							if (response.authResponse) {
            										FB.api('/me', function(info) {
                									login(response, info);
            										});
        							} else {
            						//user cancelled login or did not grant authorization
            						showLoader(false);
       			 					}
    					}, {scope:'email,status_update,publish_stream,user_about_me'});
					}
			}    
FB.getLoginStatus(loginStatus);
FB.Event.subscribe('auth.statusChange', loginStatus);
    });
    $(document).fb('<?php echo $this->appid; ?>');
});

function fbAuthStatusChange(request) {
    console.log('euh ?');
}

function login(response, info){
    if (response.authResponse) {
        var accessToken=response.authResponse.accessToken;
    }
}


function logout(response){
    
}

function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){
        showLoader(true);
        FB.ui(
        {
            method: 'stream.publish',
            message: 'où ?',
            attachment: {
                name: name,
                caption: '',
                description: (description),
                href: hrefLink
            },
            action_links: [
                { text: hrefTitle, href: hrefLink }
            ],
            user_prompt_message: userPrompt
        },
        function(response) {
            showLoader(false);
        });
 
    }
    
 function showStream(){
    FB.api('/me', function(response) {
        //console.log(response.id);
        streamPublish('<?php echo $this->badge->name; ?>', '<?php echo $this->badge->description; ?>', 'Badge earned !', '<?php echo $criteria_url; ?>', '');
    });
}


function showLoader(status){
       if (status) {
          document.getElementById('loader').style.display = 'block';
       }
       else {
        document.getElementById('loader').style.display = 'none';
       }
   }

</script>

<?php 


echo "<h1>$titre_page</h1>";
echo "<p>$text_before</p>";
echo "<br />";

if ($validated=="0" && $id_record=="" )
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
				<div id="badge-error"><?php echo JText::_('COM_JOMBADGER_TRANSFER_ERROR');?></div>
				<div id="errMsg"></div>
				<div id="badgeSuccess"><?php echo JText::_('COM_JOMBADGER_TRANSFER_SUCCESS');?></div>
			
			
				
				<?php //if facebook appid is in parameters, we display a button to post to wall
				if ($this->appid!="")
					{
					?>
				<p><a class="jb_facebook" onclick='showStream(); return false;'><?php echo JText::_('COM_JOMBADGER_POSTTOFEED');?></a></p>
    			<p id='msg'></p>
    			<p id='loader'><?php echo JText::_('COM_JOMBADGER_FACEBOOKONSCREEN');?></p>

   				<!-- <script> 
   				
			
			        function callback(response) {
			          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
			        }
			
			        FB.ui(obj, callback);
			      }
			    
			    </script>-->
			<?php }//end facebook button
			}
		else {
			echo "<p>".JText::_('COM_JOMBADGER_BADGE_STORE_ERROR')."</p>";
		}
		
		
		
	}
	

if ($pub_developpeur=="yes") {
echo "<br /><p class='mzd_petit'>".JTEXT::_("COM_MUZEEDEDI_DEVELOPPE_PAR")." <a href='http://www.cdprof.com'>cdprof.com</a> ".JTEXT::_("COM_MUZEEDEDI_POUR_RADIO")." <a href='http://www.muzeeli.fr'>Muzeeli</a></p>";
 }
 ?>