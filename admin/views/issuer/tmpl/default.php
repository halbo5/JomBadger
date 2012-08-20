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

?>
 
<form action="<?php echo JRoute::_('index.php?option=com_jombadger');?>" method="post" name="adminForm" id="issuer-form" class="form-validate">
   <?php echo "<p>".JText::_('COM_JOMBADGER_ISSUER_INTROTEXT')."</p>"; ?>
    <fieldset class="adminform">
        <ul class="adminformlist">
      	<?php
      	foreach($this->form->getFieldset() as $field): 
        echo "<li>".$field->label;echo $field->input."</li>";
		endforeach;
		?>
		</ul>
</fieldset>
 
<div>
 
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</div>
</form>
