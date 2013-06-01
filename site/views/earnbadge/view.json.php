<?php
/**
 * @package   JomBadger
 * @subpackage Components
 * components/com_openbadges/jombadger.php
 * @Copyright Copyright (C) 2012 Alain Bolli
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 ******/

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * JSON View class for the openbadges Component : url for backpack
 */

class JomBadgerViewearnbadge extends JView
{
	

	
	function display($tpl = null)
	{
		$model =& $this->getModel();
		$db = $model->connectDB();
		//$path=JURI::base();
		$app=&JFactory::getApplication('site');
        $input = $app->input;
        $id=$input->getInt('id_record');
        $jsonArray=$model->createJsonArray($db,$id);
        $json=json_encode($jsonArray);
        $json=stripslashes($json);
        echo $json;
	}
}
