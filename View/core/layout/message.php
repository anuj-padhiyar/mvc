<div>
        <?php 
            $message = $this->getMessage();
            if($success = $message->getSuccess()){ 
                echo $success;
                $message->clearSuccess();
            }
            if($failure = $message->getFailure()){
                echo $failure;
                $message->clearFailure();
            }
        ?>
</div>