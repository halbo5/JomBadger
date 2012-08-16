<?php
/**
 * @package   openbadges
 * @subpackage Components
 * components/com_openbadges/openbadges.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

// import Joomla formrule library
jimport('joomla.form.formrule');

class JFormRuleDate extends JFormRule
{
	/**
	 * The regular expression.
	 *
	 * @access	protected
	 * @var		string
	 * @since	2.5
	 */
	protected $regex = '^(\d{4}[\/\-](0?[0-9]|1[012])[\/\-](0?[0-9]|[12][0-9]|3[01]))*$';
}
