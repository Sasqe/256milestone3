<?php
namespace App\Http\Controllers;
/*Milestone 1
 * V1
 * Chris King
 * 01/24/2021
 * RegisterController.php
 *Contains the MVC Controller for registering on the app
 */

use App\User;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Services\Business\RegisterService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request){
        return view('auth\register');
    }
    public function doRegister(Request $request){
        $credentials = new UserModel(null, request()->get('firstname'), request()->get('lastname'),  request()->get('name'),request()->get('email'), request()->get('password'), 1, null, null, null, null);
        
        $serviceRegister = new RegisterService();
        $isRegistered = $serviceRegister->register($credentials);
        // $serviceRegister = new RegisterService();
        // $registerSuccess = $serviceRegister->register($credentials);
        echo ($isRegistered);
        if ($isRegistered){
            echo "Success!";
            return view('auth\login');
            
        }
        else {
            echo "Failure!";
        }
    }
    
    /*
     |--------------------------------------------------------------------------
     | Register Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles the registration of new users as well as their
     | validation and creation. By default this controller uses a trait to
     | provide this functionality without requiring any additional code.
     |
     */
    
//     use RegistersUsers;
    
//     /**
//      * Where to redirect users after registration.
//      *
//      * @var string
//      */
    
//     protected $redirectTo = '/home';
    
//     //     /**
//     //      * Create a new controller instance.
//     //      *
//     //      * @return void
//     //      */
//     public function __construct()
//     {
//         $this->middleware('guest');
//     }
    
//     /**
//      * Get a validator for an incoming registration request.
//      *
//      * @param  array  $data
//      * @return \Illuminate\Contracts\Validation\Validator
//      */
//     protected function validator(array $data)
//     {
//         return Validator::make($data, [
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//             'password' => ['required', 'string', 'min:8', 'confirmed'],
//         ]);
//     }
    
//     /**
//      * Create a new user instance after a valid registration.
//      *
//      * @param  array  $data
//      * @return \App\User
//      */
//     protected function create(array $data)
//     {
//         return User::create([
//             'name' => $data['name'],
//             'email' => $data['email'],
//             'password' => Hash::make($data['password']),
//         ]);
//     }
}
