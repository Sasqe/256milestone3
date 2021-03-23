<?php
namespace App\Services\Data;

use App\Models\UserModel;
use ErrorException;

class RegisterDAO{
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "milestone";
    private $dbQuery;
    
         
        
    
    public function register(UserModel $credentials){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $fn = $credentials->getFirstname();
            $ln = $credentials->getLastname();
            $un = $credentials->getUsername();
            $email = $credentials->getEmail();
            $pass = $credentials->getPassword();
            $role = $credentials->getRole(); 
            $id = null;
            $age = null;
            $race = null;
            $sex = null;
            $address = null;
            $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, Username, email, Password, role)
                               VALUES('$fn', '$ln', '$un', '$email', '$pass', '$role')");
            if (!$stmt){
                echo "Something wrong in the binding process. sql error? ";
                exit;
            }
          //  mysqli_free_result($result);
            $stmt->execute();
            if ($stmt->affected_rows > 0){
                return true;
            }
            else {
                return false;
            }
           
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
}

