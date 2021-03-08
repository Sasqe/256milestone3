<?php
namespace App\Http\Controllers;
 /*Milestone 1
* V1
* Chris King
* 01/24/2021
* HomeController.php
*Controller for the login module
*/ 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Request;
use App\Models\UserModel;
use App\Services\Business\AdminService;



class HomeController extends Controller
{
    public function index(){
      return view('home');
  
}
public function navhome(){
    return view('welcome');
}
}