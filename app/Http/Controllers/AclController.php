<?php 

namespace App\Http\Controllers;

use App\API\Connectors\APIAcl;
use App\API\Connectors\APIApp;
use App\API\Connectors\APIUser;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Helper\SortList;
use Input, Route;

/**
 * { AclController Class }
 * @author Budi
 * 
 * public functions :
 * 1. index()                           : public function display index org
 * 2. show()                            : public function display show org
 * 3. create()                          : public function display create org
 * 4. edit()                            : public function display edit org
 * 5. store()                           : public function store data org
 * 6. update()                          : public function update data org
 * 7. destroy()                         : public function destroy data org
 * 8. FindaclByName()                : ajax search acl by name
 * 
 */

class AclController extends BaseController 
{
	//init 
	protected $view_source_root                     = 'content.acls';
	
	public function __construct()
	{
		parent::__construct();

		$this->page_attributes->page_title             = 'ACL';
		$this->page_attributes->breadcrumb             =    [
															];
															
        $this->middleware('password.needed', ['only' => ['destroy']]);

	}

	/**
	 * { index }
	 *
	 * @param     
	 *
	 * @return
	 */
	public function index($client_id = 0)
	{
		//1. validate
		if(is_null($client_id))
		{
			App::abort(403, 'Id Client tidak ada');
		}

		//2. get data
		$SortList                                   = new SortList;

		$this->page_attributes->page_subtitle       = 'index';
		//dummy
		$this->page_attributes->filters             =   [
															'b'             => ['ab', 'ba'],
															'c'             => ['ac', 'ca'],
														];
		//dummy
		$this->page_attributes->sorts               =   [
															'nama'          => $SortList->getSortingList('nama')
														];       

		//2. get data parameter
		$data_parameter                             = $this->setPageDataParameter();

		//3. get data
		$APIAcl										= new APIAcl;
		$search                                     = array_merge(
															['username' => $data_parameter['search']],
															$data_parameter['filter']
														);
		$APIAcl										= new APIAcl;

		$data                                       = $APIAcl->getIndex($client_id, [
														'search'    => $search,
														'sort'      => $data_parameter['sort'],
														'take'      => $data_parameter['take'],
														'skip'      => ($data_parameter['page'] - 1) * $data_parameter['take'],
														]);

		//4. set page datas
		$this->page_datas->datas['acls']			= $data['data']['data'];
		$this->page_datas->datas['client']			= $data['data']['client'];

		//5. generate view
		$this->page_attributes->breadcrumb          = array_merge(
															$this->page_attributes->breadcrumb,
															[
																$data['data']['client']['name'] => route('apps.index'),
																'ACL' => route('acls.index', ['client_id' => $client_id]),
															]
														);

		$view_source                                = $this->view_source_root . '.index';
		$route_source                               = route(Route::CurrentRouteName());

		return $this->generateView($view_source, $route_source);
	}

	/**
	 * { show }
	 *
	 * @param     
	 * 1. id
	 * 2. client_id
	 *
	 * @return
	 * 1. Layout
	 * 2. page_attributes
	 * 3. page_datas
	 * 
	 * steps
	 * 1. validate
	 * 2. get data
	 * 3. set page attributes
	 * 4. set page datas
	 * 5. generate view
	 */
	public function show($client_id = null, $id = null)
	{
		//1. validate
		if(is_null($client_id))
		{
			App::abort(403, 'Id Client tidak ada');
		}
		if(is_null($id))
		{
			App::abort(403, 'Id ACL tidak ada');
		}        

		//2. get data
		$APIAcl									= new APIAcl;
		$data                                       = $APIAcl->getShow($client_id, $id);  

		$acls									= $APIAcl->getIndex($client_id, [
														]);


		//3. set page attributes
		$this->page_attributes->page_title			= $data['data']['name'];     
		$this->page_attributes->page_subtitle       = $data['data']['name'];     
		$this->page_attributes->breadcrumb          = array_merge(
															$this->page_attributes->breadcrumb,
															[
																$data['data']['organisation']['name'] => route('org.show', ['id' => $client_id]),
																'ACL' => route('acls.index', ['client_id' => $client_id]),
																$data['data']['name'] => route(Route::CurrentRouteName(), ['client_id' => $client_id, 'id' => $id]),
															]
														);


		// dd($this->page_datas->datas['charts']	);
		$this->page_datas->datas['acls']		= $acls['data']['data'];
		$this->page_datas->datas['acl']			= $data['data'];
		$this->page_datas->datas['id']				= $client_id;
		$this->page_datas->datas['name']			= $data['data']['organisation']['name'];
		$this->page_datas->cust_paging              = 0;
		
		//5. generate view
		$view_source                                = $this->view_source_root . '.show';
		$route_source                               = route(Route::CurrentRouteName(),['client_id' => $client_id, 'id' => $id]);

		return $this->generateView($view_source, $route_source);
	}  

