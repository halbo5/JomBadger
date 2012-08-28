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

jimport( 'joomla.application.component.modelitem' );


class JomBadgerModeleditor extends JModelItem
{

	
function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}

function is__Filewritable($path) {
			if(file_exists($path))
			{
				if(is_writable($path))
				{
					return 2;
				}else{
					return 1;
				}
			}else{
				return 0;
			}
		}


function openfiles($lFile){
		if(!file_exists($lFile))
			  {  
			  	
			  	$openlang = JRequest::getVar( 'lang');
  				$openfile = JRequest::getVar( 'mfile');
				$msg = JText::_("COM_JOMBADGER_LANGUAGEFILE_NOTFOUND");
				$app =& JFactory::getApplication();
				$app->redirect('index.php?option=com_jombadger&view=editor&op=1&lang='.$openlang.'&mfile='.$openfile, $msg,'error');
					
			  }
			  else
			  {
				$fh = fopen($lFile, 'r');
				$fData = fread($fh, filesize($lFile));
				fclose($fh);
				return $fData;
			}
		}
		

function languages(){
        $path = JPATH_ROOT . '/components/com_jombadger/language/';
        $langs = array();
        if (is_dir($path)) {
            $dh = opendir($path);
            if ($dh) {
                while (($file = readdir($dh)) !== false) {
                    if(!in_array($file, array('.', '..', 'pdf_fonts','overrides')) && is_dir($path . $file)){
                        $langs[$file] = $file;
                    }
                }
                closedir($dh);
            }
        }
        ksort($langs);
        return $langs;
    }
	

}