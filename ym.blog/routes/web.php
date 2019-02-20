<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function ()
{
    return redirect('/blog');
});

Route::get('/blog', 'BlogController@index')->name('blog.home');
Route::get('/blog/{slug}', 'BlogController@showPost')->name('blog.detail');

Route::get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');

// 后台路由
Route::get('/admin', function ()
{
    return redirect('/admin/post');
});
Route::middleware('auth')->namespace('Admin')->group(function ()
{
    Route::resource('admin/post', 'PostController', ['except' => 'show']);
    Route::resource('admin/tag', 'TagController', ['except' => 'show']);
    Route::get('admin/upload', 'UploadController@index');

    // 在这一行下面
    Route::get('admin/upload', 'UploadController@index');

// 添加如下路由
    Route::post('admin/upload/file', 'UploadController@uploadFile');
    Route::delete('admin/upload/file', 'UploadController@deleteFile');
    Route::post('admin/upload/folder', 'UploadController@createFolder');
    Route::delete('admin/upload/folder', 'UploadController@deleteFolder');
});

// 登录退出
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//测试路由
Route::prefix('test')->group(function ()
{
    //上传测试
    Route::get('/file', 'Test\FileUploadController@index');
    Route::post('/file/upload', 'Test\FileUploadController@uploadFile');
    //验证测试
    Route::get('/vaildate', 'Test\VaildateController@index');
    Route::post('/vaildatetest', 'Test\VaildateController@vailDate');
});

Route::fallback(function ()
{
    response('路由错误', 404);
});


