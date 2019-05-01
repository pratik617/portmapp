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

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
		Route::group(['middleware' => ['role:administrator']], function () {
			//Route::resource('roles','RoleController');
			//Route::resource('users','UserController');
		});
		
		Route::get('/', 'DashboardController@index')->name('dashboard');
});

Route::get('users/getData', 'UsersController@getData')->name('users.data');
Route::resource('users', 'UsersController');
Route::post('users/change-password', 'UsersController@changePassword')->name('change-password');
Route::get('programs/getData', 'ProgramsController@getData')->name('programs.data');
Route::resource('programs', 'ProgramsController', 
	['except' => [ 'show' ]
]);

Route::get('projects/getData', 'ProjectsController@getData')->name('projects.data');
Route::resource('projects', 'ProjectsController');





Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('register', 'AdminController@create')->name('admin.register');
    Route::post('register', 'AdminController@store')->name('admin.register.store');
    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
});