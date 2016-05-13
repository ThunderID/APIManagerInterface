<?php 

namespace App\API\Connectors;

use Exception, Session, API;

/**
 * { APIUser }
 * @author Chelsy
 * 
 * public functions :
 * 1. getIndex() 						: get index from API 
 */

class APIUser extends API
{
	function __construct() 
	{
		$this->basic_url 				= 'http://hris-api';
		
		parent::__construct();
	}

	/**
	 * { getIndex }
	 *
	 * @param
	 * 1. $client_id 		: org id    
	 * 2. $parameter 	: search, filter, sort, pagination     
	 *
	 * @return
	 * 1. index data
	 */
	public function getIndex($parameter = null)
	{
		$this->apiUrl 					= '/organisation/0/employees';

		if(!is_null($parameter))
		{
			$this->apiData 				= array_merge($this->apiData, $parameter);
		}

		return $this->get($this->apiUrl);
	}	
}