	/**
	 * { create }
	 *
	 * @param     
	 * 1. id
	 * 2. client_id
	 *
	 * @return
	 * 1. Layout
	 * 2. page_attributes
	 * 3. page_datas
	 * 
	 * steps
	 * 1. validate
	 * 2. get data
	 * 3. set page attributes
	 * 4. set page datas
	 * 5. generate view
	 */
	public function create($client_id = null, $id = null)
	{
		// //1. validate
		if(is_null($client_id))
		{
			App::abort(403, 'Id Client tidak ada');
		}

		// // 2 & 3        
		$APIApp										= new APIApp;
		$org										= $APIApp->getShow($client_id);

		$APIUser									= new APIUser;
		$users										= $APIUser->getIndex();

		if(!is_null($id))
		{
			//2. get data
			$APIAcl									= new APIAcl;
			$data									= $APIAcl->getShow($client_id, $id);  

			//3. set page attributes
			$current_route							= route(Route::CurrentRouteName(),['client_id' => $client_id ,'id' => $id]);

			$this->page_attributes->page_subtitle	= 'Edit ACL '.$data['data']['user']['name'];
			$this->page_attributes->breadcrumb		= array_merge(
															$this->page_attributes->breadcrumb,
															[
																'Apps'		=> route('apps.show', ['id' => $client_id]),
																'ACL' => route('acls.index', ['client_id' => $client_id]),
																'Edit ACL ' . $data['data']['user']['name'] => $current_route,
															]
														);
			$data['data']['grant_id']				= $data['data']['grant']['id'];
			$data['data']['grant_name']				= $data['data']['grant']['name'];
			$data['data']['client_id']				= $data['data']['grant']['client_id'];
			$data['data']['user_id']				= $data['data']['user_id'];
			$data['data']['scopes'][0]				= 'employee';
                        
		}
		else
		{
			//2. get data
			$data['data']['id']						= "";
			$data['data']['grant_id']				= null;
			$data['data']['grant_name']				= null;
			$data['data']['client_id']				= null;
			$data['data']['user_id']				= null;
			$data['data']['scopes'][0]				= 'employee';


			//3. set page attributes
			$current_route							= route(Route::CurrentRouteName(),['client_id' => $client_id]);

			$this->page_attributes->page_subtitle	= 'ACL Baru';
			$this->page_attributes->breadcrumb		= array_merge(
															$this->page_attributes->breadcrumb,
															[
																'Apps'		=> route('apps.show', ['id' => $client_id]),
																'ACL' 		=> route('acls.index', ['client_id' => $client_id]),
																'ACL Baru' 	=> $current_route,
															]
														);
		}

		// $APIAcl									= new APIAcl;
		// $acls									= $APIAcl->getIndex($client_id, [
		// 												]);

		//4. set page datas
		$this->page_datas->datas['id']				= $client_id;
		// $this->page_datas->datas['name']			= $org['data']['name'];
		$this->page_datas->datas['acl']				= $data['data'];
		$this->page_datas->datas['client']			= $org['data'];

		//5. generate view
		$view_source								= $this->view_source_root . '.create';
		$route_source								= $current_route;

		return $this->generateView($view_source, $route_source);
	}


