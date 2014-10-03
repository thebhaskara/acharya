 <?php
class current_exam
{
    function fetch_current_exam($candidate_id)
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
}
?>
