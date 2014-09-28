<?php
class result
{
    public $id;
    public $candidate_id;
    public $question_paper_id;
    public $total_marks;
    public $result_details;
    
    public function insert_into_db()
    {
        $result                  = R::dispense(TABLE_RESULT);
        $result->candidate       = $this->candidate;
        $result->question_paper  = $this->question_paper;
        $result->total_marks     = $this->total_marks;

        return R::store($result);
    }
    
    public function insert_directly_into_db($r)
    {
        $r  = R::dispense(TABLE_RESULT);
        return R::store($r);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_RESULT, $id);
    }
    
}
?>
