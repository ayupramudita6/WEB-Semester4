<?php

use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\ManagementUserController;
    use App\Http\CustomerController;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\backend\PengalamanKerjaController;
    use App\Http\Controllers\backend\DashboardController;
    use App\Http\Controllers\backend\PenddikanController;
    use App\Http\Controllers\SessionController;
    use App\Http\Controllers\PegawaiController;
    use App\Http\Controllers\CobaController;
    use App\Http\Controllers\UploadController;
    use App\Http\Controllers\DropzoneController;

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
// Route::middleware(['first', 'second'])->group(function () {
//     Route::get('/', function () {
//         //
//     });

//     Route::get('user/profile', function () {
//         //
//     });
// });

// //namespaces
// Route::namespace('Admin')->group(function (){
//     //
// });

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
    Route::resource('/homee', HomeController::class);
});

//ACARA 8
Route::group(['namespace'=>'App\Http\Controllers\backend'],function()
    {
        Route::resource('/dashboardd',DashboardController::class);
    });
Auth::routes();

// acara 9
Route::get('/home', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('home');
Route::post('/home', [App\Http\Controllers\LoginController::class, 'home']);
Route::get('/registerr', [App\Http\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/registerr', [App\Http\Auth\RegisterController::class, 'register']);

// Acara 13 - 16
Route::group(['namespace' => 'App\Http\Controllers\backend'], function() {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('pendidikan', PendidikanController::class);
    Route::resource('pengalaman_kerja', PengalamanKerjaController::class);
});

// acara 17 - 18
Route::get('session/create', [SessionController::class, 'create']);
Route::get('session/show', [SessionController::class, 'show']);
Route::get('session/delete', [SessionController::class, 'delete']);
Route::get('/pegawai/{ditaa}', [PegawaiController::class, 'index']);
Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);
Route::get('/cobaerror', [CobaController::class, 'index']);

// acara 19
Route::get('/upload', [UploadController::class, 'upload'])->name('upload');
Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');
Route::post('/upload/resize', [UploadController::class, 'resize_upload'])->name('upload.resize');
      
// acara 20
Route::get('/dropzone', [UploadController::class, 'dropzone'])->name('dropzone');
Route::post('/dropzone/store', [UploadController::class, 'dropzone_store'])->name('dropzone.store');
Route::get('/pdf_upload', [UploadController::class, 'pdf_upload'])->name('pdf.upload');
Route::post('/pdf/store', [UploadController::class, 'pdf_store'])->name('pdf.store');
