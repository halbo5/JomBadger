<?php

/**
* @Copyright Copyright (C) 2012 Alain Bolli
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
******/

// No direct access

defined('_JEXEC') or die('Restricted access');

$userid=$this->userid;
$num_articles=$this->num_articles;
$count_articles=$this->count_articles;
$number_articles=$this->number_articles;
$badgeid=$this->articlesbadge;
$message=$this->message;

If ($userid<1)
{
		//Have to be connected to read the page
		echo "<h2>".JText::_("COM_JOMBADGER_EARNBADGE_NOTCONNECTED")."</h2>";
		return;
}
?>

<div class="row">
<div class="span1"></div>
<div class="span3"><?php //TODO ajouter une image pour faire joli ! ?></div>
			<div class="span7">
				<h3><?php echo JText::_( 'COM_JOMBADGER_OBJECTIVES_TITLE' );?></h3>
				<p><?php echo JTEXT::_("COM_JOMBADGER_OBJECTIVES_DESCRIPTION");?></p>
			</div>
			<div class="span1"></div>
		</div>
<?php 
if ($count_articles==1)
	{
		//count articles objective activated 
		?>
		<div class="row">
			<div class="span12">
			<h4><?php echo JTEXT::_("COM_JOMBADGER_GOALS_READ_ARTICLES");?></h4>
			</div>
		</div>
		<div class="row">
			<div class="span1"></div>
			<div class="span10">
				<p><?php echo JText::_( 'COM_JOMBADGER_OBJECTIVES_ARTICLES_READ' );?> : <?php echo $num_articles;?></p>
				<p><?php echo JTEXT::_("COM_JOMBADGER_OBJECTIVES_ARTICLES_TOREAD");?> : <?php echo $number_articles;?></p>
			</div>
			<div class="span1"></div>
		</div>
		<div class="row">
			<div class="span1"></div>
			<div class="span10">
				<?php 
				$path=JURI::root();
				$url=$path."index.php?option=com_jombadger&view=earnbadge&badgeid=".$badgeid;
					switch ($message){
						case 0:
							echo "<p>".JTEXT::_("COM_JOMBADGER_GOALS_READ_MORE")." !</p>";
							break;
						case 1:
							echo "<p>".JTEXT::_("COM_JOMBADGER_BADGE_OK")." !</p>";
							echo "<p><a href='".$url."'>".JTEXT::_("COM_JOMBADGER_BADGE_GET")."</a></p>";
							break;
						case 2:
							echo "<p>".JTEXT::_("COM_JOMBADGER_BADGE_ALREADYWON").".</p>";
							break;
						default:
							echo "...";
						}
				?>
			</div>
			<div class="span1"></div>
		</div>
	<?php  
	}

?>