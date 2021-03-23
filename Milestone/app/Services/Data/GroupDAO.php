<?php
namespace App\Services\Data;

use App\Models\UserModel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use ErrorException;
use Exception;
use App\Models\GroupModel;
use App\Models\GroupMemberModel;
//Chris King
//3/23/2021
//GroupDAO OOP 
class GroupDAO
{
    // Define conn string
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "milestone";
    private $dbquery;
    private $port = 8889;
    
   
    
    //get all groups from db
    public function getAllGroups()
    {
            try {
                $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
                
                $stmt = $conn->prepare("SELECT *
                             FROM groups");
                
                if (!$stmt){
                    echo "Binding process";
                    exit;
                }
                $stmt->execute();
                $stmt->store_result();
                if (!$stmt->bind_result($id, $groupname, $interest,  $type, $desc)){
                    echo "Something wrong in the binding process. sql error? ";
                    return null;
                    exit;
                }
                if ($stmt->num_rows == 0){
                    return null;
                }
                else {
                    $group_array = array();
                    
                    while ($stmt->fetch()){
                        $exists = $this->groupMemberExists($id, Session::get('userid'));
                        $membercount = $this->getMemberCount($id);
                        $g = new GroupModel($id, $groupname, $interest,  $type, $membercount, $desc, $exists);
                        array_push($group_array, $g);
                    }
                    return $group_array;
                }
                
            } catch (ErrorException $e){
                echo $e->getMessage();
            }
    }
    //get single group by id
    public function getGroup($id)
    {
        try {
            $count = 0;
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT *
                             FROM groups
                             WHERE groupID = ? LIMIT 1");
            
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt ->bind_param("s", $id);
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($gid, $groupname, $interest,  $type, $desc)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            if ($stmt->num_rows == 0){
                return null;
            }
            else {
                
                while ($stmt->fetch()){
                    $exists = true;
                    $membercount = $this->getMemberCount($id);
                    $g = new GroupModel($gid, $groupname, $interest,  $type, $membercount, $desc, $exists);
                }
                return $g;
            }
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    //get member count of group
    public function getMemberCount($id)
    {
        try {
            $count = 0;
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT *
                             FROM groupmembers
                             WHERE groupID = ?");
            
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt ->bind_param("s", $id);
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($one, $two, $three)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            if ($stmt->num_rows == 0){
                return 0;
            }
            else {
                
                while ($stmt->fetch()){
                    $count+=1;
                }
                return $count;
            }  
        } catch (ErrorException $e){
            echo $e->getMessage();
        }
    }
    //add group to database
    public function addGroup(GroupModel $group)
    {
        try
        {
            $groupID = $group->getGroupID();
            $groupName = $group->getGroupName();
            $interest = $group->getInterest();
            $type = $group->getType();
            $description = $group->getDescription();
            
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $stmt = $conn->prepare("INSERT INTO groups (groupID, groupName, interest, type, description)
                                    VALUES ('".$groupID."','".$groupName."','".$interest."','".$type."', '".$description."')");
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
        }
        catch(Exception $e)
        {
            $e->getMessage();
        }
    }
    public function editGroup(GroupModel $group)
    {
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $name = $group->getGroupName();
            $type = $group->getType();
            $desc = $group->getDescription();
            $id = $group->getGroupID();
            $interest = $group->getInterest();
            
            $stmt = $conn->prepare("UPDATE groups
                               SET groupName = '$name', interest = '$interest', type = '$type', description = '$desc'
                               WHERE groupID = '$id'");
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
    
    //delete group from database cascade
    public function deleteGroup($id)
    {
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $stmt = $conn->prepare("DELETE FROM groups WHERE groupID ='".$id."' LIMIT 1");
            
            if (!$stmt){
                echo "Something wrong in the binding process. sql error?";
                exit;
            }
          
            
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
    //join group/ add group member to database
    public function joinGroup($id, $name, $groupID)
    {
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("INSERT INTO groupmembers(groupID, memberName, memberID)
                               VALUES('$groupID', '$name', '$id')");
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
            
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
    //remove group member from database
    public function leaveGroup($groupID,$memberID)
    {
        try {
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            $stmt = $conn->prepare("DELETE FROM groupmembers WHERE groupID ='".$groupID."' LIMIT 1");
            
            if (!$stmt){
                echo "Something wrong in the binding process. sql error?";
                exit;
            }
            
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
    //retrieve all members of group from database
    public function getMembers($groupID)
    {
        try 
        {
                $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
                
                $stmt = $conn->prepare("SELECT *
                             FROM groupmembers
                             WHERE groupID = ?");
                
                if (!$stmt){
                    echo "Binding process";
                    exit;
                }
                $stmt ->bind_param("s", $groupID);
                $stmt->execute();
                $stmt->store_result();
                if (!$stmt->bind_result($groupid, $membername, $memberid)){
                    echo "Something wrong in the binding process. sql error? ";
                    return null;
                    exit;
                }
                if ($stmt->num_rows == 0){
                    return null;
                }
                else {

                $memberArr = Array();
                while ($stmt->fetch())
                {
                    $member = new GroupMemberModel($groupid, $membername, $memberid);
                    
                    array_push($memberArr, $member);
                }
                return $memberArr;
            }
        }
        catch (Exception $e) 
        {
            $e->getMessage();
        }
    }
    //set exists variable for group member model
    public function groupMemberExists($groupID, $memberID)
    {
        try
        {
            
            $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
            
            $stmt = $conn->prepare("SELECT *
                             FROM groupmembers
                             WHERE groupID = ".$groupID."
                             AND memberID =".$memberID."");
            
            if (!$stmt){
                echo "Binding process";
                exit;
            }
            $stmt->execute();
            $stmt->store_result();
            if (!$stmt->bind_result($groupid, $membername, $memberid)){
                echo "Something wrong in the binding process. sql error? ";
                return null;
                exit;
            }
            if ($stmt->num_rows == 0){
                return false;
            }
            else {
                while ($stmt->fetch())
                {
                 $count = true;
                }
                return $count;
            }
        }
        catch (Exception $e)
        {
            $e->getMessage();
        }
    }
}

