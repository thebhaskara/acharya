<?php
class start_exam
{
    function startexam($candidate_id)
    {
        $question_paper_id;
        
        $sql = 'select id from questionpaper
        where candidate_id = :id
        order by id desc
        limit 1';
        
        $rows = R::getAll( $sql, array(':id'=>$candidate_id));
        
        foreach($rows as $row)
        {
            $question_paper_id = $row['id'];
            //echo $question_paper_id;
        }
        
        $sql = 'SELECT s.id scenario_number, s.summary, s.instruction, s.content scenario_content, 
                q.id question_number, q.content question_content, a.id answer_id, a.option, a.is_right_answer
                FROM questionpaperdetail qpd
                INNER JOIN question as q on q.id = qpd.question_id
                INNER JOIN scenario as s on s.id = q.scenario_id
                INNER JOIN answer as a on a.question_id = q.id
                INNER JOIN questionpaper as qp on qp.id = qpd.question_paper_id
                WHERE qp.id = :id
                ORDER BY s.id, q.id';
        
        $rows = R::getAll( $sql, array(':id'=>$question_paper_id));
        
        //foreach($rows as $row)
        //{            
        //    echo $row['scenario_number'], $row['summary'], $row['instruction'], $row['scenario_content'],                                          $row['question_number'], $row['question_content'], $row['answer_id'], $row['option'],                                            $row['is_right_answer'];
        //    echo "<br>";
        //}

        $scenario = array();
        $scenarios = array();
        $question = array();
        $questions = array();
        $answer = array();
        
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        foreach($rows as $row)
        {
            if(!isset($scenarios[$row["scenario_number"]])){
                $scenarios[$row["scenario_number"]] = array();
                $scenarios[$row["scenario_number"]]["summary"] = $row["summary"];
                $scenarios[$row["scenario_number"]]["instruction"] = $row["instruction"];
                $scenarios[$row["scenario_number"]]["scenario_content"] = $row["scenario_content"];
            }
            
            if(!isset($scenarios[$row["scenario_number"]]["questions"]))
                $scenarios[$row["scenario_number"]]["questions"] = array();
            
            if(!isset($scenarios[$row["scenario_number"]]["questions"][$row["question_number"]])){
                $scenarios[$row["scenario_number"]]["questions"][$row["question_number"]] = array();
                $scenarios[$row["scenario_number"]]["questions"][$row["question_number"]]["question_content"] = $row["question_content"];
            }
            
            if(!isset($scenarios[$row["scenario_number"]]["questions"][$row["question_number"]]["answers"]))
                $scenarios[$row["scenario_number"]]["questions"][$row["question_number"]]["answers"] = array();            
            
            $scenarios[$row["scenario_number"]]["questions"][$row["question_number"]]["answers"][$row["answer_id"]] = $row['option'];
        }
        
        
        //echo alert($scenarios);
        return $scenarios;
         /*   
        foreach($rows as $row)
        {
            //$scenario[$row['scenario_number']] = $row['scenario_number'];
            //$question[$row['question_number']][] = $row['answer_id'];
            //$scenario[$row['scenario_number']][] = $row;
        }
        
        $scenario = array_slice($scenario, 0);
        var_dump($scenario);
        
        foreach($scenario as $s)
        {
            foreach($rows as $row)
            {
                if($row['scenario_number'] = $s)
                {
                    var_dump($row['question_number']);
                }
            }
        }
        
        
        //$question = array_slice($question, 0);
        //var_dump($question);
        echo "<br>";
        echo count($scenario);
        echo "<br>";
        //echo count($question);
        
        echo "<br>";
        
        foreach($scenario as $s)
        {
            
        }
        
        
        //foreach($scenario as $s)
        //{
        //    $question[$row] = $s;
        //}
        //
        //var_dump($question);
        */
    }
}
?>




























