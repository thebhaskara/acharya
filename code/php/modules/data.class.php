<?php
class data{
    public connect(){
        R::setup('mysql:host=localhost;
        dbname=mydatabase','user','password');
    }
}
?>
