<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

defined('_JEXEC') or die('Restricted access'); 
 ?>

<tr>
<th width="20">
    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
</th>
<th width="20">Id</th><th><?php echo JTEXT::_("COM_JOMBADGER_BADGEIMAGE");?></th><th><?php echo JTEXT::_("COM_JOMBADGER_BADGENAME"); ?></th>
<th><?php echo JTEXT::_("COM_JOMBADGER_BADGECATEGORY"); ?></th>
<th><?php echo JTEXT::_("COM_JOMBADGER_BADGEDESCRIPTION"); ?></th>
<th><?php echo JTEXT::_("COM_JOMBADGER_BADGECRITERIAURL"); ?></th>
<th><?php echo JTEXT::_("COM_JOMBADGER_BADGEEXPIRES"); ?></th>
</tr>
