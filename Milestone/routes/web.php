<?php
//Chris King
//2/15/2020
//web.php routes 
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
Route::get('/navhome', 'HomeController@navhome')->name('navhome');
Route::get('/', function () {
    return view('welcome');
});
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/register', 'RegisterController@index')->name('register');
    Route::post('/doRegister', 'RegisterController@doRegister')->name('doRegister');
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/doLogin', 'LoginController@doLogin')->name('doLogin');
    Route::get('/yourprofile', 'ProfileController@yourProfile')->name('yourprofile');
    Route::get('/portfolio', 'PortfolioController@index')->name('portfolio');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::post('/doProfile', 'ProfileController@doProfile');
    Route::post('/doSuspend', 'AdminController@doSuspend')->name('doSuspend');
    Route::post('/doDelete', 'AdminController@doDelete')->name('doDelete');
    Route::post('/editUser', 'AdminController@edit')->name('editUser');
    Route::post('/viewUser', 'AdminController@doView')->name('viewUser');
    Route::post('/doEdit', 'AdminController@doEdit')->name('doEdit');
    Route::get('/displayadmin', 'AdminController@displayadmin')->name('displayadmin');
    Route::post('/doHistory', 'PortfolioController@doHistory')->name('doHistory');
    Route::post('/doSkill', 'PortfolioController@doSkill')->name('doSkill');
    Route::post('/doEducation', 'PortfolioController@doEducation')->name('doEducation');
    Route::get('/doPortfolio', 'PortfolioController@doPortfolio')->name('doPortfolio');
    //Route to add an order
    Route::get('/viewuser', function(){
        return view('admin\viewuser');
    });