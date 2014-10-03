<?php
class question_paper_status
{
    public $id;
    public $status;
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $question_paper_status              = R::dispense(TABLE_QUESTION_PAPER_STATUS);
        $question_paper_status->status      = $this->status;
        $question_paper_status->insert_time = NOW;
        $question_paper_status->last_updated_time = NOW;
        
        return R::store($question_paper_status);
    }
    
    public function insert_directly_into_db($qps)
    {
        $qps  = R::dispense(TABLE_QUESTION_PAPER_STATUS);
        return R::store($qps);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_QUESTION_PAPER_STATUS, $id);
    }
    
}
?>
