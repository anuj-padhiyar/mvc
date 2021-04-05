<?php

namespace Model\Admin;
class Filter Extends \Model\Admin\Session{

    public function setFilters($filters){
        if(!$filters){
            return false;
        }
        $filters = array_filter(array_map(function($value){
            $value = array_filter($value,function($value){
                if($value === ''){
                    return false;
                }
                return true;
            });
            return $value;
        },$filters));
        $this->filters = $filters;
        return $this;
    }
    public function getFilters(){
        if($this->hasFilters()){
            return $this->filters;
        }
        return false;
    }  
    public function hasFilters(){
        if(!$this->filters){
            return false;
        }
        return true;
    }
    public function clearFilters(){
        if($this->hasFilters()){
            unset($this->filters);
        }
        return $this;
    }

    public function getFilterValue($key,$value){
        if(!$this->hasFilters()){
            return null;
        }
        if(!array_key_exists($key, $this->filters)){
            return null;
        }
        if(!array_key_exists($value,$this->filters[$key])){
            return null;
        }
        return $this->filters[$key][$value];
    }
}

?>