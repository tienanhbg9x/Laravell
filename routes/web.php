<?php


Route::get('/', function () {
    return view('welcome');
});
Route::get('', function () {
	return "xin chào các bạn";
});
Route::get('khoahoc/laravel', function (){
	echo "<h1>Tiến Anh ơi cố gắng lên</h1>";
});
Route::get('category','CategoryController@index');
Route::get('MyRequest','MyController@GetURL');

Route::get('getForm',function(){
    return view('postForm');
});
Route::post('postForm',[
    'as'=>'postForm',
    'user'=>'MyController@postForm',
]);

Route::get('setCookie','MyController@setCookie');
Route::get('getCookie','MyController@getCookie');
Route::get('uploadFile',function(){
    return view('postFile');
});
Route::post('postFile',[
    'as'=>'postFile',
    'users'=>'MyController@postFile'
]);
//JSON
Route::get('getJson','MyController@getJson');
//master view
Route::get('masterView',function (){
    return view('laravel');
});

//Database
Route::get('database',function(){
    Schema::create('loaisanpham',function($table){
        $table->increments('id');
        $table->string('ten',200);//tạo cột là 'tên' kiểu dữ liệu varchar
    });

    Schema::create('theloai',function($table){
        $table->increments('id');
        $table->string('ten',200)->nullable();//tạo cột là 'tên' kiểu dữ liệu varchar
        $table->string('nsx')->default('Nha san xuat');
    });
    echo 'Đã thực hiện tạo bảng';
});

Route::get('lienketbang',function(){
    Schema::create('sanpham',function($table){
       $table->increments('id');
       $table->string('ten');
       $table->float('gia');
       $table->integer('soluong')->default(0);
       $table->integer('id_loaisp')->unsigned();
       $table->foreign('id_loaisp')->references('id')->on('loaisanpham');
    });
    echo 'da tao bang san pham';
});
//sua bang
Route::get('suabang',function(){
   Schema::table('theloai',function($table){
        $table->dropColumn('nsx');
   });
});
//them cot
Route::get('themcot',function(){
   Schema::table('theloai',function($table){
      $table->string('email');
   });
});
//doi ten
Route::get('doiten',function(){
    Schema::rename('theloai','nguoidung');
});
//xóa bảng
Route::get('xoabang',function(){
   Schema::drop('nguoidung');
   echo 'da xoa bang nguoi dung';
});
