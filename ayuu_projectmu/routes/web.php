<?php

use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\ManagementUserController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\backend\PengalamanKerjaController;
    use App\Http\Controllers\backend\DashboardController;
    use App\Http\Controllers\backend\PenddikanController;
    use App\Http\Controllers\SessionController;
    use  App\Http\Controllers\PegawaiController;

// Acara 3

Route::get('/', function () {
    return view('welcome');
});
Route::get('/foo', function () {
    return 'hello world';
});
Route::get('/foo/{id}',function ($id){
    return'User ='.$id;
});

//Route::get('/user', 'UserController@index');
Route::get ('/user', [UserController::class,'index']);

// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);

Route::redirect('/coba','/sini');



    Route::get('/profile', function () {
        return view('profile', [
            'nama'  => 'Ayu Pramudita',
            'nim'   => 'E41230760',
            'prodi' => 'Teknik Informatika'
        ]);
    });


Route::get('/userr/{name?}', function($name=null){
    return $name? "Hello, $name!" : "Hello, Guest!";
});
Route::get('users/{name?}', function($name='Ayu'){
    return $name? "Hello, $name!" : "Hello, Guest!";
});

Route::get('user1/{name}', function ($name) {
    return "Hello, $name!";
})->where('name', '[A-Za-z]+');

Route::get('user2/{id}', function ($id){
    return "User ID $id";
})->where('id', '[0-9]+');

Route::get('user3/{id}/{name}', function ($id, $name){
    return "User ID: $id name: $name";
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

Route::get('user4/{id}', function ($id) {
    return "User ID: $id"; // Only executed if {id} is numeric
});

Route::get('search/{search}',function ($search){
    return $search;
})->where('search', '.*');

use App\Http\Controllers\UserProfileController;

Route::get('user5/profile', function(){
    return "Ini adalah halaman user 5.";
    })->name('profile.user5');

Route::get('user6/profile', [UserController::class, 'show'])->name('profile.user6');


// Acara 4

//generate route ke route bersama
// Route::get('/user/{id}/profile', function ($id) {
//     return view('profile', ['id' => $id]);
// })->name('profile');

Route::get('/redirect-profile', function () {
    return redirect()->route('profile', ['id' => 1, 'photos' => 'yes']);
});

//memeriksa rute saat ini
// Route::get('/user/{id}/profile', function ($id) {
//     return view('profile', ['id' => $id]);
// })->name('profile')->middleware('check.profile');
Route::get('/user/{id}/profile', function ($id) {
    return view('profile', ['id' => $id]);
})->name('profile');

//Middleware
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        //
    });

    Route::get('user/profile', function () {
        //
    });
});

//namespaces
Route::namespace('Admin')->group(function (){
    //
});

//subdomain routing
Route::domain('{account}.myapp.com')->group(function (){
    Route::get('user/{id}', function ($account, $id){
        //
    });
});

//route prefixes
Route::domain('{account}.myapp.com')->group(function (){
    Route::get('user', function (){
        //
    });
});

//route name prefixes
Route::name('admin.')->group(function (){
    Route::get('users', function (){
        //
    })->name('users');
});

//tambahan
// Route::post('/user/{id}/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::match(['get', 'post'], '/user/{id}/profile/update', [ProfileController::class, 'update'])->name('profile.update');



// Acara 5

//memeriksa rute saat ini
Route::get('/user8/{id}/profile', function ($id) {
    return view('profile', ['id' => $id]);
})->name('profile');

//Middleware
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        //
    });

    Route::get('user9/profile', function () {
        //
    });
});

//namespaces
Route::namespace('Admin')->group(function (){
    //
});


//subdomain routing
Route::domain('{account}.myapp.com')->group(function (){
    Route::get('user10/{id}', function ($account, $id){
        //
    });
});

//route prefixes
Route::domain('{account}.myapp.com')->group(function (){
    Route::get('user11', function (){
        //
    });
});

//route name prefixes
Route::name('admin.')->group(function (){
    Route::get('users', function (){
        //
    })->name('users');
});

Route::get('/pengguna', [ManagementUserController::class, 'index']);
    Route::resource('/pengguna', ManagementUserController::class);

// Route::post('/user/{id}/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::match(['get', 'post'], '/user/{id}/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get("/home", function(){
    return view("home");
});


// acara 7
Route::group(['namespace'=> 'App\Http\Controllers\Frontend'], function(){
    Route::resource('/home', HomeController::class);
});

//ACARA 8
Route::group(['namespace'=>'App\Http\Controllers\backend'],function()
{
    Route::resource('/dashboard',DashboardController::class);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Acara 13
Route::group(['namespace' => 'Backend'], function()
{
    Route::resource('dashboard', 'DashboardController');
    Route::resource('pendidikan','PendidikanController');
    Route::resource('pengalaman_kerja','PengalamanKerjaController');
});

// acara 17
Route::get('/session/create','SessionController@create');
Route::get('/session/create','SessionController@show');
Route::get('/session/delete','SessionController@delete');
Route::get('/pegawai/{nama}','PegawaiController@index');
Route::get('/formulir','PegawaiController@formulir');
Route::post('/formulir/proses','PegawaiController@proses');