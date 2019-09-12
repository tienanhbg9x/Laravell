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
//queryBuilder
Route::get('qb/get',function(){
    $data = DB::table('users')->get();
    foreach ($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }
});
//where
Route::get('qb/where',function(){
    $data = DB::table('users')->where('id','=',2)->get();
    foreach ($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }
});

//select id,name,email,...
Route::get('qb/select',function(){
    $data = DB::table('users')->select('id','name','email')->where('id',2)->get();
    foreach ($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }
});

//select name as hoten form...(doi ten cot name thanh hoten)
Route::get('qb/raw',function(){
    $data = DB::table('users')->select(DB::raw('id, name as hoten, email'))->where('id',2)->get();
    foreach ($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }
});

//orderBy and limit <=> skip, take
Route::get('qb/orderby',function(){
    $data = DB::table('users')->select(DB::raw('id, name as hoten, email'))->where('id','>',1)
        ->orderBy('id','desc')->take(2);
    echo $data->count();
//    foreach ($data as $row)
//    {
//        foreach($row as $key=>$value)
//        {
//            echo $key.":".$value."<br>";
//        }
//        echo "<hr>";
//    }
});

//update
Route::get('qb/update',function(){
    DB::table('users')->where('id',1)->update(['name'=>'tienanh','email'=>'tienanhbg1997@gmail.com']);
    echo 'da update';
});

//delete
Route::get('qb/delete',function(){
    DB::table('users')->where('id',1)->delete();
    echo 'da xoa';
});

//model
Route::get('model/save',function(){
    $user = new App\User();
    $user->name = "Tiến Anh";
    $user->email = "tienanhbg9x@gmail.com";
    $user->password = "Mat Khau";

    $user->save();
    echo "da save";
});

Route::get('model/query',function(){
    $user = App\User::find(5);
    echo $user->email;
});

Route::get('model/sanpham/save/{ten}',function($ten){
    $sanpham = new App\SanPham();
    $sanpham->ten = $ten;
    $sanpham->soluong = 1000;

    $sanpham->save();
    echo "Đã lưu"." ".$ten;
});

Route::get('model/sanpham/all',function(){
    //trả dữ liệu dạng json,dạng mảng
    $sanpham = App\SanPham::all()->toArray();
    var_dump($sanpham);
});

Route::get('model/sanpham/ten',function(){
    $sanpham = App\SanPham::where('ten','Laptop')->get();
    echo $sanpham;
});
Route::get('model/sanpham/destroy',function() {
    //xóa dữ liệu bằng khóa chính trong bảng
    App\SanPham::destroy('7');
    echo 'Đã xóa';
});

//Tạo cột
Route::get('taocot',function(){
    Schema::table('sanpham',function($table){
        $table->integer('id_loaisanpham')->unsigned();
    });
    echo "da tao cot";
});

Route::get('model/lienket',function(){
    $data = App\SanPham::find(8)->loaisanpham->toArray();
    var_dump($data);
});
Route::get('model/lienketloaisp',function(){
    $data = App\LoaiSanPham::find(1)->sanpham->toArray();
    var_dump($data);
});

//Bảo mật web với Middleware
Route::get('diem',function(){
    echo 'Bạn đã đủ điểm';
})->middleware('MyMiddleware')->name('diem');
Route::get('loi',function(){
    echo 'Bạn chưa đủ điểm';
})->name('loi');

Route::get('nhapdiem',function(){
    return view('nhapdiem');
})->name('nhapdiem');

//Auth
Route::get('dangnhap',function(){
    return view('thanhcong');
});

Route::post('login','AuthController@login')->name('login');
Route::get('logout','AuthController@logout');


