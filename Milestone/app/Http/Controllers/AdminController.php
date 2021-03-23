<?php
//Chris King
//2/15/2020
//AdminController MVC with admin functions
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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\PortfolioModel;
use App\Services\Business\AdminService;
use App\Services\Business\PortfolioService;
use App\Services\Business\GroupService;

class AdminController extends Controller
{
    public function displayadmin(Request $request){
      return view('admintable');
      
    }
//  <!-- ------------------ DO DELETE ---------------------
    public function doDelete(Request $request){
//         <!-- Instantiate form data & service  -->
        $deleteid = request()->get('deleteid');
        
        $bs = new AdminService();
//         <!-- Return respective view on result  -->
        $success = $bs->deleteUser($deleteid);
        if ($success){
            echo "Success banning user!";
            return view('admintable');       
        }
        else {
            echo "Failure banning user...";
            return view('admintable');
        }
    }
    public function edit(Request $request){
        
        $editid = request()->get('id');
        return view('admin\edituser', ["editid" => $editid]);
        

    }
    public function doSuspend(Request $request){
        $suspendid = request()->get('suspendid');
        $bs = new AdminService();
        $success = $bs->suspendUser($suspendid);
        if ($success){
            echo "Success suspending user!";
            return view('admintable');
        }
        else {
            echo "Failure suspending user...";
            return view('admintable');
        }
    }
    public function doEdit(Request $request){
        $input = Input::all();
        $userid = Session::get('userid');
        $service = new PortfolioService();
        $portfolios = Array();
        
        $hP = New PortfolioModel(null, null , null, null, null);
        $sP = New PortfolioModel(null, null , null, null, null);
        $eP = New PortfolioModel(null, null , null, null, null);
        //---------  which button was clicked ------------
        $action = Input::get('action', 'none');
        //---------      Assign form data     ------------
        // ---------- scan & parse input ID keys ------------
        foreach ($input as $key => $value){
            if (strpos($key, 'historyid') !== false){
                $historyid = $value;
            }
            if (strpos($key, 'skillid') !== false) {
                $skillid = $value;
            }
            if (strpos($key, 'educationid') !== false) {
                $educationid = $value;
            }
        }
        // ---------- if post clicked return view to delete history------
         if ($action == 'dH') {
        
              //-----  Delete history in MVC ------
              if ($service->deleteHistory($historyid)){
                        return view('yourportfolio');
              }
              else {
                        echo "Failure"; return view('yourportfolio');
                   }
         }  
        elseif ($action == 'dS'){
            //-----  Delete skill in MVC ------
            if ($service->deleteSkill($skillid))
                return view('yourportfolio');
                
                echo $skillid; return view('yourportfolio');
        }
        elseif ($action == 'dE'){
            //-----  Delete education in MVC ------
            if ($service->deleteEducation($educationid))
                return view('yourportfolio');
                
                echo $educationid; return view('yourportfolio');
        }
//      <!--------- --- --------- else update user & portfolio ------------ --- ---------------> 
       elseif ($action == 'post') {
//                                -- instantiate all vars --
       
//                            -- create array of all input keys --
        $keys = array_keys($input);
        $index = 1;
        $credentials = new UserModel(request()->get('user1'), request()->get('user2'), request()->get('user3'), request()->get('user4') , request()->get('user5'), request()->get('user6'), request()->get('user7'), request()->get('user8'), request()->get('user9'), request()->get('user10'), request()->get('user11'));
//      <!--------- --- --------- iterate input and push values into model ------------ --- ---------------> 
        foreach($input as $key => $value){
//      <!--------- --- --------- initialize offset and substr ------------ --- ---------------> 
            if ($value != null) {
            
            $substr = substr($key, 0, 1);
//             -- offset to check if key == id --
            $offset = substr($key, -4);
//                <!-- -- If input index is for history, push history to model-- --!>
            if (strpos($offset, 'id') == false && $substr === "h"){
//                     -- pattern match to find id of object, index + 1 --     
                $historyID = $input[$keys[$index]];
//                     -------  push to array & repeat --------            
                $hP = new PortfolioModel($historyID, $userid, $value, null, null);
                array_push($portfolios, $hP);
               
                
            }
//                <!-- -- If input index is for skill, push skill to model-- --!>
            if (strpos($offset, 'id') == false && $substr === "s"){
                $skillID = $input[$keys[$index]];
                $sP = new PortfolioModel($skillID, $userid, null, $value, null);
                array_push($portfolios, $sP);
            }
//                <!-- -- If input index is for education, push education to model-- --!>
           
            if(strpos($offset, 'id') == false && $substr === "e"){
                $educationID = $input[$keys[$index]];
                $eP = new PortfolioModel($educationID, $userid, null, null, $value);
                array_push($portfolios, $eP);
            }
//                <!-- -- If portfolio is fully populated push it -- --!>
            }
            $index++;
            
            
        }
       // $result = array_unique($portfolios, SORT_REGULAR);
        
      
        $bs = new AdminService();
        
        $useredited = $bs->adminedit($credentials, $portfolios);
        if ($useredited) {
            echo "success";
            return view('admintable');
        }
        else {
            echo "--";
            echo $useredited;
            return view('admintable');
        }
     }
     
    }
    
