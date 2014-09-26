<?php
class create_question
{
    function insert_into_db($questions, $scenario)
    {
        
        $scenario_id = $scenario->insert_into_db();
        
        $scenario_obj = scenario::load($scenario_id);
        
        foreach($questions as $question)
        {
            $question->scenario = $scenario_obj;
            $question_id = $question->insert_into_db();
            
            $question_obj = question::load($question_id);
            
            foreach ($question->answers as $ans)
            {
                $answer = new answer();
                $answer->question = $question_obj;
                $answer->option = $ans[0];
                $answer->description = '';
                $answer->is_right_answer = $ans[1];
                //$answer->description = "desc";
                $answer->insert_into_db();
            }
        }
        
        return $scenario_id;
        
    }
}
?>
