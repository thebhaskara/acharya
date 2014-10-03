<?php
class skill
{
    public $id;
    public $name;
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $skill              = R::dispense(TABLE_SKILL);
        $skill->name        = $this->name;
        $skill->insert_time = NOW;
        $skill->last_updated_time = NOW;

        return R::store($skill);
    }
    
    public function insert_directly_into_db($s)
    {
        $s  = R::dispense(TABLE_SKILL);
        return R::store($s);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_SKILL, $id);
    }
    
}
?>