<?php
class exam
{
    public $id;
    public $name;
    public $experience;
    public $total_questions;
    public $duration;
    public $examiner_id;
    public $designation;
    public $marks;
    
    public function insert_into_db()
    {
        
        //data::connect();

        $exam                   = R::dispense(TABLE_EXAM);
        $exam->name             = $this->name;
        $exam->experience       = $this->experience;
        $exam->total_questions  = $this->total_questions;
        $exam->duration         = $this->duration;
        $exam->examiner_id      = $this->examiner_id;
        $exam->designation      = $this->designation;
        $exam->marks            = $this->marks;

        return R::store($exam);
    }
    
    public function insert_directly_into_db($e)
    {
        $e  = R::dispense(TABLE_EXAM);
        return R::store($e);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_EXAM, $id);
    }
    
}
?>
