<?php

namespace Model;
class Payment extends \Model\Core\Table{

    const STATUS_ENABLED = 1;
    const  STATUS_DISABLED = 0;

    public function __construct(){
        parent::__construct();
        $this->setTableName("payment");
        $this->setPrimaryKey("methodId");
    }

    public function getStatusOption(){
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }
}


?>