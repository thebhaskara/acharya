<?php
class question_paper
{
    public $id;
    public $exam_id;
    public $candidate_id;
    public $status_id;
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $question_paper              = R::dispense(TABLE_QUESTION_PAPER);
        $question_paper->exam        = $this->exam;
        $question_paper->candidate   = $this->candidate;
        $question_paper->status      = $this->status;
        $question_paper->insert_time = NOW;
        $question_paper->last_updated_time = NOW;
        
        return R::store($question_paper);
    }
    
    public function insert_directly_into_db($qp)
    {
        $qp  = R::dispense(TABLE_QUESTION_PAPER);
        return R::store($qp);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_QUESTION_PAPER, $id);
    }
    
}
?>