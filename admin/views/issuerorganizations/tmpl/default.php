<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

defined('_JEXEC') or die('Restricted access'); 

//adding tooltip
JHtml::_('behavior.tooltip');

$userid=$this->userid;
//$items=$this->items;

//var_dump($badges);

// Must be logged in
		if ($userid < 1) {
			//JError::raiseError( 403, JText::_('ALERTNONAUTH') );
			return;
		}
?>
<?php 		
echo "<br /><h1>".JTEXT::_("COM_JOMBADGER_LIST_ISSUER_ORGANIZATIONS")."</h1>";
echo "<p>".JTEXT::_("COM_JOMBADGER_TEXT_BEFORE_TABLE_ISSUER_ORGANIZATIONS")."</p>";
?>
<form action="<?php echo JRoute::_('index.php?option=com_jombadger'); ?>" method="post" name="adminForm" id=adminForm>
<fieldset id="filter-bar">
<div class="filter-search fltlft">
	<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
	<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_MYCOMPANY_SEARCH_IN_TITLE'); ?>" />
	<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
	<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
</div>
</fieldset>
	<div class="clr"> </div>
<table class="adminlist">
<thead><?php echo $this->loadTemplate('head');?></thead>
<tbody><?php echo $this->loadTemplate('body');?></tbody>
<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
</table>

<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<?php //<input type="hidden" name="controller" value="badge" />?>
<?php echo JHtml::_('form.token'); ?>
</form>
