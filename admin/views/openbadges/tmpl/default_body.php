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
		$id=$row->id_badge;
		$state=$row->state;
		$image=$row->image;
		$name=$row->name;
		$description=$row->description;
		$criteria_url=$row->criteria_url;
		$expires=($row->expires=="0000-00-00")?"":$row->expires;
		$checked=JHTML::_('grid.id,',$i,$row->id_badge);
		$published=JHTML::_('jgrid.published',$row->state,$i,'openbadges.');
		$link = JRoute::_( 'index.php?option=com_jombadger&task=badge.edit&id_badge='. $row->id_badge );
			
		echo "<tr class=\"row$k\"><td>$checked</td><td>$published</td><td>".$row->id_badge."</td>";
		echo "<td><img src='".$row->image."' alt='".$row->name."' title='".$row->name."' height='90' width='90' /></td>";
		echo "<td><a href=\"".$link."\">".$row->name."</td><td>".$row->catname."</td><td>".$description."</td>";
		echo "<td><a href='".$criteria_url."'>".JTEXT::_("COM_JOMBADGER_BADGECRITERIAURLGO")."</a></td><td>$expires</td></tr>";
		$k=1-$k;	
	}
?>
</tbody>