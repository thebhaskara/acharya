<?php
class result
{
    public $id;
    public $candidate_id;
    public $question_paper_id;
    public $total_marks;
    public $result_details;
    public $insert_time;
    public $last_updated_time;
    public $is_passed;
    
    public function insert_into_db()
    {
        $result                     = R::dispense(TABLE_RESULT);
        $result->candidate          = $this->candidate;
        $result->question_paper     = $this->question_paper;
        $result->total_marks        = $this->total_marks;
        $result->is_passed          = $this->is_passed;
        $result->insert_time        = NOW;
        $result->last_updated_time  = NOW;

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
