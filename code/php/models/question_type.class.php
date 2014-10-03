<?php
class question_type
{
    public $id;
    public $type;
    public $description;
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $question_type              = R::dispense(TABLE_QUESTION_TYPE);
        $question_type->type        = $this->type;
        $question_type->description = $this->description;
        $question_type->insert_time = NOW;
        $question_type->last_updated_time = NOW;

        return R::store($question_type);
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