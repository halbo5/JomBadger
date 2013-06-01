<?php
/**
 * @package   Jombadger
 * @subpackage Components
 * components/com_jombadger/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by openbadges
$controller = JControllerLegacy::getInstance('JomBadger');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
