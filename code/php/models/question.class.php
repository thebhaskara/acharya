<?php
class question
{
    
    public $id;
    public $content;
    public $question_type_id;
    public $time_limit;
    public $level_id;
    public $topic_id;
    public $scenario_id;
    
    function insert_into_db()
    {
        
        //data::connect();
        
        $question  = R::dispense(TABLE_QUESTION);
        $question->content = $this->content;
        $question->time_limit = $this->time_limit;
        
        $question->question_type = question_type::load($this->question_type_id);
        $question->level = level::load($this->level_id);
        $question->topic = topic::load($this->topic_id);
        $question->scenario = $this->scenario;
        return R::store($question);
    }
    
    function insert_directly_into_db($q)
    {
        $q  = R::dispense(TABLE_QUESTION);
        return R::store($q);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_QUESTION, $id);
    }
    
}
?>
