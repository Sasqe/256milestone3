<?php
namespace App\Services\Business;
//Chris King
//2/15/2020
//LoginService OOP with login methods
use App\Models\UserModel;
use App\Services\Data\LoginDAO;
class LoginService{
    private $verifyCred;
    
    public function login(UserModel $credentials){
        $this->verifyCred = new LoginDAO();
        
        return $this->verifyCred->login($credentials);
}
}
?>