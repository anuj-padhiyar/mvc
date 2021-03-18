<?php
namespace Model;
\Mage::loadFileByClassName("Model\Core\Table");
class CmsPages extends \Model\Core\Table{

    const STATUS_ENABLED = 1;
    const  STATUS_DISABLED = 0;

    public function __construct(){
        parent::__construct();
        $this->setTableName("cms_page");
        $this->setPrimaryKey("pageId");
    }

    public function getStatusOption(){
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }
}


?>