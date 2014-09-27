<?php
class question_paper_detail
{
    public $id;
    public $question_paper_id;
    public $question_id;
    public $correct_answer;
    
    public function insert_into_db()
    {
        $question_paper_detail       = R::dispense(TABLE_QUESTION_PAPER_DETAIL);
        $question_paper_detail->question_paper = $this->question_paper;
        $question_paper_detail->question = $this->question;
        $question_paper_detail->correct_answer = $this->correct_answer;

        return R::store($question_paper_detail);
    }
    
    public function insert_directly_into_db($s)
    {
        $s  = R::dispense(TABLE_QUESTION_PAPER_DETAIL);
        return R::store($s);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_QUESTION_PAPER_DETAIL, $id);
    }
    
}
?>
