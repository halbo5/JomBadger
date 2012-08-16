<?php
/**
 * @package   openbadges
 * @subpackage Components
 * components/com_openbadges/openbadges.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

defined('_JEXEC') or die('Restricted access'); 
 ?>

<tr>
<th width="20">
    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
</th>
<th width="20">Id</th><th><?php echo JTEXT::_("COM_OPENBADGES_BADGEIMAGE");?></th><th><?php echo JTEXT::_("COM_OPENBADGES_BADGENAME"); ?></th>
<th><?php echo JTEXT::_("COM_OPENBADGES_BADGECATEGORY"); ?></th>
<th><?php echo JTEXT::_("COM_OPENBADGES_BADGEDESCRIPTION"); ?></th>
<th><?php echo JTEXT::_("COM_OPENBADGES_BADGECRITERIAURL"); ?></th>
<th><?php echo JTEXT::_("COM_OPENBADGES_BADGEEXPIRES"); ?></th>
</tr>
