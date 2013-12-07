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

<form action="<?php echo JRoute::_('index.php?option=com_jombadger&layout=edit&id_badge='.(int) $this->item->id_badge);?>" method="post" name="adminForm" id="adminForm" class="form-validate">
    <?php echo JLayoutHelper::render('joomla.edit.item_title', $this); ?>
    <div class="row-fluid">
    <div class="span10 form-horizontal">
    <fieldset>
        <legend><?php echo JText::_( 'COM_JOMBADGER_BADGE_DETAILS' ); ?></legend>
        <?php
      	foreach($this->form->getFieldset('badge') as $field):?> 
        <div class="control-group">
        	<div class="control-label"><?php echo $field->label;?></div>
        	<div class="controls"><?php echo $field->input;?></div>
        </div>
      	<?php
		endforeach;
		?>
    </fieldset>
  
    
  <!-- begin ACL definition
 
   <div class="clr"></div>
 
   <?php /*if ($this->canDo->get('core.admin')): ?>
      <div class="width-100 fltlft">
         <?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
 
            <?php echo JHtml::_('sliders.panel', JText::_('COM_JOMBADGER_FIELDSET_RULES'), 'access-rules'); ?>
            <fieldset class="panelform">
               <?php echo $this->form->getLabel('rules'); ?>
               <?php echo $this->form->getInput('rules'); ?>
            </fieldset>
 
         <?php echo JHtml::_('sliders.end'); ?>
      </div>
   <?php endif;*/ ?>
 
   <!-- end ACL definition-->  
 
<div>
 
<input type="hidden" name="task" value="badge.cancel" />
<?php echo JHtml::_('form.token'); ?>
</div>  </div></div>
</form>
