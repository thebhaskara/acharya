<?php
class exam_parameter
{
    public $id;
    public $exam_id;
    public $number_of_questions; //specific to topic
    public $topic_id;
    public $level_id;
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $exam_parameter                       = R::dispense(TABLE_EXAMPARAMETERS);
        $exam_parameter->exam                 = $this->exam;
        $exam_parameter->number_of_questions  = $this->number_of_questions;
        $exam_parameter->topic                = topic::load($this->topic_id);
        $exam_parameter->level                = level::load($this->level_id);
        $exam_parameter->insert_time          = NOW;
        $exam_parameter->last_updated_time    = NOW;

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
