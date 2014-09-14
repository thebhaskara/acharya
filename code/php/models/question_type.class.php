<?php
class question_type
{
    public $id;
    public $type;
    public $description;
    
    public function insert_into_db()
    {
        
        //data::connect();

        $question  = R::dispense(TABLE_QUESTION_TYPE);
        $question->type = $this->type;
        $question->description = $this->description;

        return R::store($question);
    }
    
    public function insert_directly_into_db(question_type $qt)
    {
        $qt  = R::dispense(TABLE_QUESTION_TYPE);
        return R::store($qt);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_QUESTION_TYPE, $id);
    }
    
}
?>
