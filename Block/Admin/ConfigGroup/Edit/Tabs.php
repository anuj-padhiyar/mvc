<?php
namespace Block\Admin\ConfigGroup\Edit;
class Tabs extends \Block\Core\Edit\Tabs{

    function __construct(){
        parent::__construct();
    }

    public function prepareTabs(){
        $this->addTab('information',['key' => 'information',
                                'label'=>'Information',
                                'block'=>'Block\Admin\ConfigGroup\Edit\Tabs\Information']);
        if($this->getRequest()->getGet('groupId')){
            $this->addTab('configuration',['key' => 'configuration',
                                    'label'=>'Configration',
                                    'block'=>'Block\Admin\ConfigGroup\Edit\Tabs\Configuration']);
        }
        $this->setDefaultTab('information');
        return $this;
    }
}


?>