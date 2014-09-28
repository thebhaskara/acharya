<?php
class topic
{
    public $id;
    public $text;
    public $parent_topic_id;
    public $parentTopic;

    public function insert_into_db()
    {
        $topic  = R::dispense(TABLE_TOPIC);

        $topic->text = $this->text;
        if($this->parent_topic_id>0)
            $topic->parentTopic = topic::load($this->parent_topic_id);

        return R::store($topic);
    }

    public function insert_directly_into_db($l)
    {
        $l  = R::dispense(TABLE_TOPIC);
        return R::store($l);
    }

    public static function load($id)
    {
        return R::load(TABLE_TOPIC, $id);
    }

    public static function get_all(){
        $topics = array();
        $topicBeans = R::findAll(TABLE_TOPIC);

        foreach($topicBeans as $topicBean){
            $topic = topic::map_bean_to_topic( $topicBean);
            array_push($topics, $topic);
        }
        return $topics;
    }

    public static function map_bean_to_topic($bean){
        $topic = new topic();
        $topic->id = $bean->id;
        $topic->text = $bean->text;
        //echo alert($bean);
        //exit();
        if(isset($bean->parent_topic_id))
            $topic->parentTopic = topic::map_bean_to_topic( topic::load($bean->parent_topic_id));
        return $topic;
    }

}
?>