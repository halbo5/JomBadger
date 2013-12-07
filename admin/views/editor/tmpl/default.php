<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
jimport('joomla.html.pane');

$userid=$this->userid;

// Must be logged in
if ($userid < 1) {
	//JError::raiseError( 403, JText::_('ALERTNONAUTH') );
	return;
}
?>




<script type="text/javascript">
	function submitbutton(pressbutton) {alert('save language');
			if (pressbutton == 'saveLanguage') { 
				var mtextbox =  document.getElementById('langFileTxtBox').value;
				if(mtextbox.length>0)
					{
						submitform(pressbutton);
						return;
					}else{
						alert("Can not save!");
						return;
					}
				
			}		
			if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}

		}

function lFilter(){
	var mlanguage =  document.getElementById('mlanguage').value;
	var mfile =  document.getElementById('sfile').value;
	var url = '<?php echo html_entity_decode(JRoute::_('index.php?option=com_jombadger&view=editor')); ?>';
	if(mlanguage != '' && mfile != ''){
		url += '&lang=' + mlanguage +'&mfile=' + mfile;
		document.location = url;
	}
	
}
</script>
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?> 
<form  method="post" action="<?php echo JRoute::_('index.php?option=com_jombadger'); ?>" name="adminForm" id="adminForm">
<fieldset><legend><?php echo JText::_('COM_JOMBADGER_LANGUAGE_SELECT'); ?></legend>
<select name="mlanguage" id="mlanguage" style="width: 200px;">
			<option value="" selected="">-- <?php echo JText::_('COM_JOMBADGER_LANGUAGE'); ?> --</option>
			<?php 
			

			foreach($this->languages as $language):?>
			<option value="<?php echo $language; ?>" <?php echo ($language== $this->sellang) ? ' selected="selected" ' : ''; ?>><?php echo $language; ?></option>
			<?php endforeach;?>
		</select  >
 <select name="sfile" id="sfile" >
 <option>-- <?php echo JText::_('COM_JOMBADGER_FILE'); ?> --</option>
   <option value="site/com_jombadger.ini" <?php echo ($this->selfile== 'site/com_jombadger.ini') ? ' selected="selected" ' : ''; ?>>site/com_jombadger.ini</option>
   <option value="administrator/com_jombadger.ini" <?php echo ($this->selfile== 'administrator/com_jombadger.ini') ? ' selected="selected" ' : ''; ?>>administrator/com_jombadger.ini</option>
 </select>&nbsp;&nbsp;<input name="" type="button" value="<?php echo JText::_("COM_JOMBADGER_EDITOR_OPENFILE");?>" onclick="lFilter()" />
</fieldset>
<?php 
	
		
	if($this->openlang=='' && $this->openfile=='')
		{
			echo '<fieldset><legend>'.JText::_('COM_JOMBADGER_LANGUAGE_FILE').' : '.$this->curlang.'.com_jombadger.ini'.$this->isLangFileWritable.'</legend>';
		}else{
			echo '<fieldset><legend>'.JText::_('COM_JOMBADGER_LANGUAGE_FILE').' : '.$this->openlang.'.'.$this->openfile.$this->isLangFileWritable.'</legend>';
	}
		
	
?>
  
<textarea name="langFileTxtBox" id="langFileTxtBox" cols="120" style="width:100%" rows="20" wrap="off" <?php echo ($this->openlangfile=='')? 'disabled':''; ?>><?php echo $this->openlangfile; ?></textarea>
 </fieldset>
<?php

if($this->openlang=='' && $this->openfile=='')
	{
	echo '<input type="hidden" name="curfile" value="site/com_jombadger.ini" />';
	echo '<input type="hidden" name="curlang" value="'.$this->curlang.'" />';
	}else{
	echo '<input type="hidden" name="curfile" value="'.$this->type.'/'.$this->openfile.'" />';
	echo '<input type="hidden" name="curlang" value="'.$this->sellang.'" />';
	}
?>
<input type="hidden" name="sfileP" value="<?php echo base64_encode($this->fpath); ?>" />
<!--  <input type="hidden" name="view" value="editor" /> -->
<input type="hidden" name="task" value="" />
<?php echo JHTML::_( 'form.token' ); ?>
</form></div>