	/**
	 * { edit }
	 *
	 * @param     
	 * 1. id
	 * 2. client_id
	 *
	 * @return
	 * 1. call function create()
	 */
	public function edit($client_id = null, $id = null)
	{
		return $this->create($client_id, $id);
	}

	/**
	 * { store }
	 *
	 * @param     
	 * 1. id
	 * 2. client_id
	 * 3. input name
	 * 4. input address
	 * 5. input email
	 * 6. input phone
	 *
	 * @return
	 * 1. response
	 * 
	 * steps
	 * 1. validate
	 * 2. get input
	 * 3. get data
	 * 4. post to API
	 * 5. return response
	 */
	public function store($client_id = null, $id = null)
	{
		//1. validate
		if(is_null($client_id))
		{
			App::abort(403, 'Id Client tidak ada');
		}

		//2. get input
		$input['grant_id']						= Input::get('grant_id');
		$input['grant_name']					= Input::get('grant_name');
		$input['client_id']						= Input::get('client_id');
		$input['user_id']						= Input::get('user_id');

		//3. get data
		if(!is_null($id))
		{
			$APIAcl								= new APIAcl;
			$data								= $APIAcl->getShow($client_id,$id)['data'];

			$data['grant_id']					= $input['grant_id'];
			$data['grant_name']					= $input['grant_name'];
			$data['client_id']					= $input['client_id'];
			$data['user_id']					= $input['user_id'];
			$data['scopes'][0]					= 'employee';
		}
		else
		{
			$data['id']							= ""; 
			$data['grant_id']					= $input['grant_id'];
			$data['grant_name']					= $input['grant_name'];
			$data['client_id']					= $input['client_id'];
			$data['user_id']					= $input['user_id'];
			$data['scopes'][0]					= 'employee';
		}

		//3. post to API
		$APIAcl									= new APIAcl;
		$result									= $APIAcl->postData($client_id,$data);

		//4. return response 
		if($result['status'] != 'success')
		{
			$this->errors						= $result['message'];
		}

		if(!empty($id))
		{
		   $this->page_attributes->msg			= "Data ACL Telah Diedit";
		}
		else
		{
			$this->page_attributes->msg			= "Data ACL Telah Ditambahkan";
		}

		return $this->generateRedirectRoute('acls.index',['id' => $client_id]);
	}

	/**
	 * { update }
	 *
	 * @param     
	 * 1. id
	 * 2. client_id
	 *
	 * @return
	 * 1. call function store()
	 */
	public function update($client_id = null, $id = null)
	{
		return $this->store($client_id, $id);
	}

	/**
	 * { destroy }
	 *
	 * @param     
	 * 1. id
	 * 2. client_id
	 *
	 * @return
	 * 1. response
	 * 
	 * Step:
	 * 1. post delete
	 * 2. return response
	 * 
	 */
	public function destroy($client_id = null, $id = null)
	{
		//1.post delete 
		$APIAcl									= new APIAcl;

		$result									= $APIAcl->deleteData($client_id, $id);

		//2. return response
		if($result['status'] != 'success')
		{
			$this->errors						= $result['message'];
		}

		$this->page_attributes->msg				= "Data ACL telah dihapus";
		
		return $this->generateRedirectRoute('acls.index', ['client_id' => $client_id]); 
	}

	/**
	 * { FindUserByName }
	 *
	 * @param     
	 *1. name
	 *2. org id
	 *
	 * @return
	 * 1. id
	 * 2. name
	 * 
	 * Step:
	 * 1. get data
	 * 2. validate
	 * 3. returning data
	 */
	public function FindUserByName()
	{
		$APIUser                                  	= new APIUser;
		$search                                   	 = array_merge(
															['name' => Input::get('term')]
														);

		$chart                                     = $APIUser->getIndex([
														'search'    => $search,
														]);

		//2. validate
		if($chart['status'] != 'success')
		{
			return abort(404);
		}

		//3. returning data
		$datas                                      = [];
		foreach ($chart['data']['data'] as $key => $dt) 
		{
			$datas[$key]['id']                      = $dt['id'];
			$datas[$key]['name']                    = ucwords($dt['name']);
		}                                       

		return $datas;
	}



}