<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

defined('_JEXEC') or die;

//adding tooltip
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$userid=$this->userid;
//$items=$this->items;

//var_dump($badges);

// Must be logged in
		if ($userid < 1) {
			//JError::raiseError( 403, JText::_('ALERTNONAUTH') );
			return;
		}
?>

<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?> 

<form action="<?php echo JRoute::_('index.php?option=com_jombadger'); ?>" method="post" name="adminForm" id=adminForm>

<div id="j-main-container">

<div id="filter-bar" class="btn-toolbar">
<div class="filter-search btn-group pull-left">
	<label class="element-invisible" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
	<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_JOMBADGER_SEARCH_IN_TITLE'); ?>" />
</div>
<div class="btn-group pull-left">
	<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
	<button type="button" class="btn" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
</div>
</div>

	<div class="clr"> </div>
<table class="table table-striped">
<thead><?php echo $this->loadTemplate('head');?></thead>
<tbody><?php echo $this->loadTemplate('body');?></tbody>
<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
</table>

<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<?php //<input type="hidden" name="controller" value="badge" />?>
<?php echo JHtml::_('form.token'); ?>
</div>
</form></div>
