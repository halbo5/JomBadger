<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/
define('_JEXEC',1);
defined('_JEXEC') or die('Restricted access');

 $cache_expire = 60*60*24*365;
 header("Pragma: public");
 header("Cache-Control: max-age=".$cache_expire);
 header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
 $langtag=(isset($_GET['lang']))?$_GET['lang']:"fr_FR";
 echo "<script src=\"//connect.facebook.net/$langtag/all.js\"></script>";
 ?>