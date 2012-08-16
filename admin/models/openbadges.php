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

jimport( 'joomla.application.component.modellist' );


class openbadgesModelopenbadges extends JModelList
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
		$query->select('id_badge,#__ob_badges.name as name, #__ob_badges.image as image, #__ob_badges.description as description, criteria_url,expires, catid, #__categories.title as catname');
		$query->from('#__ob_badges');
		$query->leftjoin('#__categories on catid=#__categories.id');
		$query->order('name');
		
		//filter
		if ($this->getState('filter.search') !== '')
		{
			// Escape the search token.
			$token	= $db->Quote('%'.$db->escape($this->getState('filter.search')).'%');

			// Compile the different search clauses.
			$searches	= array();
			$searches[]	= '#__ob_badges.name LIKE '.$token;
			$searches[]	= '#__ob_badges.description LIKE '.$token;
			$searches[]	= '#__ob_badges.expires LIKE '.$token;
			$searches[]	= '#__categories.title LIKE '.$token;

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
		

}