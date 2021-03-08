<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\ProfileDAO;

class ProfileService{
    private $verifyProfile;
    
    public function profile(UserModel $credentials){
        $this->verifyProfile = new ProfileDAO();
        
        return $this->verifyProfile->profile($credentials);
}
}
?>