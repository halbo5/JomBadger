<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

?>
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?> 

<form action="<?php echo JRoute::_('index.php?option=com_jombadger');?>" method="post" name="adminForm" id="adminForm" class="form-validate">
   <?php echo "<p>".JText::_('COM_JOMBADGER_ISSUER_INTROTEXT').".</p>"; ?>
    <div class="row-fluid">
    <div class="span10 form-horizontal">
    <fieldset>
        <div class="control-group">
      	<?php
      	foreach($this->form->getFieldset() as $field):
      	?> 
        <div class="control-group">
      		<div class="control-label"><?php echo $field->label;?></div>
      		<div class="controls"><?php	echo $field->input;?></div>
      	</div>
      	<?php 
		endforeach;
		?>
		</div>
</fieldset>
</div>
</div>
 
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>
</div></div>
