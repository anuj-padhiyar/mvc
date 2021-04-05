<?php

namespace Controller\Admin;
class Dashboard extends \Controller\Core\Admin{
    
    public function indexAction(){
        $layout = $this->getLayout();
        echo $layout->toHtml();
    }
}


?>