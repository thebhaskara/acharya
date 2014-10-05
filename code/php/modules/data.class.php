<?php
class data{
    
    public function connect()
    {
        R::setup("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER_NAME,DB_PASSWORD);
    }
    
    function fetch_candidate_history($candidate_id)
    {
        $sql = 'SELECT r.total_marks total_marks, r.insert_time insert_time FROM result r
                INNER JOIN questionpaper qp ON qp.id = r.question_paper_id
                INNER JOIN questionpaperstatus qps ON qps.id = qp.status_id
                WHERE qps.status = :status
                AND qp.candidate_id = :id
                ORDER BY r.insert_time DESC';
        
        $rows = R::getAll($sql, array(':status'=>RESULT_DECLARED, ':id'=>$candidate_id));
        
        $past_results = array();
        
        if(!isset($rows) || $rows == null)
            return $past_results;
        
        foreach($rows as $row)
        {
            $past_result = array();
            $past_result["total_marks"] = $row["total_marks"];
            $past_result["insert_time"] = $row["insert_time"];
            array_push($past_results, $past_result);
        }
        
        return $past_results;        
    }
    
    function fetch_candidate_result($result_id)
    {
        $result = result::load($result_id);       
        return $result->export();
    }
    
    function insert_exam_into_db($exam, $exam_parameters)
    {
        $exam_id = $exam->insert_into_db();
        $exam_obj = exam::load($exam_id);
        
        foreach($exam_parameters as $exam_parameter)
        {
            $exam_parameter->exam = $exam_obj;
            $exam_parameter->insert_into_db();
        }
        
        return $exam_id;
    }
    
    function createpaper($exam_id, $candidate_id)
    {
        //try
        //    {
        //        //$topic_id = 1;
        //        $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER_NAME,DB_PASSWORD);
        //        // execute the stored procedure
        //        $sql = 'CALL CREATEPAPERNEW(:examid, :candidateid)';
        //        //$q = $conn->query($sql);
        //        //$q->setFetchMode(PDO::FETCH_ASSOC);
        //        $stmt = $conn->prepare($sql);
        //        $stmt->bindParam(':examid', $exam_id, PDO::PARAM_INT);
        //        $stmt->bindParam(':candidateid', $candidate_id, PDO::PARAM_INT);
        //        $stmt->execute();
        //        $stmt->closeCursor();
        //        //$r = $conn->query("SELECT @text AS text")->fetch(PDO::FETCH_ASSOC);
        //        
        //        //if ($r) 
        //        //{
        //            //echo sprintf('text = %s', $r['text']);
        //        //}
        //    }
        //    catch (PDOException $pe) 
        //    {
        //        die("Error occurred:" . $pe->getMessage());
        //    }
        
        $sql = 'CALL CREATEPAPERNEW(:examid, :candidateid)';
        
        R::exec( $sql, array(':examid'=>$exam_id, ':candidateid'=>$candidate_id));
        
    }
    
    function insert_question_into_db($questions, $scenario)
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
                $answer->description = 'answer text';
                $answer->is_right_answer = $ans[1];
                //$answer->description = "desc";
                $answer->insert_into_db();
            }
        }
        
        return $scenario_id;
        
    }
    
    function fetch_current_exam_details($candidate_id)
    {
        $question_paper_id;
        
        $sql = 'SELECT qp.id question_paper_id, e.total_questions total_questions, e.duration duration, e.marks total_marks
                FROM questionpaper qp
                INNER JOIN questionpaperstatus qps ON qps.id = qp.status_id
                INNER JOIN exam e ON e.id = qp.exam_id
                WHERE candidate_id = :id
                AND qps.status = :status
                ORDER BY last_updated_time desc
                LIMIT 1';
        
        $rows = R::getAll( $sql, array(':id'=>$candidate_id, ':status'=>REVIEWED_READY_TO_ATEMPT));
        
        foreach($rows as $row)
        {
            $question_paper = array();
            $question_paper["question_paper_id"] = $row["question_paper_id"];
            $question_paper["total_questions"] = $row["total_questions"];
            $question_paper["duration"] = $row["duration"];
            $question_paper["total_marks"] = $row["total_marks"];
        }
        
        return $question_paper;
    }
    
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
        
        $sql = 'UPDATE questionpaper qp, questionpaperstatus qps
                SET qp.status_id = qps.id
                WHERE qps.status = :status';
        
        R::exec($sql, array(':status'=>ATTEMPT_IN_PROGRESS));
        
        return $scenarios;
    }
    
    function storeresult($candidate_id, $result_details)
    {
        $question_paper_id;
        $total_marks;
        $obtained_marks;
        
        $sql = 'SELECT qp.id question_paper_id
                FROM questionpaper qp
                INNER JOIN questionpaperstatus qps ON qps.id = qp.status_id
                WHERE candidate_id = :id
                AND qps.status = :status
                ORDER BY last_updated_time desc
                LIMIT 1';
        
        $rows = R::getAll( $sql, array(':id'=>$candidate_id, ':status'=>ATTEMPT_IN_PROGRESS));
        
        foreach($rows as $row)
        {
            $question_paper_id = $row['question_paper_id'];
            //echo $question_paper_id;
        }
        
        $result = new result();
        $result->candidate = candidate::load($candidate_id);
        $result->question_paper = question_paper::load($question_paper_id);
        $result->total_marks = 0.0;
        $result_id = $result->insert_into_db();
        
        $result_obj = result::load($result_id);
        
        foreach($result_details as $rd)
        {
            $result_detail = new result_detail();
            $result_detail->result = $result_obj;
            $result_detail->question = question::load($rd->question_id);
            $result_detail->answer = $rd->answer;
            $result_detail->explanation = '';
            $result_detail->weightage = 0.0;
            $result_detail->insert_into_db();
        }
        
        $empty_string = '';
        $boolean_true = 'true';
        
        $sql = 'update resultdetail rd
                inner join question as q on q.id = rd.question_id
                inner join level as l on l.id = q.level_id
                inner join answer as a on a.question_id = q.id
                set rd.weightage = IF(STRCMP(rd.answer,a.option) = 0, l.correct_answer_weightage , -l.wrong_answer_weightage)
                where rd.result_id = :id1
                and rd.answer <> :id2
                and a.is_right_answer = :id3';
        
        R::exec( $sql, array(':id1'=>$result_id, ':id2'=>$empty_string, ':id3'=>$boolean_true));
        
        $sql = 'select SUM(l.correct_answer_weightage) total, SUM(weightage) obtained from resultdetail rd
                inner join question as q on q.id = rd.question_id
                inner join level as l on l.id = q.level_id
                inner join result as r on r.id = rd.result_id
                where rd.result_id = :id';
        
        $rows = R::getAll( $sql, array(':id'=>$result_id));
        
        foreach($rows as $row)
        {
            $total_marks = $row['total'];
            $obtained_marks = $row['obtained'];
        }
        
        //echo $total_marks;
        //echo "<br>";
        //
        //echo $obtained_marks;
        //echo "<br>";
        
        $sql = 'select e.marks from exam e
                inner join questionpaper as qp on qp.exam_id = e.id
                where qp.id = :id';
        
        $rows = R::getAll( $sql, array(':id'=>$question_paper_id));
        
        foreach($rows as $row)
        {
            //echo $row['marks'];
            $total_marks = $obtained_marks * $row['marks'] / $total_marks;
        }
        
        $sql = 'update result
                set total_marks = :id1
                where id = :id2';
        
        R::exec( $sql, array(':id1'=>$total_marks, ':id2'=>$result_id));
        
        $sql = 'UPDATE questionpaper qp, questionpaperstatus qps
                SET qp.status_id = qps.id
                WHERE qps.status = :status';
        
        R::exec($sql, array(':status'=>RESULT_DECLARED));
        
        return fetch_candidate_result($result_id);
    }
    
}
?>
