<?php 
//Chris King
//2/15/2020
//DAO for base communication
namespace App\Services\Data;
use App\Models\UserModel;
use App\Models\PortfolioModel;
use ErrorException;
use Exception;

class DAO{
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "milestone";
    private $dbQuery;
    private $port = 8889;
    
    public function __construct(){
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);        
    }
//----------------------------------- LOGIN --------------------------------------------------------
    public function login(UserModel $credentials){
        try {
            $this->dbQuery = "SELECT *
                             FROM users
                            WHERE Username = '{$credentials->getUsername()}'
                            AND Password = '{$credentials->getPassword()}'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if ($result = mysqli_num_rows($result) > 0){
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return true;
            }
            else {
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return false;
            }
            
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
    //----------------------------------- SHOW ALL USERS --------------------------------------------------------
    public function showAll(){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT UserID, firstname, lastname, Username, email, Password, role, age, race, sex, address
                             FROM users");
            
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
            if ($stmt->num_rows == 0){
                return null;
            }
            else {
                $person_array = array();
                while ($stmt->fetch()){
                    $p = new UserModel($id, $firstname, $lastname, $username, $email, $password, $role, $age, $race, $sex, $address);
                    array_push($person_array, $p);
                }
                return $person_array;
            }
            
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    //----------------------------------- DELETE USERS --------------------------------------------------------
    public function deleteUser($deleteid){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
        $stmt = $conn->prepare("DELETE FROM users WHERE UserID = ? LIMIT 1");
        
        if (!$stmt){
            echo "Something wrong in the binding process. sql error?";
            exit;
        }
        /*bind some parameters for markers */
        // $like_n = "%" . $n . "%";
        $stmt ->bind_param("s", $deleteid);
        
        /* execute query */
        $stmt->execute();
        if ($stmt->affected_rows > 0){
            return true;
        }
        else {
            return false;
        }
        }
        catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    //----------------------------------- EDIT HISTORY --------------------------------------------------------
    public function editHistory($value){
        try {
            $identity = $value->getId();
            $history = $value->getHistory();
           
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $stmt = $conn->prepare("UPDATE history SET history='".$history ."' WHERE HistoryID = ? LIMIT 1");
            
            if (!$stmt){
                echo "Something wrong in the binding process. sql error?";
                exit;
            }
            /*bind some parameters for markers */
            // $like_n = "%" . $n . "%";
            $stmt ->bind_param("s", $identity);
            
            /* execute query */
            $stmt->execute();
            if ($stmt->execute()){
                return true;
            }
            else {
                return false;
            }
        }
        catch (ErrorException $e){
            echo $e->getMessage();
            return false;
        }
    }
//----------------------------------- EDIT SKILL --------------------------------------------------------
    public function editSkill($value){
        try {
            $identity = $value->getId();
            $skill = $value->getSkill();
            
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $stmt = $conn->prepare("UPDATE skills SET skill='". $skill ."' WHERE SkillsID = ? LIMIT 1");
            
            if (!$stmt){
                echo "Something wrong in the binding process. sql error?";
                exit;
            }
            /*bind some parameters for markers */
            // $like_n = "%" . $n . "%";
            $stmt ->bind_param("s", $identity);
            
            /* execute query */
            
            if ($stmt->execute()){
                return true;
            }
            else {
                return false;
            }
        }
        catch (ErrorException $e){
            echo $e->getMessage();
            return false;
        }
    }
//----------------------------------- EDIT EDUCATION --------------------------------------------------------
    public function editEducation($value){
        try {
            $identity = $value->getId();
            $education = $value->getEducation();
            
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $stmt = $conn->prepare("UPDATE education SET education='". $education ."' WHERE EducationID = ? LIMIT 1");
            
            if (!$stmt){
                echo "Something wrong in the binding process. sql error?";
                exit;
            }
            /*bind some parameters for markers */
            // $like_n = "%" . $n . "%";
            $stmt ->bind_param("s", $identity);
            
            /* execute query */
            
            if ($stmt->execute()){
                return true;
            }
            else {
                return false;
            }
        }
        catch (ErrorException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function editUser($credentials){
        try {
            $identity = $credentials->getId();
            $fn = $credentials->getFirstname();
            $ln = $credentials->getLastname();
            
            $un = $credentials->getUsername();
            $email = $credentials->getEmail();
            $pass = $credentials->getPassword();
            $role = $credentials->getRole();
            $id = $credentials->getId();
            $age = $credentials->getAge();
            $race = $credentials->getRace();
            $sex = $credentials->getSex();
            $address = $credentials->getAddress();
            
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $stmt = $conn->prepare("UPDATE users SET firstname='".$fn."', lastname='".$ln."', Username='".$un."',email='".$email."',password='".$pass."',role='".$role."',
                                     age='".$age."', race = '". $race."', sex='". $sex."', address='". $address."' WHERE UserID = ? LIMIT 1");
            
            if (!$stmt){
                echo "Something wrong in the binding process. sql error?";
                exit;
            }
            /*bind some parameters for markers */
            // $like_n = "%" . $n . "%";
            $stmt ->bind_param("s", $identity);
            
            /* execute query */
            $stmt->execute();
            if ($stmt->execute()){
                return true;
            }
            else {
                return false;
            }
        }
        catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    public function findById($identity){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT UserID, firstname, lastname, Username, email, Password, role, age, race, sex, address
                             FROM users WHERE UserID = ?");
            
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt->bind_param("s", $identity);
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($id, $firstname, $lastname, $username, $email, $password, $role, $age, $race, $sex, $address)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            if ($stmt->num_rows == 0){
                return null;
            }
            else {
              
                while ($stmt->fetch()){
                    $p = new UserModel($id, $firstname, $lastname, $username, $email, $password, $role, $age, $race, $sex, $address);
                    
                }
                return $p;
            }
            
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    //----------------------------------- SUSPEND USER --------------------------------------------------------
    public function suspendUser($id){
        try {
           
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $stmt = $conn->prepare("UPDATE users SET role='". 0 ."' WHERE UserID = ? LIMIT 1");
            
            if (!$stmt){
                echo "Something wrong in the binding process. sql error?";
                exit;
            }
            /*bind some parameters for markers */
            // $like_n = "%" . $n . "%";
            $stmt ->bind_param("s", $id);
            
            /* execute query */
            $stmt->execute();
            if ($stmt->affected_rows > 0){
                return true;
            }
            else {
                return false;
            }
        }
        catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
//----------------------------------- RETRIEVE HISTORY --------------------------------------------------------
    public function retrieveHistory($id){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT * 
                             FROM history
                             WHERE history.UserID = ?");
            
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt ->bind_param("s", $id);
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($identity, $history, $useridentity)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            if ($stmt->num_rows == 0){
                return null;
            }
            else {
                $history_array = array();
                while ($stmt->fetch()){
                    $h = new PortfolioModel($identity,$useridentity, $history, null , null);
                    array_push($history_array, $h);
                }
                return $history_array;
            }
            
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    //----------------------------------- RETRIEVE SKILLS --------------------------------------------------------
    public function retrieveSkills($id){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT *
                             FROM skills
                             WHERE skills.UserID = ?");
            
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt ->bind_param("s", $id);
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($identity, $skill, $useridentity)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            if ($stmt->num_rows == 0){
                return null;
            }
            else {
                $skill_array = array();
                while ($stmt->fetch()){
                    $s = new PortfolioModel($identity,$useridentity, null, $skill , null);
                    array_push($skill_array, $s);
                }
                return $skill_array;
            }
            
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
//----------------------------------- RETRIEVE EDUCATION --------------------------------------------------------
    public function retrieveEducation($id){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT *
                             FROM education
                             WHERE education.UserID = ?");
            
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt ->bind_param("s", $id);
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($identity, $education, $useridentity)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            if ($stmt->num_rows == 0){
                return null;
            }
            else {
                $education_array = array();
                while ($stmt->fetch()){
                    $eD = new PortfolioModel($identity,$useridentity, null, null , $education);
                    array_push($education_array, $eD);
                }
                return $education_array;
            }
            
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    
    
//----------------------------------- RETRIEVE USER --------------------------------------------------------
    public function retrieveUser($id){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT *
                             FROM users
                             INNER JOIN history ON users.UserID = history.UserID
                             INNER JOIN skills ON users.UserID = skills.UserID
                             INNER JOIN education ON users.UserID = education.UserID
                             WHERE users.UserID = ?");
            
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt ->bind_param("s", $id);
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($userId, $firstname, $lastname,  $userName, $email, $password, $role, $age, $race, $sex, $address, $historyID, $history, $historyUSERID, $skillID, $skill, $skillUSERID, $educationID, $education, $educationUSERID)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            if ($stmt->num_rows == 0){
                return null;
            }
            else {
                $data = array();
                $counter = 0;
                while ($stmt->fetch()){
                    while ($counter != 1){
                        $user = new UserModel($userId, $firstname, $lastname, $userName, $email, $password, $role, $age, $race, $sex, $address);
                        array_push($data, $user);
                        $counter++;
                    }
                        
                    $portfolio = new PortfolioModel(null,$userId, $history, $skill , $education);
                   // $user = new UserModel($userId, $userName, $email, $password, $role, $age, $race, $sex, $address);
                    array_push($data, $portfolio);
                  
                }
                return $data;
            }
            
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    
 }


?>