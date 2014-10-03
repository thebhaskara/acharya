 <?php
class candidate_result
{
    function fetch_candidate_result($result_id)
    {
        $result = result::load($result_id);       
        return $result->export();
    }
}
?>
