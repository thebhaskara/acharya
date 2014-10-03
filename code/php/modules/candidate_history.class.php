 <?php
class candidate_history
{
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
}
?>
