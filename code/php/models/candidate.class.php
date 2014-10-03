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
    public $insert_time;
    public $last_updated_time;
    
    public function insert_into_db()
    {
        $candidate                       = R::dispense(TABLE_CANDIDATE);
        $candidate->first_name           = $this->first_name;
        $candidate->middle_name          = $this->middle_name;
        $candidate->last_name            = $this->last_name;
        $candidate->experience           = $this->experience;
        //$candidate->current_organization = $this->current_organization;
        $candidate->user_name            = $this->user_name;
        $candidate->password             = encrypt($this->password);
        $candidate->insert_time          = NOW;
        $candidate->last_updated_time    = NOW;

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

    public static function get_all(){
        $items = array();
        $beans = R::findAll(TABLE_CANDIDATE);

        foreach($beans as $bean){
            $item = candidate::map_bean_to_object($bean);
            array_push($items, $item);
        }
        return $items;
    }

    public static function map_bean_to_object($bean){
        $candidate = new candidate  ();
        $candidate->id                   = $bean->id;
        $candidate->first_name           = $bean->first_name;
        $candidate->middle_name          = $bean->middle_name;
        $candidate->last_name            = $bean->last_name;
        $candidate->experience           = $bean->experience;
        //$candidate->current_organization = $bean->current_organization;
        //$candidate->user_name            = $bean->user_name;
        //$candidate->password             = $bean->password;

        return $candidate;
    }

    
}
?>