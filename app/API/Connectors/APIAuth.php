<?php 
namespace App\API\Connectors;

use Exception, Session, API;

/**
 * { ApiAuth }
 * @author cmooy
 * 
 * public functions :
 * 1. loggedIn() 						: get index from API 
 */

class APIAuth extends API
{
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * { loggedIn }
	 *
	 * @param
	 * 1. $data 		: input data     
	 *
	 * @return
	 * 1. response
	 */
	public function loggedIn($data)
	{
		$this->apiUrl 					= '/authorized/client';
		$this->apiData 					= array_merge($this->apiData, $data);

		return $this->post();
	}	

	/**
	 * { loggedOut }
	 *
	 * @param
	 * 1. $data 		: input data     
	 *
	 * @return
	 * 1. response
	 */
	public function loggedOut($data)
	{
		$this->apiUrl 					= '/close/session';
		$this->apiData 					= array_merge($this->apiData, $data);
		
		return $this->get();
	}	
}