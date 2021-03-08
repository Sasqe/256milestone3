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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PortfolioModel;
use App\Services\Business\PortfolioService;
use App\Services\Business\LoginService;


class PortfolioController extends Controller
{
    
    public function index(){
        //index returns view
        
        return view('yourportfolio');
    }
    public function doPortfolio(Request $request){
        $service = new PortfolioService();
        //---------  which button was clicked ------------
        $action = Input::get('action', 'none');
        //---------      Assign form data     ------------
        $historyID = request()->get('historyid');
        $skillID = request()->get('skillid');
        $educationID = request()->get('educationid');
       // ---------- if post button clicked return view------
        if ($action=='post'){
            return view('portfolio');
        }
        elseif ($action == 'dH'){
            //-----  Delete history in MVC ------
            if ($service->deleteHistory($historyID))
                 return view('yourportfolio');
            
                 echo "Failure"; return view('yourportfolio');
            
        }
        elseif ($action == 'dS'){
            //-----  Delete skill in MVC ------
            if ($service->deleteSkill($skillID))
                return view('yourportfolio');
                
                echo $skillID; return view('yourportfolio');
        }
        elseif ($action == 'dE'){
            //-----  Delete education in MVC ------
            if ($service->deleteEducation($educationID))
                return view('yourportfolio');
                
                echo $educationID; return view('yourportfolio');
        }
        

  }
  public function doHistory(Request $request){
//    <!------- Assign session ID and form data -------!> 
      $userid = Session::get('userid');
      $credentials = new PortfolioModel(null, $userid,  request()->get('history'), null , null);
//    <!------- Instantiate Service -------!> 
      $serviceProfile = new PortfolioService();
//    <!------- Return Respective Views -------!> 
      $isValid = $serviceProfile->doHistory($credentials);
      echo ($isValid);
      if ($isValid){
          return view('yourportfolio');
          
      }
      else {
          echo "Error";
      }
      return view('portfolio');
  }
  public function doSkill(Request $request){
//    <!------- Assign Session ID -------!> 
      $userid = Session::get('userid');
//    <!------- Instantiate Form Data -------!> 
      $credentials = new PortfolioModel(null, $userid, null , request()->get('skill') , null);
//    <!------- Instantiate Service -------!> 
      $serviceProfile = new PortfolioService();
//    <!------- Return Respective View -------!> 
      $isValid = $serviceProfile->doSkill($credentials);
      echo ($isValid);
      if ($isValid){
          return view('yourportfolio');
      }
      else {
          echo "Error";
      }
      return view('portfolio');
  }
  public function doEducation(Request $request){
      //    <!------- Assign Session ID -------!>
      $userid = Session::get('userid');
      //    <!------- Instantiate Form Data -------!>
      $credentials = new PortfolioModel(null, $userid, null , null , request()->get('education'));
      //    <!------- Instantiate Service -------!>
      $serviceProfile = new PortfolioService();
      //    <!------- Return Respective View -------!>
      $isValid = $serviceProfile->doEducation($credentials);
      echo ($isValid);
      if ($isValid){
          return view('yourportfolio');
      }
      else {
          echo "Error";
      }
      return view('portfolio');
  }
  
    
}
