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

jimport('joomla.application.component.controllerform');


class JomBadgerControllerbadge extends JControllerForm
{

	function __construct() {
		//by default, the list view is the plural of the edit view, we change that here
      $this->view_list = 'openbadges';
   
      parent::__construct();
   }
   
   
   /**
    * Implement to allowAdd or not
    *
    * Not used at this time (but you can look at how other components use it....)
    * Overwrites: JControllerForm::allowAdd
    *
    * @param array $data
    * @return bool
    */
   protected function allowAdd($data = array())
   {
   	return parent::allowAdd($data);
   }
   
   /**
    * Implement to allow edit or not
    * Overwrites: JControllerForm::allowEdit
    *
    * @param array $data
    * @param string $key
    * @return bool
    */
   protected function allowEdit($data = array(), $key = 'id')
   {
   	$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
   	if( !empty( $id ) ){
   		$user = JFactory::getUser();
   		return $user->authorise( "core.edit", "com_jombadger.badge." . $id );
   	}
   }  

}