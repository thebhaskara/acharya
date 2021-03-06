<?php
class start_exam
{
    function startexam($question_paper_id)
    {   
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

        shuffle($rows);
        
        $scenario = array();
        $scenarios = array();
        $question = array();
        $questions = array();
        $answer = array();
        
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
        if(count($rows)>0){
        $sql = 'UPDATE questionpaper qp
                INNER JOIN questionpaperstatus qps ON qps.id = qp.status_id
                SET qp.status_id = qps.id
                WHERE qps.status = :status';
        
        R::exec($sql, array(':status'=>ATTEMPT_IN_PROGRESS));
        }
        
        return $scenarios;
    }
}
?>