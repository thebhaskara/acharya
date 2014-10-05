<?php
class session_manager
{
    public $current;
    
    function start()
    {
        session_start();
        $this->current = $_SESSION;
    }
    
    function close()
    {
        $_SESSION = $this->current; 
    }
    
    function add($key, $value)
    {
        $this->current[$key] = $value;
    }    
    
    function get($key)
    {
        return $this->current[$key];
    }
    
    public function validate_while_login($user, $user_name, $pwd)
    {
//        $decrypted_pwd = decrypt($pwd);
        $decrypted_pwd = $pwd;
        
        if($user == EXAMINER)
        {
            $bean=R::findOne(TABLE_EXAMINER,'user_name=:id1 AND password=:id2',array(':id1'=>$user_name, ':id2'=>$decrypted_pwd));
            
            if($bean != null)
            {
                $this->add(USER_TYPE_KEY, $user);
                $this->add(USER_KEY, $bean);
                //echo 'valid examiner';
                return true;
            }
            else
            {
                //echo 'invalid examiner';
                return false;
            }
        }
        else if($user == APPLICANT)
        {
            $bean=R::findOne(TABLE_CANDIDATE,'user_name=:id1 AND password=:id2',array(':id1'=>$user_name, ':id2'=>$decrypted_pwd));
            
            if($bean != null)
            {
                $this->add(USER_TYPE_KEY, $user);
                $this->add(USER_KEY, $bean);
                //echo 'valid applicant';
                return true;
            }
            else
            {
                return false;
                //echo 'invalid applicant';
            }
        }
        else
        {
            return false;
            //echo "invalid user";
        }
    }
    
    function is_examiner(){
        return isset($this->current[USER_TYPE_KEY])? $this->current[USER_TYPE_KEY] == EXAMINER : false;
    }
    
    function is_applicant(){
        return isset($this->current[USER_TYPE_KEY])? $this->current[USER_TYPE_KEY] == APPLICANT : false;
    }
    
    function is_logged_in()
    {
        return isset($this->current[USER_KEY]);
    }
    
    function logout()
    {
        unset($this->current[USER_KEY]);
        unset($this->current[USER_TYPE_KEY]);
        $this->close();
    }
}
?>