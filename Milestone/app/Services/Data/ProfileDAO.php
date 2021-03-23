<?php
namespace App\Services\Data;

use App\Models\UserModel;

use ErrorException;

class ProfileDAO{
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "milestone";
    private $dbQuery;
    private $port = 8889;
    
         
        
    
    public function profile(UserModel $credentials){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $fn = $credentials->getUsername();
            $email = $credentials->getEmail();
            $pass = $credentials->getPassword();
            $role = $credentials->getRole(); 
            $id = null;
            $age = $credentials->getAge();
            $race = $credentials->getRace();
            $sex = $credentials->getSex();
            $address = $credentials->getAddress();
            $userid = session('userid');
         
            $stmt = $conn->prepare("UPDATE users
                               SET age = '$age', race = '$race', sex = '$sex', address = '$address'
                               WHERE UserID = '$userid'");
            if (!$stmt){
                echo "Something wrong in the binding process. sql error? ";
                exit;
            }
          //  mysqli_free_result($result);
            $stmt->execute();
            if ($stmt->execute()){
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


