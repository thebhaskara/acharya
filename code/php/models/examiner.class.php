<?php
class examiner
{
    public $id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $designation;
    public $joining_date;
    public $experience; // in months
    public $user_name;
    public $password;
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $examiner                  = R::dispense(TABLE_EXAMINER);
        $examiner->first_name      = $this->first_name;
        $examiner->middle_name     = $this->middle_name;
        $examiner->last_name       = $this->last_name;
        //$examiner->designation   = $this->designation;
        //$examiner->joining_date  = $this->joining_date;
        $examiner->experience      = $this->experience;
        $examiner->user_name       = $this->user_name;
        //$examiner->password        = encrypt($this->password);
        $examiner->password        = $this->password;
        $examiner->insert_time     = NOW;
        $examiner->last_updated_time     = NOW;

        return R::store($examiner);
    }
    
    public function insert_directly_into_db($ex)
    {
        $ex  = R::dispense(TABLE_EXAMINER);
        return R::store($ex);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_EXAMINER, $id);
    }
}
?>