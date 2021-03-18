<?php
namespace Block\Admin\Admin\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{
    protected $admin = null;

    function __construct(){   
       $this->setTemplate('./View/admin/admin/edit/tabs/form.php'); 
    }

    public function setAdmin($admin = NULL){
        if (!$admin){
            $admin = \Mage::getModel('Model\Admin');
            if ($id = $this->getRequest()->getGet('adminId')){ 
                $admin = $admin->load($id);
            }
        }
        $this->admin = $admin;
        return $this;
    }
    public function getAdmin(){
        if (!$this->admin){
            $this->setAdmin();
        }
        return $this->admin;
    }
}

?>