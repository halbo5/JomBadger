<?php
/**
 * @package   openbadges
 * @subpackage Components
 * components/com_openbadges/openbadges.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controlleradmin');


class openbadgesControlleropenbadges extends JControllerAdmin
{

	public function getModel($name = 'badge', $prefix = 'openbadgesModel') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

}