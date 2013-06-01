<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class com_jombadgerInstallerScript
{
        /*
         * $parent is the class calling this method.
         * $type is the type of change (install, update or discover_install, not uninstall).
         * preflight runs before anything else and while the extracted files are in the uploaded temp folder.
         * If preflight returns false, Joomla will abort the update and undo everything already done.
         */
        function preflight( $type, $parent ) {
                $jversion = new JVersion();
 
                // Installing component manifest file version
                $this->release = $parent->get( "manifest" )->version;
 
                // Manifest file minimum Joomla version
                $this->minimum_joomla_release = $parent->get( "manifest" )->attributes()->version;   
 
                // Show the essential information at the install/update back-end
                echo '<p>'.JTEXT::_("COM_JOMBADGER_INSTALLING_COMPONENT_VERSION").' : ' . $this->release;
                echo '<br />'.JTEXT::_("COM_JOMBADGER_COMPONENT_CURRENT_VERSION").' : ' . $this->getParam('version');
                echo '<br />'.JTEXT::_("COM_JOMBADGER_MINIMUM_JOOMLA_VERSION").' : ' . $this->minimum_joomla_release;
                echo '<br />'.JTEXT::_("COM_JOMBADGER_CURRENT_JOOMLA_VERSION").' : '. $jversion->getShortVersion();
 
                // abort if the current Joomla release is older
                if( version_compare( $jversion->getShortVersion(), $this->minimum_joomla_release, 'lt' ) ) {
                        Jerror::raiseWarning(null, 'Cannot install com_jombadger in a Joomla release prior to '.$this->minimum_joomla_release);
                        return false;
                }
 
                // abort if the component being installed is not newer than the currently installed version
                if ( $type == 'update' ) {
                        $oldRelease = $this->getParam('version');
                        $rel = $oldRelease . ' to ' . $this->release;
                        if ( version_compare( $this->release, $oldRelease, 'le' ) ) {
                                //Jerror::raiseWarning(null, 'Incorrect version sequence. Cannot upgrade ' . $rel);
                               // return false;
                        }
                }
                else { $rel = $this->release; }
 
        }
 
        /*
         * $parent is the class calling this method.
         * install runs after the database scripts are executed.
         * If the extension is new, the install method is run.
         * If install returns false, Joomla will abort the install and undo everything already done.
         */
        function install( $parent ) {
                
                // You can have the backend jump directly to the newly installed component configuration page
                $parent->getParent()->setRedirectURL('index.php?option=com_jombadger');
        }
 
        /*
         * $parent is the class calling this method.
         * update runs after the database scripts are executed.
         * If the extension exists, then the update method is run.
         * If this returns false, Joomla will abort the update and undo everything already done.
         */
        function update( $parent ) {

        	$this->release = $parent->get( "manifest" )->version;
            if ($this->release=="0.99")
            	{
        		//search issuer datas in parameters and add in new table #__jb_issuer
        		$db = JFactory::getDbo();
  				$db->setQuery('SELECT params FROM #__extensions WHERE name = "com_jombadger"');
  				$params = json_decode( $db->loadResult(), true );
        		$issuer->url=$params['issuerurl'];
        		$issuer->name=$params['issuerorg'];
        		$issuer->mail=$params['issuercontact'];

        		//add in database
        		$query = $db->getQuery(true);
        		$columns = array('issuer_name', 'issuer_url', 'issuer_email');
        		$values = array($db->quote($issuer->name), $db->quote($issuer->url),$db->quote($issuer->mail));
        		$query
        		->insert($db->quoteName('#__jb_issuer'))
        		->columns($db->quoteName($columns))
        		->values(implode(',', $values));
        		$db->setQuery($query);
        		
        		try {
        			// Execute the query in Joomla 2.5. change with $db->execute() in joomla 3
        			$result = $db->query();
        			} catch (Exception $e) {
        			// catch any database errors.
        			}   	
            	}
        	// You can have the backend jump directly to the newly updated component configuration page
            $parent->getParent()->setRedirectURL('index.php?option=com_jombadger');
        }
 
        /*
         * $parent is the class calling this method.
         * $type is the type of change (install, update or discover_install, not uninstall).
         * postflight is run after the extension is registered in the database.
         */
        function postflight( $type, $parent ) {
                //nothing to do
        }
 
        /*
         * $parent is the class calling this method
         * uninstall runs before any other action is taken (file removal or database processing).
         */
        function uninstall( $parent ) {
                //nothing to do
        }
 
        /*
         * get a variable from the manifest file (actually, from the manifest cache).
         */
        function getParam( $name ) {
                $db = JFactory::getDbo();
                $db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_jombadger"');
                $manifest = json_decode( $db->loadResult(), true );
                return $manifest[ $name ];
        }
 

}