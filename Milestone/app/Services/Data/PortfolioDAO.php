<?php
namespace App\Services\Data;

use App\Models\PortfolioModel;

use ErrorException;

class PortfolioDAO{
// <!-- -- Database variables -- --!>
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "milestone";
    private $dbQuery;
    
         
        
//  <!---------------------- DO HISTORY -------------------!> 
    public function doHistory(PortfolioModel $credentials){
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
            $history = $credentials->getHistory();
            
            $userid = $credentials->getUserID();
         
            $stmt = $conn->prepare("INSERT INTO history (history, userID)
                                    VALUES ('".$history."','".$userid."')");
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
//      <!---------------------- DELETE HISTORY -------------------!> 
        public function deleteHistory($deleteid){
            try {
                $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
                $stmt = $conn->prepare("DELETE FROM history WHERE history.HistoryID = ? LIMIT 1");
                
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
//      <!---------------------- DO SKILL -------------------!> 
        public function doSkill(PortfolioModel $credentials){
            try {
                $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
                $skill = $credentials->getSkill();
                
                $userid = $credentials->getUserID();
                
                $stmt = $conn->prepare("INSERT INTO skills (skill, userID)
                                    VALUES ('".$skill."','".$userid."')");
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
//      <!---------------------- DELETE SKILL -------------------!>
        public function deleteSkill($deleteid){
            try {
                $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
                $stmt = $conn->prepare("DELETE FROM skills WHERE skills.skillsID = ? LIMIT 1");
                
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
        //      <!---------------------- DELETE SKILL -------------------!>
        //      <!---------------------- DO SKILL -------------------!>
        public function doEducation(PortfolioModel $credentials){
            try {
                $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
                $education = $credentials->getEducation();
                
                $userid = $credentials->getUserID();
                
                $stmt = $conn->prepare("INSERT INTO education (education, userID)
                                    VALUES ('".$education."','".$userid."')");
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
        public function deleteEducation($deleteid){
            try {
                $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
                $stmt = $conn->prepare("DELETE FROM education WHERE education.educationID = ? LIMIT 1");
                
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
    }


