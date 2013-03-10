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

jimport( 'joomla.application.component.modellist' );


class JomBadgerModelissued extends JModelList
{

	

function getUserId()
	{
		$user	= JFactory::getUser();
		$userid = $user->id;
		return $userid;
	}
	
function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__jb_records');
		$query->order('badgeissuedon DESC');
		
		//filter
		if ($this->getState('filter.search') !== '')
		{
			// Escape the search token.
			$token	= $db->Quote('%'.$db->escape($this->getState('filter.search')).'%');

			// Compile the different search clauses.
			$searches	= array();
			$searches[]	= '#__jb_records.earnername LIKE '.$token;
			$searches[]	= '#__jb_records.earneremail LIKE '.$token;
			$searches[]	= '#__jb_records.badgename LIKE '.$token;
			$searches[]	= '#__jb_records.badgeissuedon LIKE '.$token;

			// Add the clauses to the query.
			$query->where('('.implode(' OR ', $searches).')');
		}
		
		return $query;
	}


protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');
 
		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
 
		$state = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $state);
 
		// List state information.
		parent::populateState($ordering = null, $direction = null);
	}		
		

	
	protected function canDelete($record)
	{
		if( !empty( $record->id ) ){
			$user = JFactory::getUser();
			return $user->authorise( "core.delete", "com_jombadger.record." . $record->id );
		}
	}	
	
}