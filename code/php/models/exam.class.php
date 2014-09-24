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
    
}
?>
