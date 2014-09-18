<?php
class answer
{
    public $id;
    public $question_id;
    public $option;
    public $description;
    public $is_right_answer;
    
    public function insert_into_db()
    {
        
        //data::connect();

        $answer  = R::dispense(TABLE_ANSWER);
        $answer->question = question::load($this->question_id);
        $answer->option = $this->option;
        $answer->description = $this->description;
        $answer->is_right_answer = $this->is_right_answer;

        return R::store($answer);
    }
    
    public function insert_directly_into_db($l)
    {
        $l  = R::dispense(TABLE_ANSWER);
        return R::store($l);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_ANSWER, $id);
    }
    
}
?>
