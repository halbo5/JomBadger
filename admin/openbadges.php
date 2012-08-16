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

// Access check: is this user allowed to access the backend of this component?
if (!JFactory::getUser()->authorise('core.manage', 'com_openbadges')) 
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// require helper file
JLoader::register('OpenBadgesHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'openbadges.php');

// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed by openbadges
$controller = JController::getInstance('openbadges');
 
// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();