<?php
class question{
    
    public $content;
    public $time_limit;
    public $question_type_id;
    
    
    function insert_into_db(){
        
        //data::connect();
        
        $question  = R::dispense(TABLE_QUESTION);
        $question->content = $this->content;
        $question->time_limit = $this->time_limit;
        
        $question->question_type = R::load(TABLE_QUESTION_TYPE, $this->question_type_id);
        
        return R::store($question);
    }
    
    
    
}
?>
