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
$badgeRecipientEmail=$this->badgeRecipientEmail;
$badgeRecipientName=$this->badgeRecipientName;
$badgeid=$this->badgeid;
$image=$this->image;
$badgename=$this->badgename;
$submit=$this->submit;

If ($userid<1 && $badgeRecipientEmail=='')
{
		//Have to be connected to read the page
		echo "<h2>".JText::_("COM_JOMBADGER_EARNBADGE_NOTCONNECTED")."</h2>";
		return;
}

?>
<script>
//facebook plugin
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




if ($validated=="" && $id_record=="" )
	{
		//no validated action to receive a badge
		?>
		<div class="row">
			<div class="span1"></div>
			<div class="span3"><img src="<?php echo $image; ?>" alt="<?php echo $badgename;?>" title="<?php echo $badgename;?>" width="150px"></div>
			<div class="span7">
				<h3><?php echo JText::_( 'COM_JOMBADGER_TEXT_NOTVALIDATED' );?></h3>
				<p><?php echo JTEXT::_("COM_JOMBADGER_TEXT_KNOWMORE");?></p>
				<p><a href="<?php  echo $criteria_url;?>"><?php echo JText::_('COM_JOMBADGER_GOTOCRITERIA');?></a></p>
			</div>
			<div class="span1"></div>
		</div>
	<?php  
	}
else if ($submit=="") {
		//action to receive badge validated, we can continue

				//badge has been created for earner
				$link=JURI::base()."index.php?option=com_jombadger&view=earnbadge";
				?>
				<div class="row">
					<div class="span1"></div>
					<div class="span3"><img src="<?php echo $image; ?>" alt="<?php echo $badgename;?>" title="<?php echo $badgename;?>" width="150px"></div>
					<div class="span7"><h3 class="titre-earnbadge"><?php echo JText::_( 'COM_JOMBADGER_BADGE_OK' );?></h3></div>
					<div class="span1"></div>
				</div> 
				<div class="row">
					<div class="span1"></div>
					<div class="span10"><p><?php echo JText::_('COM_JOMBADGER_BADGE_SENDTO_BACKPACK');?></p></div>
					<div class="span1"></div>
				</div>
				<div class="row">
					<div class="span1"></div>
					<div class="span10">
						<form action="<?php echo $link;?>" method='post' class='form-inline'>
							<fieldset>
								<label for='name'><?php echo JText::_('COM_JOMBADGER_EARNBADGE_NAME'); ?></label>
								<input type='text' name='name' id='name' value='<?php echo $badgeRecipientName;?>' />
								<label for="email"><?php echo JText::_('COM_JOMBADGER_EARNBADGE_EMAIL');?></label>
								<input type='text' name='email' id='email' value='<?php echo $badgeRecipientEmail;?>' />
								<input type='hidden' name='badgeid' value='<?php echo $badgeid;?>' />
								<input type='hidden' name='id_record' value='<?php echo $id_record;?>' />
								<input type='hidden' name='store' value='<?php echo $store;?>' />
								<input type='hidden' name='validated' value='1' />
								<input type='submit' name='submit' class='btn btn-primary' value="<?php echo JText::_('COM_JOMBADGER_EARNBADGE_MODIFIER');?>" />
							</fieldset>
						</form>
					</div>
					<div class="span1"></div>
				</div>
				<?php 		
	}
else {//badge created
?>
		<div class="row">
			<div class="span1"></div>
			<div class="span3"><img src="<?php echo $image; ?>" alt="<?php echo $badgename;?>" title="<?php echo $badgename;?>" width="150px"></div>
			<div class="span7">
				<h3 class="titre-earnbadge"><?php echo JText::_( 'COM_JOMBADGER_BADGE_STORE_OK' );?></h3>
			</div>
			<div class="span1"></div>
		</div>
		<?php 
				if ($submit!="" && $store!="")
					{
					?>
					<div class="row">
						<div class="span1"></div>
						<div class="span10">
							<p><?php echo JTEXT::_("COM_JOMBADGER_BADGE_TRANSFER");?></p>
							<a class='btn btn-success backPackLink'><i class="icon-chevron-right"></i><?php echo JText::_('COM_JOMBADGER_CONTINUE');?></a>
						</div>
						<div class="span1"></div>
					</div>
					<div class="row">
						<div class="span1"></div>
						<div class="span10">
							<div id="badge-error" class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Warning !</strong>
							<?php echo JText::_('COM_JOMBADGER_TRANSFER_ERROR');?>
							</div>
							<div id="errMsg"></div>
							<div id="badgeSuccess" class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Yeah !</strong>
							<?php echo JText::_('COM_JOMBADGER_TRANSFER_SUCCESS');?></div>
						</div>
						<div class="span1"></div>
					</div>
					<?php
					}
				elseif ($submit!="" && $store=="") {
						echo "<p>".JText::_('COM_JOMBADGER_BADGE_STORE_ERROR')."</p>";
					}
				
				//if facebook appid is in parameters, we display a button to post to wall
				if ($this->appid!="")
					{
					?>
				<div class="row">
					<div class="span1"></div>
					<div class="span10">
						<p><a class="jb_facebook" onclick='showStream(); return false;'><?php echo JText::_('COM_JOMBADGER_POSTTOFEED');?></a></p>
		    			<p id='msg'></p>
		    			<p id='loader'><?php //echo JText::_('COM_JOMBADGER_FACEBOOKONSCREEN');?></p>
    				</div>
    				<div class="span1"></div>
    			</div>

   				<!-- <script> 
   				
			
			        function callback(response) {
			          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
			        }
			
			        FB.ui(obj, callback);
			      }
			    
			    </script>-->
			<?php }//end facebook button
}
?>