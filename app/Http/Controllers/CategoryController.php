<?php 
namespace App\Http\Controllers;
	/**
	 * 
	 */
	class CategoryController extends Controller
	{
		
		function index()
		{
			return view('index',[
				'name' => 'tiến anh',
				'email' => 'tienanhbg9x@gmail.com'

			]);
		}
	}
		
 ?>