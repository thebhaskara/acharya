<?php
class session_manager
{
    $current;
    function start()
    {
        session_start();
        $this->current = $_SESSION;
    }
    
    function kill()
    {
        $_SESSION = $this->current; 
    }
    
    function add($key, $value)
    {
        $this->current[$key] = $value;
    }    
    
    public function validate_while_login($user, $user_name, $pwd)
    {
        if($user == EXAMINER)
        {
            $bean=R::findOne(TABLE_EXAMINER,'user_name=:id1 AND password=:id2',array(':id1'=>$user_name, ':id2'=>$pwd));
            
            if($bean != null)
            {
                $this->add(USER_KEY, $bean);
                echo 'valid examiner';
                return true;
            }
            else
            {
                echo 'invalid examiner';
            }
        }
        else if($user == APPLICANT)
        {
            $bean=R::findOne(TABLE_CANDIDATE,'user_name=:id1 AND password=:id2',array(':id1'=>$user_name, ':id2'=>$pwd));
            
            if($bean != null)
            {
                $this->add(USER_KEY, $bean);
                echo 'valid applicant';
                return true;
            }
            else
            {
                echo 'invalid applicant';
            }
        }
        else
        {
            echo "invalid user";
        }
    }
    
    function is_logged_in()
    {
        return isset($this->current[USER_KEY]);
    }
    
    function logout()
    {
        unset($this->current[USER_KEY]);
    }
}
?>
