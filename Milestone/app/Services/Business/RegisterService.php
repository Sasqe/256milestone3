<?php 
namespace App\Services\Business;
use App\Models\UserModel;
use App\Services\Data\RegisterDAO;

class RegisterService{
    private $verifyReg;
    public function register(UserModel $credentials){
        $this->verifyReg = new RegisterDAO();
        return $this->verifyReg->register($credentials);
       
    }
}
?>