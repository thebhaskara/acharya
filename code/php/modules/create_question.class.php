<?php
class create_question
{
    function insert_into_db($q, $s)
    {
        $scenario_id = $s->insert_into_db();
        $q->scenario = scenario::load($scenario_id);
        return $q->insert_into_db();
    }    
}
?>
