<?php
class question_paper
{
    public $id;
    public $exam_id;
    
    public function insert_into_db()
    {
        $question_paper       = R::dispense(TABLE_QUESTION_PAPER);
        $question_paper->exam = $this->exam;

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
