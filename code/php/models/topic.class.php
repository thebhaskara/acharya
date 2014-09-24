<?php
class topic
{
    public $id;
    public $name;
    public $parent_topic_id;
    
    public function insert_into_db()
    {
        $topic  = R::dispense(TABLE_TOPIC);
        $topic->name = $this->name;
        $topic->parent_topic_id = $this->parent_topic_id;

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
    
}
?>
