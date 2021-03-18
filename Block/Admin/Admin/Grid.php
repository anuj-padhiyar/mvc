<?php
namespace Block\Admin\Admin;
\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template{
    protected $admins = [];

    public function __construct(){
        $this->setTemplate('./View/admin/admin/grid.php');
    }
    public function setAdmin($admins = null){
        if(!$admins){
            $admins = \Mage::getModel('Model\Admin');
            $admins = $admins->fetchAll()->getData();
        }
        $this->admins = $admins;
        return $this;
    }
    public function getAdmin(){
        if(!$this->admins){
            $this->setAdmin();
        }
        return $this->admins;
    }

}