<?php
class data{
    public function connect(){
        R::setup("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER_NAME,DB_PASSWORD);
    }
    
    
}
?>
