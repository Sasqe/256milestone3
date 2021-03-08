<?php
//Chris King
//2/15/2020
//LoginDAO OOP 
namespace App\Services\Data;

use App\Models\UserModel;
use ErrorException;
class LoginDAO{
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "milestone";
    private $dbQuery;
    
    
    
    
    public function login(UserModel $credentials){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
            
            $email = $credentials->getEmail();
            $pass = $credentials->getPassword();
            $stmt = $conn->prepare("SELECT UserID, firstname, lastname, Username, email, Password, role, age, race, sex, address 
                             FROM users
                             WHERE email = '$email'
                             AND Password = '$pass'");
           
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($id, $firstname, $lastname,  $username, $email, $password, $role, $age, $race, $sex, $address)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            
            //  mysqli_free_result($result);
          
            if ($stmt->num_rows != 0){
                $numberRows = $stmt->num_rows;
                if ($numberRows == 1){
                    $row = $stmt->fetch();
                    $p = new UserModel($id, $firstname, $lastname, $username, $email, $password, $role, $age, $race, $sex, $address);
                    $p->setId($id);
                    $p->setRole($role);
                    $loggedid = $p->getId();
                    $loggedrole = $p->getRole();

                    $loggedname = $p->getUsername();
                    session(['userid' => $loggedid]);
                    session(['role' => $loggedrole]);
                    session(['username' => $loggedname]);
                    if ($loggedrole == 0){
                        
                        return -1;
                    }
                    return true;
                    
                }
                
                else if ($numberRows == 0){
                    echo "Login failed. Username or Password was incorrect";
                    return false;
                }
               
                else {
                    echo "Yoou are not registered";
                    return false;
                }
//                 include_once('session.php');
                //initiate session variable here with logged in user's session ID and role
               
            }
            
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
}

