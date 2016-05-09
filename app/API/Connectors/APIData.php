<?php 

namespace App\API\Connectors;

use App\API\API;
use Exception, Session, Redirect, Route;

/**
 * { APIData }
 * @author Budi
 * 
 * public functions :
 * 1. get() 							: get request API 
 * 2. post() 							: post request API 
 * 3. delete() 							: delete request API 
 * 
 * private functions :
 * 1. validateResponse 					: validate response from API server
 */

abstract class APIData
{
	protected $apiUrl;
	protected $apiData;

	function __construct() 
	{
		$this->api 					= new API;

		$this->apiData 				= ['access_token' => Session::get('access_token')];

		if(is_null(Session::get('access_token')) && Route::currentroutename()!='auth.postLogin')
		{
			Redirect::route('auth.getLogin')->send();
		}

		if(isset($this->basic_url))
		{
			$this->api->basic_url 	= $this->basic_url;
		}
	}

	/**
	 * { get }
	 *
	 * @param     
	 *
	 * @return
	 * 1. API response
	 */
	protected function get()
	{
		$queryString 				= Null;

		foreach ($this->apiData as $title => $data) {
			if(is_array($data))
			{
				foreach ($data as $subTitle => $subData) {
					if(!is_null($subData) || !empty($subData))
					{
						if(is_array($subData))
						{
							foreach ($subData as $subTitle2 => $subData2) {
								if(!is_null($subData2) || !empty($subData2))
								{
									$queryString = $queryString . $title . "[" .  $subTitle . "][" .  $subTitle2 . "]=" . $subData2 . "&";				
								}
							}
						}
						else
						{
							$queryString = $queryString . $title . "[" .  $subTitle . "]=" . $subData . "&";				
						}

					}
				}
			}
			else
			{
				$queryString 		= $queryString . $title . "=" . $data . "&";
			}		
		}		

		$queryString 				= str_replace(' ', '%20', $queryString);

		$this->apiUrl				= $this->apiUrl . '?' . $queryString;

		$result 					= json_decode($this->api->get($this->apiUrl), true);

		return $this->validateResponse($result);
	}


	/**
	 * { post }
	 *
	 * @param     
	 *
	 * @return
	 * 1. API response
	 */
	protected function post()
	{
		$result 					= json_decode($this->api->post($this->apiUrl, $this->apiData),true);

		return $this->validateResponse($result);
	}


	/**
	 * { delete }
	 *
	 * @param     
	 *
	 * @return
	 * 1. API response
	 */
	protected function delete()
	{
		$queryString 				= null;

		foreach ($this->apiData as $key => $data) 
		{
			$queryString 			= $queryString . $key . '=' . $data . '&' ;
		}

		$this->apiUrl				= $this->apiUrl . '?' . $queryString;

		$result 					= json_decode($this->api->delete($this->apiUrl), true);		

		return $this->validateResponse($result);
	}	


	/**
	 * { validateResponse }
	 *
	 * @param     
	 * 1. $result 							: response being validate
	 *
	 * @return
	 * 1. $result
	 */
	private function validateResponse($result)
	{
		// validate response
		try 
		{
		    if(empty($result['status']))
		    {
				print_r("RESPONSE ERROR : NO STATUS FROM SERVER!");
				dd($result);
		    }

		  //   if(empty($result['data']))
		  //   {
				// print_r("RESPONSE ERROR : NO DATA FROM SERVER!");
				// dd($result);
		  //   }
		} 
		catch (Exception $e) 
		{
			print_r("ERROR : UNKNOWN RESPONSE FROM SERVER!");
			dd($result);
		}

		// data
		if(is_null($result['data']))
		{
			$result['data'] 		= [];
		}

		return $result;
	}
}