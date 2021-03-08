<?php 
namespace App\Models;
//Chris King
//2/15/2020
//Usermodel class for the customers
class PortfolioModel
{
    public $id;
    public $userID;
    public $history;
    public $skill;
    public $education;
 

    //class constructor 
    public function __construct( $id, $userID, $history, $skill, $education){
        $this->id = $id;
        $this->userID = $userID;
        $this->history = $history;
        $this->skill = $skill;
        $this->education = $education;
       
    }
    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getUserID()
    {
        return $this->userID;
    }
    /**
     * @param mixed $username
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }
    /**
     * @return mixed
     */
    public function getSkill()
    {
        return $this->skill;
    }
    /**
     * @param mixed $password
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;
    }
    public function getHistory(){
        return $this->history;
    }
    public function setHistory($history){
        $this->history= $history;
    }
    public function getEducation(){
        return $this->education;
    }
    public function setEducation($education){
        $this->education = $education;
    }
}

?>