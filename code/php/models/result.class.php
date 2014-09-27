<?php
class result
{
    public $id;
    public $user_id;
    public $question_paper_id;
    public $total_marks;
    
    public function insert_into_db()
    {
        $result                     = R::dispense(TABLE_RESULT);
        $result->user_id            = $this->user_id;
        $result->question_paper_id  = $this->question_paper_id;
        $result->total_marks        = $this->total_marks;

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
