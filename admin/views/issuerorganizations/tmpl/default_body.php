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
		$id=$row->id_issuer;
		$issuer_name=$row->issuer_name;
		$issuer_url=$row->issuer_url;
		$issuer_email=$row->issuer_email;
		$checked=JHTML::_('grid.id,',$i,$row->id_issuer);
		$link = JRoute::_( 'index.php?option=com_jombadger&task=issuerorganization.edit&id_issuer='. $row->id_issuer );
			
		echo "<tr class=\"row$k\"><td>$checked</td><td>".$row->id_issuer."</td>";
		echo "<td><a href=\"".$link."\">".$issuer_name."</td>";
		echo "<td>$issuer_url</td><td>$issuer_email</td>";
		$k=1-$k;	
	}
?>
</tbody>