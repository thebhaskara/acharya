<?php
class level
{
    public $id;
    public $text;
    public $experience;
    public $correct_answer_weightage;
    public $wrong_answer_weightage;
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $level                           = R::dispense(TABLE_LEVEL);
        $level->text                     = $this->text;
        $level->experience               = $this->experience;
        $level->correct_answer_weightage = $this->correct_answer_weightage;
        $level->wrong_answer_weightage   = $this->wrong_answer_weightage;
        $level->insert_time              = NOW;
        $level->last_updated_time              = NOW;

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

    public static function get_all(){
        $levels = array();
        $levelBeans = R::findAll(TABLE_LEVEL);

        foreach($levelBeans as $levelBean){
            $level = topic::map_bean_to_topic( $levelBean);
            array_push($levels, $level);
        }
        return $levels;
    }

    public static function map_bean_to_level($bean){
        $level = new topic();
        $level->id = $bean->id;
        $level->text = $bean->text;
        //echo alert($bean);
        //exit();
        if(isset($bean->parent_topic_id))
            $level->parentTopic = topic::map_bean_to_topic( topic::load($bean->parent_topic_id));
        return $level;
    }
    
}
?>