<?php 
namespace App\API\Connectors;

use Exception, Session, API;

/**
 * { APIApp }
 * @author cmooy
 * 
 * public functions :
 * 1. getIndex() 						: get index from API 
 * 2. postData() 						: save data to API 
 * 3. getShow() 						: get show from API 
 * 4. deleteData() 						: delete data from API 
 */

class APIApp extends API
{
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * { getIndex }
	 *
	 * @param
	 * 1. $parameter 	: search, filter, sort, pagination     
	 *
	 * @return
	 * 1. index data
	 */
	public function getIndex($parameter = null)
	{
		$this->apiUrl 					= '/my/apps';

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
	 * 1. $data 		: input data     
	 *
	 * @return
	 * 1. response
	 */
	public function postData($data)
	{
		$this->apiUrl 					= '/my/app/store';
		$this->apiData 					= array_merge($this->apiData, ["app" => $data]);

		return $this->post();
	}	

	/**
	 * { getShow }
	 *
	 * @param
	 * 1. $id 			: data Id    
	 *
	 * @return
	 * 1. data show
	 */
	public function getShow($id)
	{
		$this->apiUrl 					= '/my/app/' . $id . '/show';

		return $this->get();
	}	
	
	/**
	 * { deleteData }
	 *
	 * @param
	 * 1. $id 			: data Id    
	 *
	 * @return
	 * 1. data show
	 */	
	public function deleteData($id)
	{
		$this->apiUrl 					= '/my/app/' . $id . '/delete';
		$this->apiData 					= array_merge($this->apiData,  ["id" => $id]);

		return $this->delete();
	}		
}