    public function doView(Request $request){
        $action = Input::get('action', 'none');
        if ($action == 'return'){
            return view('admintable');
        }
        else {
//      <!--       get ID              -->
        $viewID = request()->get('viewid');
//      <!-- -------instantiate service -- -------!>
        $service = new AdminService();
//      <!-- -------arrays with all data -- -------!>
        $data = $service->retrieveUser($viewID);
//      <!-- ------- filter data -- -------!>
        $user = $data[0];
        $history = Array();
        $skills = Array();
        $education = Array();
//      <!-- ------- slice array ------- -- !>
        foreach (array_slice($data, 1) as $key){
//      <!-- ------- parse data into subarrays ------- -- !>
            $keyHistory = $key->getHistory();
            $keySkill = $key->getSkill();
            $keyEducation = $key->getEducation();
            if (isset($keyHistory)){
                array_push($history, $key);
            }
            elseif (isset($keySkill)){
                array_push($skills, $key);
            }
            elseif (isset($keyEducation)){
                array_push($education, $key);
            }
        }
        }
            
        
        
        
//     <!-- ------- return respective view ------- --!>
        if ($user != null)
            return redirect('viewuser')->with('user', $user)
                                       ->with('history', $history)
                                       ->with('skills', $skills)
                                       ->with('education', $education);
        
            echo "Failure"; return view('displayusers');
    }
//     <!-- ------- validate model by checking if values are empty ------- --!>
    public function isClean(PortfolioModel $portfolio){
        if ($portfolio->getEducation() != null && $portfolio->getSkill() != null && $portfolio->getHistory() != null){
            return true;
        }
        else {
            return false;
        }
        
    }
    //Admin group view
    public function adminGroup()
    {
        $bs = new GroupService();
        $groupArr = $bs->getAll();
        $groups = Array();
        foreach($groupArr as $group)
        {
            $groupID = $group->getGroupID();
            $groupName = $group->getGroupName();
            $interest = $group->getInterest();
            $type = $group->getType();
            $memberCount = $bs->getMemberCount($groupID);
            $description = $group->getDescription();
            $exists = true;
            $newGroup = new GroupModel($groupID, $groupName, $interest, $type, $memberCount, $description, $exists);
            array_push($groups, $newGroup);
        }
        return view('groupAdmin')->with('groups', $groups);
    }
    //Admin edit group view
    public function editGroupView(Request $request)
    {
        $groupID = request()->get('groupID');
        $bs = new GroupService();
        
        $group = $bs->getGroup($groupID);
        
        return view('editGroup')->with('group', $group);
    }
    //Admin edit group data post
    public function editGroup (Request $request)
    {
        $groupID = request()->get('groupID');
        $groupName = request()->get('groupName');
        $interest = request()->get('interest');
        $type = request()->get('type');
        $description = request()->get('description');
        
        $bs = new GroupService();
        $memberCount = $bs->getMemberCount($groupID);
        
        $group = new GroupModel($groupID, $groupName, $interest, $type, $memberCount, $description, true);
        
        $bs->editGroup($group);
        
        
        $groupArr = $bs->getAll();
        $groups = Array();
        foreach($groupArr as $group)
        {
            $groupID = $group->getGroupID();
            $groupName = $group->getGroupName();
            $interest = $group->getInterest();
            $type = $group->getType();
            $memberCount = $bs->getMemberCount($groupID);
            $description = $group->getDescription();
            $exists = true;
            $newGroup = new GroupModel($groupID, $groupName, $interest, $type, $memberCount, $description, $exists);
            array_push($groups, $newGroup);
        }
        return view('groupAdmin')->with('groups', $groups);
    }
    //Admin add a new group
    public function addGroup(Request $request)
    {
        $groupName = request()->get('groupName');
        $interest = request()->get('interest');
        $type = request()->get('type');
        $description = request()->get('description');
        
        $temp = new GroupModel(0, $groupName, $interest, $type, 0, $description, false);
        
        $bs = new GroupService();
        $bs->addGroup($temp);
        
        $groupArr = $bs->getAll();
        $groups = Array();
        foreach($groupArr as $group)
        {
            $groupID = $group->getGroupID();
            $groupName = $group->getGroupName();
            $interest = $group->getInterest();
            $type = $group->getType();
            $memberCount = $bs->getMemberCount($groupID);
            $description = $group->getDescription();
            $exists = true;
            $newGroup = new GroupModel($groupID, $groupName, $interest, $type, $memberCount, $description, $exists);
            array_push($groups, $newGroup);
        }
        return view('groupAdmin')->with('groups', $groups);
    }
        //Admin delete a group
        public function deleteGroup(Request $request)
        {
            $groupID = request()->get('groupID');
            
            $bs = new GroupService();
            
            $bs->deleteGroup($groupID);
            
            $groupArr = $bs->getAll();
            $groups = Array();
            foreach($groupArr as $group)
            {
                $groupID = $group->getGroupID();
                $groupName = $group->getGroupName();
                $interest = $group->getInterest();
                $type = $group->getType();
                $memberCount = $bs->getMemberCount($groupID);
                $description = $group->getDescription();
                $exists = true;
                $newGroup = new GroupModel($groupID, $groupName, $interest, $type, $memberCount, $description, $exists);
                array_push($groups, $newGroup);
            }
            return view('groupAdmin')->with('groups', $groups);
        }
        
        
        
    
    
    
//     <!-- ------- push validated models into new model structure ------- --!>
    public function v_push($data, PortfolioModel $portfolio){
        if ($data->getEducation() != null){
            $portfolio->setEducation($data->getEducation());
        }
        if ($data->getHistory() != null){
            $portfolio->setHistory($data->getHistory());
        }
        if ($data->getSkill() != null){
            $portfolio->setSkill($data->getSkill());
        }
    }
   
}