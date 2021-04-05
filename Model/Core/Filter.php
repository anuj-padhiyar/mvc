<?php

namespace Model\Core;
class Filter Extends Model\Core\Session{
    
    public function setFilter($filter){
        $this->filter = $filter;
        return $this;
    }
    public function getFilter(){
        if(empty($_SESSION)){
            return null;
        }
        return $this->filter;
    }
    public function clearFilter(){
        unset($this->filter);
        return $this;
    }
}



?>