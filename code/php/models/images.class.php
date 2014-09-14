<?php
class images
{
    public $id;
    public $name;
    public $path;
    public $binary_content;
    
    public function insert_into_db()
    {
        
        //data::connect();

        $images  = R::dispense(TABLE_IMAGES);
        $images->name = $this->name;
        $images->path = $this->path;
        $images->binary_content = $this->binary_content;

        return R::store($images);
    }
    
    public function insert_directly_into_db($l)
    {
        $l  = R::dispense(TABLE_IMAGES);
        return R::store($l);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_IMAGES, $id);
    }
    
}
?>
