<?php
namespace App\Http\Controllers;
/*Milestone 1
 * V1
 * Chris King
 * 01/24/2021
 * ProfileController.php
 *Controller for the login module
 */
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Request;
use App\Models\UserModel;
use App\Services\Business\ProfileService;
use App\Services\Business\LoginService;
session_start();

class ProfileController extends Controller
{
    
    public function displayadmin(Request $request){
        return view('adminusers');
    }
    public function index(Request $request){
//  -- trying to return/redirect any view sets all vars to null --
        $age = request()->get('age');
        $race = request()->get('race');
        $sex = request()->get('sex');
        $address = request()->get('address');
        return view("profile", ["age" => $age,"race" => $race, "sex" => $sex, "address" => $address]);
    }
    public function doProfile(Request $request){
        $credentials = new UserModel(null, null, null, null,  null,  null, null, request()->get('age'), request()->get('race'), request()->get('sex'), request()->get('address'));
        
        $serviceProfile = new ProfileService();
        $isValid = $serviceProfile->profile($credentials);
        echo ($isValid);
                         if ($isValid){
                             return redirect('yourprofile');
        
                         }
                         else {
                             echo "Error";
                         }
  }
  public function yourProfile(Request $request){
      return View("yourprofile");
  }
    
}
