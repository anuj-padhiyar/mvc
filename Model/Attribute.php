<?php

namespace Model;
class Attribute extends \Model\Core\Table{

    const STATUS_ENABLED = 1;
    const  STATUS_DISABLED = 0;

    public function __construct(){
        parent::__construct();
        $this->setTableName("attribute");
        $this->setPrimaryKey("attributeId");
    }

    public function getStatusOption(){
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }

    public function getBackendTypeOption(){
        return [
            'varchar(128)'=>'Varchar',
            'int'=>'Int',
            'decimal'=>'Decimal',
            'text'=>'Text'
        ];
    }

    public function getInputTypeOption(){
        return [
            'text'=>'Text Box',
            'textarea'=>'Text Area',
            'select'=>'Select',
            'checkbox'=>'Checkbox',
            'radio'=>'Radio'
        ];
    }

    public function getEntityTypeOptions(){
        return [
            'product'=>'Product',
            'category'=>'Category'
        ];
    }

    public function getOptions(){
        if(!$this->attributeId){
            return false;
        }
        $query = "SELECT * FROM `attribute_option`
            WHERE `attributeId` = '{$this->attributeId}'
            ORDER BY `sortOrder` ASC";
        if($options = \Mage::getModel('Model\Attribute')->fetchAll($query)){
            $options = $options->getData();
        }
        return $options;
        
    }

}


?>