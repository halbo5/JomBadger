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
 
<form action="<?php echo JRoute::_('index.php?option=com_jombadger&layout=edit&id_issuer='.(int) $this->item->id_issuer);?>" method="post" name="adminForm" id="badge-form" class="form-validate">
    <fieldset class="adminform">
        <legend><?php echo JText::_( 'COM_JOMBADGER_ISSUER_DETAILS' ); ?></legend>
        <ul class="adminformlist">
      	<?php
      	foreach($this->form->getFieldset('issuerorganization') as $field): 
        echo "<li>".$field->label;echo $field->input."</li>";
		endforeach;
		?>
		</ul>
    </fieldset>
    
  <!-- begin ACL definition-->
 
   <div class="clr"></div>
 
   <?php if ($this->canDo->get('core.admin')): ?>
      <div class="width-100 fltlft">
         <?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
 
            <?php echo JHtml::_('sliders.panel', JText::_('COM_JOMBADGER_FIELDSET_RULES'), 'access-rules'); ?>
            <fieldset class="panelform">
               <?php echo $this->form->getLabel('rules'); ?>
               <?php echo $this->form->getInput('rules'); ?>
            </fieldset>
 
         <?php echo JHtml::_('sliders.end'); ?>
      </div>
   <?php endif; ?>
 
   <!-- end ACL definition-->  
 
<div>
 
<input type="hidden" name="task" value="issuerorganization.edit" />
<?php echo JHtml::_('form.token'); ?>
</div>
</form>
