<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\DAO;
use App\Models\PortfolioModel;
//Chris King
//2/15/2020
//Admin Service OOP class with admin methods
class AdminService{
    private $admin;
    
    public function showall(){
        $person = Array();
        $this->admin = new DAO();
        $persons = $this->admin->showAll();
        
        return $persons;
}
public function deleteUser($deleteid){
    $dbService = new DAO();
    return $dbService->deleteUser($deleteid);
}
public function editUser($credentials){
    $this->admin = new DAO();
    return $this->admin->editUser($credentials);
}
public function findByID($id){
    
    $this->admin = new DAO();
    $person = $this->admin->findById($id);
    return $person;
}
public function suspendUser($id){
    $this->admin = new DAO();
    return $this->admin->suspendUser($id);
}
public function retrieveHistory($id){
        $history = Array();
        $this->admin = new DAO();
        $history = $this->admin->retrieveHistory($id);
        return $history;
}
public function retrieveSkills($id){
        $skills = Array();
        $this->admin = new DAO();
        $skills = $this->admin->retrieveSkills($id);
        return $skills;
}
public function retrieveEducation($id){
        $education = Array();
        $this->admin = new DAO();
        $education = $this->admin->retrieveEducation($id);
        return $education;
}
public function retrieveUser($id){
    //instantiate arrays
    $data = Array();
    $filtered = Array();
//  <!-- -- get user and their data -- --!>
    $user = $this->findByID($id);
    $history = $this->retrieveHistory($id);
    $skills = $this->retrieveSkills($id);
    $education = $this->retrieveEducation($id);
//  <!-- -- load data into array in order -- --!>
    array_push($data, $user);
    if ($history != null){
    foreach ($history as $key){
        array_push($data, $key);
    }
    }
    if ($skills != null){
    foreach ($skills as $key){
        array_push($data, $key);
    }
    }
    if ($education != null){
    foreach ($education as $key){
        array_push($data, $key);
    }
    }

    return $data;
}
public function adminedit($credentials, $portfolios){
    // parse data into seperate objects
    $this->admin = new DAO();
    $useredited = $this->admin->editUser($credentials);
    $counter = false;
    // perform respective DAO operations
    foreach ($portfolios as $value) {
//-----------------Edit History-------------------------
        if ($value->getHistory()){
            
            if ($this->admin->editHistory($value))
                $counter = true;
            
            else 
                $counter = false;
            
        }
//-----------------Edit Skill-------------------------
        if ($value->getSkill()){
            
            if ($this->admin->editSkill($value))
                $counter = true;
            else
                $counter = false;
            
        }
//-----------------Edit Education-------------------------
        if ($value->getEducation()){
            if ($this->admin->editEducation($value))
                $counter = true;
            
            else 
                $counter = false;
            
           
        }
        
    }
//            ---- Return Results ----
    if ($counter == true){
        return true;
    }
    else {
        return false;
    }
    // return success or failure based on result
 
    
}
}
?>