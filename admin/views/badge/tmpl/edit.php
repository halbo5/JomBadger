<?php
/**
 * @package   openbadges
 * @subpackage Components
 * components/com_openbadges/openbadges.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>
 
<form action="<?php echo JRoute::_('index.php?option=com_openbadges&layout=edit&id_badge='.(int) $this->item->id_badge);?>" method="post" name="adminForm" id="badge-form" class="form-validate">
    <fieldset class="adminform">
        <legend><?php echo JText::_( 'COM_OPENBADGES_DETAILS' ); ?></legend>
        <ul class="adminformlist">
      	<?php
      	foreach($this->form->getFieldset() as $field): 
        echo "<li>".$field->label;echo $field->input."</li>";
		endforeach;
		?>
		</ul>
    </fieldset>
 
<div>
 
<input type="hidden" name="task" value="badge.edit" />
<?php echo JHtml::_('form.token'); ?>
</div>
</form>
