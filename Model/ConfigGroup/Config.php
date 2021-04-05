<?php 

namespace Model\ConfigGroup;
class Config extends \Model\Core\Table 
{
    public function __construct(){
        $this->setTableName('config');
        $this->setPrimaryKey('configId');
    }

    
}

?>