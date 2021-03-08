<?php
use App\Services\Business\AdminService;
require_once 'header.php';
require_once 'UserBusinessService.php';

$id = $_GET['id'];

$bs = new AdminService();

$success = $bs->deleteItem($id);

if ($success) {
    echo "Item was deleted<br>";
}
else {
    echo "Nothing deleted<br>";
}