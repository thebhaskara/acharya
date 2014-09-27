<?php
class result_detail
{
    public $id;
    public $result_id;
    public $question_id;
    public $answer;
    public $explanation;
    public $weightage;
    
    public function insert_into_db()
    {
        $result_detail               = R::dispense(TABLE_RESULTDETAIL);
        $result_detail->result_id    = $this->result_id;
        $result_detail->question_id  = $this->question_id;
        $result_detail->answer       = $this->answer;
        $result_detail->explanation  = $this->explanation;
        $result_detail->weightage    = $this->weightage;

        return R::store(result_detail);
    }
    
    public function insert_directly_into_db($rd)
    {
        $rd  = R::dispense(TABLE_RESULTDETAIL);
        return R::store($rd);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_RESULTDETAIL, $id);
    }
    
}
?>
