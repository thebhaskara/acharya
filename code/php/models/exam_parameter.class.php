<?php
class exam_parameter
{
    public $id;
    public $exam_id;
    public $number_of_questions;
    public $topic_id;
    public $level_id;
    
    public function insert_into_db()
    {
        
        //data::connect();

        $exam_parameter                       = R::dispense(TABLE_EXAMPARAMETERS);
        $exam_parameter->exam_id              = $this->$exam_id;
        $exam_parameter->number_of_questions  = $this->$number_of_questions;
        $exam_parameter->topic_id             = $this->$topic_id;
        $exam_parameter->level_id             = $this->$level_id;

        return R::store($exam_parameter);
    }
    
    public function insert_directly_into_db($ep)
    {
        $ep  = R::dispense(TABLE_EXAMPARAMETERS);
        return R::store($ep);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_EXAMPARAMETERS, $id);
    }
    
}
?>
