<?php
namespace App\Http\Controllers;
 /*Milestone 1
* V1
* Chris King
* 01/24/2021
* LoginController.php
*Controller for the login module
*/ 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\ProfileService;
use App\Services\Business\LoginService;


class LoginController extends Controller
{
    public function index(Request $request){
      return view('auth\login');
        
    }
    public function doLogin(Request $request){
        $credentials = new UserModel(null, null, null, null,  request()->get('email'),  request()->get('password'), null, null, null, null, null);
        $serviceLogin = new LoginService();
        $isValid = $serviceLogin->login($credentials);
        echo ($isValid);
        
        if ($isValid && $isValid !== -1){
            return view('home');
        }
        else if ($isValid == -1){
            
            return view('alerts\ursuspended');
        }
        else if ($isValid == false){
            return view('auth\login');
        }
    }
    public function logout(Request $request){ 
        
           
            
            $request->session()->flush();
            echo "Succesfully logged out.";
            
            return redirect('/');
            
      
        
        
        
        
        }
    
 

    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//     protected $redirectTo = '/home';

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('guest')->except('logout');
//     }
}
