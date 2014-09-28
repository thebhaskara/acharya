<?php
class exam
{
    public $id;
    public $name;
    public $experience; // in months
    public $total_questions;
    public $duration; // in minutes
    public $examiner_id;
    public $designation;
    public $marks;
    public $skill_ids;
    
    public function insert_into_db()
    {
        $exam                   = R::dispense(TABLE_EXAM);
        $exam->name             = $this->name;
        $exam->experience       = $this->experience;
        $exam->total_questions  = $this->total_questions;
        $exam->duration         = $this->duration;
        $exam->examiner         = examiner::load($this->examiner_id);
        $exam->designation      = $this->designation;
        $exam->marks            = $this->marks;

        foreach ($this->skill_ids as $skill_id)
        {
            $relation = R::dispense(TABLE_EXAMSKILLRELATION);
            $skill = skill::load($skill_id);
            
            if (!$skill->id) 
            {
                $skill->name = 'operating system';
            }
            
            $relation->exam = $exam;
            $relation->skill = $skill;
            
            $ID = R::store($relation);
        }
        
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

    public static function get_all(){
        $items = array();
        $beans = R::findAll(TABLE_EXAM);

        foreach($beans as $bean){
            $item = exam::map_bean_to_object($bean);
            array_push($items, $item);
        }
        return $items;
    }

    public static function map_bean_to_object($bean){
        $exam = new exam();
        $exam->id               = $bean->id;
        $exam->name             = $bean->name;
        $exam->experience       = $bean->experience;
        $exam->total_questions  = $bean->total_questions;
        $exam->duration         = $bean->duration;
        $exam->examiner_id      = $bean->examiner_id;
        $exam->designation      = $bean->designation;
        $exam->marks            = $bean->marks;
        return $exam;
    }

    
}
?>