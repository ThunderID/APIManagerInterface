<?php 
namespace App\Http\Controllers\Helper;

/**
 * Handle admin sort aliasing
 * 
 * @author budi
 */
	
class sortList
{
	protected $sorts;

	public function __construct()
	{
		$this->sorts 					= 	[
												'nama'				=> 	[
																			'name-asc' 		=> 'Urutkan nama A ke Z',
																			'name-desc'		=> 'Urutkan nama Z ke A',
																		],
											];
	}

	public function getSortingList($name)
	{
		return $this->sorts[$name];
	}	
}