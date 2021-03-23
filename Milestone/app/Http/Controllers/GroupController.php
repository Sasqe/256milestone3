<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\UserModel;
use App\Services\Business\GroupService;
use App\Models\GroupModel;

class GroupController extends Controller
{
    // Direct route to admin page
    public function index()
    {
       
    }
    
    
    // User group view
    public function userGroupView()
    {
        $bs = new GroupService();
        $groupArr = $bs->getAll();
        $memberID = Session::get('userid');
       
        return view('groupUserView')->with('groups', $groupArr);
    }
    
    //User join group
    public function joinGroup(Request $request)
    {
        $id = Session::get('userid');
        $name = Session::get('name');
        $groupID = request()->get('groupID');
        
        $bs = new GroupService();
        
        $bs->joinGroup($id, $name, $groupID);
        
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
            $exists = $bs->memberExists($groupID, $id);
            $newGroup = new GroupModel($groupID, $groupName, $interest, $type, $memberCount, $description, $exists);
            array_push($groups, $newGroup);
        }
        return view('groupUserView')->with('groups', $groupArr);
    }
    //User leave a group
    public function leaveGroup(Request $request)
    {
        $groupID = request()->get('groupID');
        $memberID = Session::get('userid');
        
        $bs = new GroupService();
        
        $bs->leaveGroup($groupID, $memberID);
        
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
            $exists = $bs->memberExists($groupID, $memberID);
            
            $newGroup = new GroupModel($groupID, $groupName, $interest, $type, $memberCount, $description, $exists);
            
            array_push($groups, $newGroup);
        }
        return view('groupUserView')->with('groups', $groups);
    }
    //User view group members
    public function viewGroupMembers(Request $request)
    {
        $groupID = request()->get('groupID');
        
        $bs = new GroupService();
        
        $members = $bs->getMembers($groupID);
          
            return view('groupMembersView')->with('members', $members);
            
    }
   

    
}
