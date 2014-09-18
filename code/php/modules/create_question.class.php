<?php
class create_question
{
    function insert_into_db($questions, $scenario, $answers)
    {
        $scenario_id = $scenario->insert_into_db();        
        //$scenario = scenario::load($scenario_id);
        
        foreach($questions as $question)
        {
            $question->scenario_id = $scenario_id;
            $question_id = $question->insert_into_db();
            
            foreach ($answers as $value)
            {
                $value->question_id = $question_id;
                $value->description = "desc";
                $value->insert_into_db();
            }
        }
        
        return $scenario_id;
        
    }
}
?>
