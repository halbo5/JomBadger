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

jimport('joomla.application.component.controller');


class openbadgesController extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access    public
	 */
	
function display($cachable=false)
	{
		$input = JFactory::getApplication()->input;
		$input->set('view',$input->getCmd('view', 'openbadges'));
		parent::display($cachable);
		
		// Set the submenu
		OpenBadgesHelper::addSubmenu('badges');
	}
	
}
