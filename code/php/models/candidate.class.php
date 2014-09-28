<?php
class candidate
{
    public $id;
    public $first_name;    
    public $middle_name;
    public $last_name;
    public $experience; //in months
    public $current_organization;
    public $user_name;
    public $password;
    
    public function insert_into_db()
    {
        $candidate                       = R::dispense(TABLE_CANDIDATE);
        $candidate->first_name           = $this->first_name;
        $candidate->middle_name          = $this->middle_name;
        $candidate->last_name            = $this->last_name;
        $candidate->experience           = $this->experience;
        $candidate->current_organization = $this->current_organization;
        $candidate->user_name            = $this->user_name;
        $candidate->password             = $this->password;

        return R::store($candidate);
    }
    
    public function insert_directly_into_db($c)
    {
        $c  = R::dispense(TABLE_CANDIDATE);
        return R::store($c);
    }
    
    public static function load($id)
    {
        return R::load(TABLE_CANDIDATE, $id);
    }
    
}
?>
