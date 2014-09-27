 <?php
class create_paper
{
    function createpaper($exam_id, $candidate_id)
    {
        try
            {
                //$topic_id = 1;
                $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER_NAME,DB_PASSWORD);
                // execute the stored procedure
                $sql = 'CALL CREATEPAPER(:examid, :candidateid)';
                //$q = $conn->query($sql);
                //$q->setFetchMode(PDO::FETCH_ASSOC);
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':examid', $exam_id, PDO::PARAM_INT);
                $stmt->bindParam(':candidateid', $candidate_id, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
                //$r = $conn->query("SELECT @text AS text")->fetch(PDO::FETCH_ASSOC);
                
                //if ($r) 
                //{
                    //echo sprintf('text = %s', $r['text']);
                //}
            }
            catch (PDOException $pe) 
            {
                die("Error occurred:" . $pe->getMessage());
            }
    }
}
?>
