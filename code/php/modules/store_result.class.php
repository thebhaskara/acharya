<?php
class store_result
{
    function storeresult($candidate_id, $question_answer_set)
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
        
        foreach()
        {
            $sql = 'INSERT INTO';
            R::exec($sql);
        }
        
        //$sql = 'SELECT s.id scenario_number, s.summary, s.instruction, s.content scenario_content, 
        //        q.id question_number, q.content question_content, a.id answer_id, a.option, a.is_right_answer
        //        FROM questionpaperdetail qpd
        //        INNER JOIN question as q on q.id = qpd.question_id
        //        INNER JOIN scenario as s on s.id = q.scenario_id
        //        INNER JOIN answer as a on a.question_id = q.id
        //        INNER JOIN questionpaper as qp on qp.id = qpd.question_paper_id
        //        WHERE qp.id = :id
        //        ORDER BY s.id, q.id';
        //
        //$rows = R::getAll( $sql, array(':id'=>$question_paper_id));
        
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
        
        
        //echo alert($scenarios);
        return $scenarios;
    }
}
?>




























