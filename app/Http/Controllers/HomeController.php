<?php
namespace App\Http\Controllers;
class HomeController extends Controller
{
    public function index()
    {
        return view('index',[
            'name' => 'Hello Tiến Anh']);
    }
    public function about()
    {
        return view('about',[
            'title' => 'Hôm nay trời nắng to'
        ]);
    }
}    
