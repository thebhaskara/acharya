<?php
class store_result
{
    function storeresult($candidate_id, $result_details)
    {
        $question_paper_id;
        $total_marks;
        $obtained_marks;
        
        $sql = 'select id from questionpaper
        where candidate_id = :id
        order by id desc
        limit 1';
        
        $rows = R::getAll( $sql, array(':id'=>$candidate_id));
        
        foreach($rows as $row)
        {
            $question_paper_id = $row['id'];
//            echo $question_paper_id;
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
        
//       echo $total_marks;
//       echo "<br>";
//       
//       echo $obtained_marks;
//       echo "<br>";
        
        $sql = 'select e.marks from exam e
                inner join questionpaper as qp on qp.exam_id = e.id
                where qp.id = :id';
        
        $rows = R::getAll( $sql, array(':id'=>$question_paper_id));
        
        foreach($rows as $row)
        {
//            echo $row['marks'];
            $total_marks = $obtained_marks * $row['marks'] / $total_marks;
        }
        
        $sql = 'update result
                set total_marks = :id1
                where id = :id2';
        
        R::exec( $sql, array(':id1'=>$total_marks, ':id2'=>$result_id));
        
        return $result_id;
    }
}
?>