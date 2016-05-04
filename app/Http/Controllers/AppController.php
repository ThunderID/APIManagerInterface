<?php 

namespace App\Http\Controllers;

use App\API\Connectors\APIApp;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Helper\SortList;
use Input, Route;

/**
 * { AppController Class }
 * @author cmooy
 * 
 * public functions :
 * 1. index()                           : public function display index app
 * 2. show()                            : public function display show app
 * 3. create()                          : public function display create app
 * 4. edit()                            : public function display edit app
 * 5. store()                           : public function store data app
 * 6. update()                          : public function update data app
 * 7. destroy()                         : public function destroy data app
 * 8. FindappByName()                   : ajax search app by name
 * 
 */

class AppController extends BaseController 
{
	//init 
	protected $view_source_root                     = 'content.apps';
	
	public function __construct()
	{
		parent::__construct();

		$this->page_attributes->page_title             = 'Apps';
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
	 * 1. Layout
	 * 2. page_attributes
	 * 3. page_datas
	 * 
	 * steps
	 * 1. set page attributes
	 * 2. get data parameter
	 * 3. get data
	 * 4. set page datas
	 * 5. generate view
	 */
	public function index()
	{
		//1. set page attributes
		$SortList                                   = new SortList;

		$this->page_attributes->page_subtitle       = 'index';
		//dummy
		$this->page_attributes->filters             =   [
														];
		//dummy
		$this->page_attributes->sorts               =   [
														];       

		//2. get data parameter
		$data_parameter                             = $this->setPageDataParameter();

		//3. get data
		$APIApp                                     = new APIApp;
		if(($data_parameter['search']!=null))
		{
			$search									= array_merge(
															['name' => $data_parameter['search']],
															$data_parameter['filter']
														);
		}
		else
		{
			$search 								= [];
		}

		if(($data_parameter['take']!=null))
		{
			$data									= $APIApp->getIndex([
														'search'    => $search,
														'sort'      => $data_parameter['sort'],
														'take'      => $data_parameter['take'],
														'skip'      => ($data_parameter['page'] - 1) * $data_parameter['take'],
														]);
		}
		else
		{
			$data									 = $APIApp->getIndex([
														'search'    => $search,
														'sort'      => $data_parameter['sort'],
														]);
		}

		//4. set page datas
		$this->page_datas->datas['apps']			= $data['data'];

		//5. generate view
		$view_source                                = $this->view_source_root . '.index';
		$route_source                               = route(Route::CurrentRouteName());

		return $this->generateView($view_source, $route_source);
	}

	/**
	 * { show }
	 *
	 * @param     
	 *1. id
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
	public function show($id = null)
	{
		//1. validate
		if(is_null($id))
		{
			App::abort(403, 'Id app tidak ada');
		}

		//2. get data
		$APIApp                                     = new APIApp;
		$data                                       = $APIApp->getShow($id);        

		//3. set page attributes
		$this->page_attributes->page_title			= 'API';     
		$this->page_attributes->page_subtitle       = 'API';     
		$this->page_attributes->breadcrumb          = array_merge(
															$this->page_attributes->breadcrumb,
															[$data['data']['name'] => route(Route::CurrentRouteName(),['id' => $id])]
														);

		//4. set page datas
		$this->page_datas->datas                    = $data['data'];
		$this->page_datas->cust_paging              = 0;
		// $this->page_datas->cust_paging              = count($data['data']['branches']);
		
		//5. generate view
		$view_source                                = $this->view_source_root . '.show';
		$route_source                               = route(Route::CurrentRouteName(),['id' => $id]);

		return $this->generateView($view_source, $route_source);
	}  

	/**
	 * { create }
	 *
	 * @param     
	 *1. id
	 *
	 * @return
	 * 1. Layout
	 * 2. page_attributes
	 * 3. page_datas
	 * 
	 * steps
	 * 1. get data
	 * 2. set page attributes
	 * 3. set page datas
	 * 4. generate view
	 */
	public function create($id = null)
	{
		// 1 & 2
		if(!is_null($id))
		{
			//1. get data
			$APIApp                                  = new APIApp;
			$data                                    = $APIApp->getShow($id);  

			//2. set page attributes
			$current_route                           = route(Route::CurrentRouteName(),['id' => $id]);

			$this->page_attributes->page_subtitle    = 'Edit '. $data['data']['name'];     
			$this->page_attributes->breadcrumb       = array_merge(
															$this->page_attributes->breadcrumb,
															['Edit ' . $data['data']['name'] => $current_route]
														);                           
		}
		else
		{
			//1. get data
			$data['data']							= null;

			//2. set page attributes
			$current_route                           = route(Route::CurrentRouteName());

			$this->page_attributes->page_subtitle    = 'Perusahaan Baru';     
			$this->page_attributes->breadcrumb       = array_merge(
															$this->page_attributes->breadcrumb,
															['Perusahaan Baru' => $current_route]
														);               
		}      

		//3. set page datas
		if(isset($data['data']))
		{
			foreach ($data['data']['grants'] as $key => $value) {
				if(strtolower($value['name']) != 'owned')
				{
					$grant[] 							= $value;
				}
			}

			$data['data']['grant']						= $grant[0];
		}
		
		$this->page_datas->datas                    = $data['data'];

		//4. generate view
		$view_source                                = $this->view_source_root . '.create';
		$route_source                               = route(Route::CurrentRouteName(),['id' => $id]);

		return $this->generateView($view_source, $route_source);        
	}


	/**
	 * { edit }
	 *
	 * @param     
	 *1. id
	 *
	 * @return
	 * 1. call function create()
	 */
	public function edit($id)
	{
		return $this->create($id);
	}

	/**
	 * { store }
	 *
	 * @param     
	 *1. id
	 *2. input name
	 *3. input code
	 *
	 * @return
	 * 1. response
	 * 
	 * steps
	 * 1. get input
	 * 2. get data
	 * 3. post to API
	 * 4. return response
	 */
	public function store($id = null)
	{
		//1. get input
		$input['name']								= Input::get('name');
		$input['key']								= Input::get('key');
		$input['domain']							= Input::get('domain');
		$input['secret']							= Input::get('secret');
		$input['grants'][0]['name']					= Input::get('grant');
		$input['grants'][0]['scopes']				= explode(',', Input::get('scopes'));

		//2. get data
		if(!is_null($id))
		{
			$APIApp									= new APIApp;
			$data									= $APIApp->getShow($id)['data'];

			$data['name']							= $input['name'];
			$data['key']							= $input['key'];
			$data['domain']							= $input['domain'];
			$data['secret']							= $input['secret'];
			$data['grants']							= $input['grants'];
		}
		else
		{
			$data['id']								= ""; 
			$data['name']							= $input['name'];
			$data['key']							= $input['key'];
			$data['domain']							= $input['domain'];
			$data['secret']							= $input['secret'];
			$data['grants']							= $input['grants'];
		}

		//3. post to API
		$APIApp                                     = new APIApp;
		$result                                     = $APIApp->postData($data);

		//4. return response 
		if($result['status'] != 'success')
		{
			$this->errors                           = $result['message'];
		}

		if(!empty($id))
		{
		   $this->page_attributes->msg              = "Data appanisasi Telah Diubah";
		}
		else
		{
			$this->page_attributes->msg             = "Data appanisasi Telah Ditambahkan";           
		}

		return $this->generateRedirectRoute('apps.index');        
	}

	/**
	 * { update }
	 *
	 * @param     
	 *1. id
	 *
	 * @return
	 * 1. call function store()
	 */
	public function update($app_id = null, $id = null)
	{
		return $this->store($app_id, $id);
	}

	/**
	 * { destroy }
	 *
	 * @param     
	 *1. id
	 *
	 * @return
	 * 1. response
	 * 
	 * Step:
	 * 1. post delete
	 * 2. return response
	 * 
	 */
	public function destroy($id)
	{
		//1.post delete 
		$APIApp                                     = new APIApp;

		$result                                     = $APIApp->deleteData($id);

		//2. return response
		if($result['status'] != 'success')
		{
			$this->errors                           = $result['message'];
		}

		$this->page_attributes->msg                 = "Data App ".$result['data']['name']." telah dihapus";
		
		return $this->generateRedirectRoute('apps.index'); 
	}
}