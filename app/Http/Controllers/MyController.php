<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyController extends Controller
{
    public function GetURL(Request $request){
        return $request->url();
//        if($request->isMethod('GET')){
//            echo 'GET';
//        } else {
//            echo "not GET";
//        }
    }
    public function postForm(Request $request){
//        echo "Tên của bạn là:";
//        echo $request->name;
        if($request->has('tuoi'))
            echo 'co tham so';
        else
            echo 'không có tham số';

    }

    public function setCookie(){
        $response= new Response();
        $response->withCookie(
            'hoTen',
            'tienAnh',
            2
        );
        echo 'đã set cookie';
        return $response;
    }
    public function getCookie(Request $request){
        echo 'Cookie của bạn là:';
        return $request->cookie('hoTen');
    }
    //uploadFile
    public function postFile(Request $request){
        if($request->hasFile('myFile')){
            $file = $request->file('myFile');
            $filename = $file->getClientOriginalName();
            $file->move('img', 'myFile.jpg');
        }else{
            echo 'chưa có file';
        }
    }
    public function getJson(){
        $array = ['tienanh'=>'try hard'];
        return response()->json($array);
    }
}