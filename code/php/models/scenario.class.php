<?php
class scenario
{
    public $id;
    public $summary;
    public $instruction;
    public $content;
    public $usage_count;
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $scenario              = R::dispense(TABLE_SCENARIO);
        $scenario->summary     = $this->summary;
        $scenario->instruction = $this->instruction;
        $scenario->content     = $this->content;
        $scenario->usage_count = isset($this->usage_count)? $this->usage_count : 0;;
        $scenario->insert_time = NOW;
        $scenario->last_updated_time = NOW;

        return R::store($scenario);
    }
    
    public function insert_directly_into_db($s)
    {
        $s  = R::dispense(TABLE_SCENARIO);
        return R::store($s);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_SCENARIO, $id);
    }
    
}
?>