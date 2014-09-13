<?php
class question_type{
    
    public $type;
    public $description;
    
    public function insert_into_db(){
        
        //data::connect();

        $question  = R::dispense(TABLE_QUESTION_TYPE);
        $question->type = $this->type;
        $question->description = $this->description;

        return R::store($question);
    }
}
?>