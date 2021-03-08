<?php
namespace App\Services\Business;

use App\Models\PortfolioModel;
use App\Services\Data\PortfolioDAO;

class PortfolioService{
    private $service;
//  <!---------------------- DO HISTORY -------------------!> 
    public function doHistory(PortfolioModel $credentials){
        $this->service = new PortfolioDAO();
        
        return $this->service->doHistory($credentials);
}
//  <!---------------------- DELETE HISTORY -------------------!> 
public function deleteHistory($historyID){
        $this->service = new PortfolioDAO();
        
        return $this->service->deleteHistory($historyID);
}
//  <!---------------------- DO SKILL -------------------!> 
public function doSkill(PortfolioModel $credentials){
        $this->service = new PortfolioDAO;
        
        return $this->service->doSkill($credentials);
}
//  <!---------------------- DELETE SKILL -------------------!>
public function deleteSkill($skillID){
    $this->service = new PortfolioDAO();
    
    return $this->service->deleteSkill($skillID);
}
//  <!---------------------- DO EDUCATION -------------------!>
public function doEducation(PortfolioModel $credentials){
    $this->service = new PortfolioDAO;
    
    return $this->service->doEducation($credentials);
}
//  <!---------------------- DELETE EDUCATION -------------------!>
public function deleteEducation($edID){
    $this->service = new PortfolioDAO();
    
    return $this->service->deleteEducation($edID);
}
}
?>