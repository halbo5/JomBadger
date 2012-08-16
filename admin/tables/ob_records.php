<?php
/**
 * @package   openbadges
 * @subpackage Components
 * components/com_openbadges/openbadges.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/
 
// No direct access
defined('_JEXEC') or die('Restricted access');
 

class Tableob_records extends JTable
{
    
 
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct( &$db ) {
        parent::__construct('#__ob_records', 'id_record', $db);
    }
}
