<?php
class question
{
    
    public $id;
    public $content;
    public $question_type_id;
    public $time_limit;
    public $level_id;
    public $topic_ids;
    public $scenario_id;
    public $topics;
    public $answers;
	public $usage_count;
    public $insert_time;
    public $last_updated_time;
    
    function insert_into_db()
    {
        $question                = R::dispense(TABLE_QUESTION);
        $question->content       = $this->content;
        $question->time_limit    = $this->time_limit;        
        $question->question_type = question_type::load($this->question_type_id);
        $question->level         = level::load($this->level_id);
        //$question->topic       = topic::load($this->topic_id); //will be used when a question belongs to just one topic
        $question->scenario      = $this->scenario;
        $question->usage_count   = 0;
        $question->insert_time   = NOW;
        $question->last_updated_time   = NOW;
        
        foreach ($this->topic_ids as $topic_id)
        {
            $relation = R::dispense(TABLE_QUESTIONTOPICRELATION);
            $topic = topic::load($topic_id);
            $relation->question = $question;
            $relation->topic = $topic;
            $relation->insert_time   = NOW;
            $relation->last_updated_time   = NOW;
            $ID = R::store($relation);
        }
        
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