<?php
class skill
{
    public $id;
    public $name;
    
    public function insert_into_db()
    {
        
        //data::connect();

        $skill       = R::dispense(TABLE_SKILL);
        $skill->name = $this->name;

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
