<?php 

namespace Controller\Core;
class Pager{
    protected $totalRecords = null;
    protected $recordsPerPages = null;
    protected $numberOfPages = null;
    protected $start = 1;
    protected $end = null;
    protected $previous = null;
    protected $next = null;
    protected $currentPage = null;

    public function setTotalRecords($record){
        $this->totalRecords = (int)$record;
        return $this;

    }
    public function getTotalRecords(){
        return $this->totalRecords;
    }

    public function setRecordsPerPages($record){
        $this->recordsPerPages = (int)$record;
        return $this;
    }
    public function getRecordsPerPages(){
        return $this->recordsPerPages;
    }

    protected function setNumberOfPages($record){
        $this->numberOfPages = $record;
        return $this;
    }
    public function getNumberOfPages(){
        return $this->numberOfPages;
    }

    protected function setStart($record){
        $this->start = $record;
        return $this;
    }
    public function getStart(){
        return $this->start;
    }

    protected function setEnd($record){
        $this->end = $record;
        return $this;
    }
    public function getEnd(){
        return $this->end;
    }

    public function setCurrentPage($page){
        $this->currentPage = (int)$page;
        return $this;
    }
    public function getCurrentPage(){
        return $this->currentPage;
    }

    protected function setPrevious($value){
        $this->previous = $value;
        return $this;
    }
    public function getPrevious(){
        return $this->previous;
    }

    protected function setNext($value){
        $this->next = $value;
        return $this;
    }
    public function getNext(){
        return $this->next;
    }

    public function calculate(){
        if($this->getTotalRecords() <= $this->getRecordsPerPages()){
            $this->setNumberOfPages(1);
            // $this->setEnd(null);
            $this->setPrevious(null);
            $this->setNext(null);
            return $this;
        }

        $pages = ceil($this->getTotalRecords() / $this->getRecordsPerPages());
        $this->setNumberOfPages($pages);
        $this->setEnd($pages);

        if($this->getCurrentPage() > $this->getEnd()){
            $this->setCurrentPage($this->getEnd());
        }
        if($this->getCurrentPage() < $this->getStart()){
            $this->setCurrentPage($this->getStart());
        }
        if($this->getCurrentPage() == $this->getStart()){
            $this->setPrevious(null);
            // $this->setStart(null);
            if($this->getCurrentPage() < $this->getNumberOfPages()){
                $this->setNext($this->getCurrentPage() + 1);
            }
            return $this;
        }
        if($this->getCurrentPage() == $this->getEnd()){
            $this->setNext(null);
            // $this->setEnd(null);
            if($this->getCurrentPage() >= $this->getNumberOfPages()){
                $this->setPrevious($this->getCurrentPage() - 1);
            }
            return $this;
        }
        if($this->getCurrentPage() < $this->getEnd() && $this->getCurrentPage() > $this->getStart()){
            $this->setPrevious($this->getCurrentPage() - 1);
            $this->setNext($this->getCurrentPage() + 1);
        }
        return $this;
    }



}

?>