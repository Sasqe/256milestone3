
<?php
//Chris King
//2/15/2020
//admin table w/ jquery
echo "<br>";
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Models\UserModel;
use App\Services\Data\DAO;
use App\Services\Business\AdminService;
use App\Resources\views\partials\__displayAllUsers;
?>
@if(!Session::has('userid') && Session::get('userid') != 1)
      <script>window.location = "login";</script>
@else
<?php 
$serve = new AdminService();
$persons = $serve->showall();

?>

<head>
@include('layouts.app')
<h1> Admin Interface </h1>
<script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>
  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<style>
    #customers{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }
   #customers td, #customers th{
   border: 2px solid #ddd;
   border-radius:4px;
   padding:8px;
   }
   #customers tr:nth-child(even){background-color: #f2f2f2;}
   #customers tr:hover{background-color: #ddd;}
   #customers th{
   padding-top:12px;
   padding-bottom: 12px;
   text-align: left;
   background-color: #339;
   color:white
   }
</style>
</head>
<table id="customers" class="display">

<thead>
<tr>
<th>
Edit
</th>
<th>
Ban

</th>
<th>
Delete

</th>
<th>
ID
</tH>
<th>
First Name
</th>
<th>
Last Name
</th>
<th>
Username
</th>

<th>
Email
</th>
<th> 
Password
</th>
<th> 
Role
</th>
<th> 
Age
</th>
<th> 
Race
</th>
<th> 
Sex
</th>
<th> 
Address
</th>
<th>
Details
</th>

</tr>
</thead>

</tbody>

<?php 

for ($x = 0; $x < count($persons); $x++){
    echo "<tr>";
    
   echo "<td><form action='editUser' method='post'>
    <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
    <input type='submit' name='submitted' value='Edit'></input>
    <input type='hidden' name='id' id='id' value = '". $persons[$x]->getId() . "'></input>
    </form></td>";
   echo "<td><form action='doDelete' method='post'>
    <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
    <input type='submit' name='submitted' value='Ban'></input>
    <input type='hidden' name='deleteid' id='deleteid' value = '". $persons[$x]->getId() . "'></input>
    </form></td>";
    
    
    
   echo "<td><form action='doSuspend' method='post'>
    <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
    <input type='submit' name='submitted' value='Suspend'></input>
    <input type='hidden' name='suspendid' id='suspendid' value = '". $persons[$x]->getId() . "'></input>
    </form></td>";
    
    
    echo "<td>" .$persons[$x]->getId() . "</td>";
    echo "<td>" .$persons[$x]->getFirstname() . "</td>";
    echo "<td>" .$persons[$x]->getLastname() . "</td>";
    echo "<td>" .$persons[$x]->getUsername() . "</td>";
    echo "<td>" .$persons[$x]->getPassword() . "</td>";
    echo "<td>" .$persons[$x]->getEmail() . "</td>";
    
    echo "<td>" .$persons[$x]->getRole() . "</td>";
    echo "<td>" .$persons[$x]->getAge() . "</td>";
    echo "<td>" .$persons[$x]->getRace() . "</td>";
    echo "<td>" .$persons[$x]->getSex() . "</td>";
    echo "<td>" .$persons[$x]->getAddress() . "</td>";
    

    
    echo "<td><form action='viewUser' method='post'>
    <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
    <input type='submit' name='submitted' value='View'></input>
    <input type='hidden' name='viewid' id='viewid' value = '". $persons[$x]->getId() . "'></input>
    </form></td>";
    
    echo "</tr>";
}

?>
</tbody>
</table>
<script>
	$(document).ready( function () {
		$('#customers').DataTable();
	} );
</script>
@endif