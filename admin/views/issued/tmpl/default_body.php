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

<tbody>
<?php 
	$k=0;
	for ($i=0,$n=count($this->items);$i<$n;$i++)
	{
		$row=& $this->items[$i];
		$transmitted=($row->transfered==1)?JText::_("COM_JOMBADGER_OUI"):JText::_("COM_JOMBADGER_NON");
		//$checked=JHTML::_('grid.id,',$i,$row->id_badge);
		//$link = JRoute::_( 'index.php?option=com_jombadger&task=badge.edit&id_badge='. $row->id_badge );
			
		echo "<tr class=\"row$k\"><td>".$row->id_record."</td>";
		echo "<td>".$row->earnername."</td>";
		echo "<td>".$row->earneremail."</td><td>".$row->name."</td><td>".$row->badgeissuedon."</td>";
		echo "<td>$transmitted</td></tr>";
		$k=1-$k;	
	}
?>
</tbody>