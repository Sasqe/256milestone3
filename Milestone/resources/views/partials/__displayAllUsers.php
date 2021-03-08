<?php
//Chris King
//2/15/2020
//displayusers w/ jquery

?>

<head>
<script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>
  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<style>
    table display{
    border-collapse: seperate;
    border-spacing: 0 30px;
    }
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
   border-collapse: seperate;
   border-spacing: 0 30px;
   }
</style>
</head>
<table id="persons" class="display">

<thead>
<tr>
<th>
Buttons

</th>
<th>
Buttons

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
Role
</th>
<th> 
Password
</th>


</tr>
</thead>

</tbody>
<?php 
for ($x = 0; $x < count($persons); $x++){
    echo "<tr>";
    
    echo "<td><form><input type='hidden' name='id' value=" . $persons[$x]->getId() ."><input type='submit' value='Edit'></form> </td>";
    echo "<td><form><input type='hidden' name='id' value=" . $persons[$x]->getId() ."><input type='submit' value='Delete'></form> </td>";
    
    echo "<td>" .$persons[$x]->getId() . "</td>";
    echo "<td>" .$persons[$x]->getUsername() . "</td>";
    echo "<td>" .$persons[$x]->getPassword() . "</td>";
    echo "<td>" .$persons[$x]->getEmail() . "</td>";
    
    echo "<td>" .$persons[$x]->getRole() . "</td>";
    echo "<td>" .$persons[$x]->getAge() . "</td>";
    echo "<td>" .$persons[$x]->getRace() . "</td>";
    echo "<td>" .$persons[$x]->getSex() . "</td>";
    echo "<td>" .$persons[$x]->getAddress() . "</td>";
    

    
   
    
    echo "</tr>";
}

?>
</tbody>
</table>
<script>
	$(document).ready( function () {
		$('#persons').DataTable();
	} );
</script>