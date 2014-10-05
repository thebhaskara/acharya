<?php
$post = $_POST;


$exam_id = $post["selectedExam"]["id"];
foreach($post["candidates"] as $candidate){    
    $candidate_id = $candidate["id"];
    data::createpaper($exam_id, $candidate_id);
}

echo "true";
exit();
?>