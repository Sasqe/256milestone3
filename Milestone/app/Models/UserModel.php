<?php 
namespace App\Models;
//Chris King
//2/15/2020
//Usermodel class for the customers
class UserModel
{
    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;
    public $role;
    public $age;
    public $race;
    public $sex;
    public $address;
 

    //class constructor 
    public function __construct( $id, $firstname, $lastname, $username, $email, $password, $role, $age, $race, $sex, $address){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->age = $age;
        $this->race = $race;
        $this->sex = $sex;
        $this->address = $address;
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
    public function getFirstname(){
        return $this->firstname;
    }
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getRole(){
        return $this->role;
    }
    public function setRole($role){
        $this->role = $role;
    }
    public function getAge(){
        return $this->age;
    }
    public function setBanned($age){
        $this->age = $age;
    }
    public function getRace(){
        return $this->race;
    }
    public function setRace($race){
        $this->race = $race;
    }
    public function getSex(){
        return $this->sex;
    }
    public function setSex($sex){
        return $this->sex;
    }
    public function getAddress(){
        return $this->address;
    }
    public function setAddress($address){
        $this->address = $address;
    }
   
}

?>