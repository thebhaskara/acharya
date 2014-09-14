<?php
class level
{
    public $id;
    public $text;
    public $experience;
    public $correct_answer_weightage;
    public $wrong_answer_weightage;
    
    public function insert_into_db()
    {
        
        //data::connect();

        $level  = R::dispense(TABLE_LEVEL);
        $level->text = $this->text;
        $level->experience = $this->experience;
        $level->correct_answer_weightage = $this->correct_answer_weightage;
        $level->wrong_answer_weightage = $this->wrong_answer_weightage;

        return R::store($level);
    }
    
    public function insert_directly_into_db($l)
    {
        $l  = R::dispense(TABLE_LEVEL);
        return R::store($l);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_LEVEL, $id);
    }
    
}
?>
