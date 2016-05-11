<?php 

namespace App\API\Connectors;

use Exception, Session, API;

/**
 * { APIAcl }
 * @author Chelsy
 * 
 * public functions :
 * 1. getIndex() 						: get index from API 
 * 2. postData() 						: save data to API 
 * 3. getShow() 						: get show from API 
 * 4. deleteData() 						: delete data from API 
 */

class APIAcl extends API
{
	function __construct() 
	{
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
	public function getIndex($client_id = 0, $parameter = null)
	{
		$this->apiUrl 					= '/my/app'.'/'.$client_id.'/acls';

		if(!is_null($parameter))
		{
			$this->apiData 				= array_merge($this->apiData, $parameter);
		}

		return $this->get();
	}	

	/**
	 * { postData }
	 *
	 * @param
	 * 1. $client_id 		: org id    
	 * 2. $data 		: input data     
	 *
	 * @return
	 * 1. response
	 */
	public function postData($client_id = 0, $data)
	{
		$this->apiUrl 					= '/my/app/acl/store';
		$this->apiData 					= array_merge($this->apiData, $data);

		return $this->post();
	}	

	/**
	 * { getShow }
	 *
	 * @param
	 * 1. $client_id 		: org id    
	 * 2. $id 			: data Id    
	 *
	 * @return
	 * 1. data show
	 */
	public function getShow($client_id = 0, $id)
	{
		$this->apiUrl 					= '/my/app'.'/'.$client_id.'/acl/' . $id . '/show';

		return $this->get();
	}	
	
	/**
	 * { deleteData }
	 *
	 * @param
	 * 1. $client_id 		: org id    
	 * 2. $id 			: data Id    
	 *
	 * @return
	 * 1. data show
	 */	
	public function deleteData($client_id = 0, $id)
	{
		$this->apiUrl 					= '/my/app'.'/'.$client_id.'/acl/' . $id. '/delete';
		$this->apiData 					= array_merge($this->apiData,  ["id" => $id]);

		return $this->delete();
	}		
}