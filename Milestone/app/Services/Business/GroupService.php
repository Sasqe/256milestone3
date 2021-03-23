<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\GroupDAO;
use App\Models\GroupModel;
//Chris King
//3/23/2021
//GroupService OOP 
class GroupService
{

    // Define properties
    private $service;

    public function getAll()
    {
        // Instantiate UserDAO class
        $this->service = new GroupDAO();
        // Return array
        return $this->service->getAllGroups();
    }
    //get specific group
    public function getGroup($id)
    {
        $this->service = new GroupDAO();

        return $this->service->getGroup($id);
    }
        //add group
    public function addGroup(GroupModel $group)
    {
        $this->service = new GroupDAO();
        
        return $this->service->addGroup($group);
    }
    //edit group
    public function editGroup(GroupModel $group)
    {
        $this->service = new GroupDAO();

        return $this->service->editGroup($group);
    }
    //delete group
    public function deleteGroup($id)
    {
        $this->service = new GroupDAO();

        return $this->service->deleteGroup($id);
    }
    //join group
    public function joinGroup($id, $name, $groupID)
    {
        $this->service = new GroupDAO();
        
        return $this->service->joinGroup($id, $name, $groupID);
    }
    //get amount of members
    public function getMemberCount($id)
    {
        $this->service = new GroupDAO();
        return $this->service->getMemberCount($id);
    }
    //get all members of group
    public function getMembers($groupID)
    {
        $this->service = new GroupDAO();
        return $this->service->getMembers($groupID);
    }
    //leave group
    public function leaveGroup($groupID, $memberID)
    {
        $this->service = new GroupDAO();
        return $this->service->leaveGroup($groupID, $memberID);
    }
    //member exists    
    public function memberExists($groupID, $memberID)
    {
        $this->service = new GroupDAO();
        return $this->service->groupMemberExists($groupID, $memberID);
    }
}

