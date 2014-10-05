<?php
$post = $_POST;

$candidate_id = $session->get(USER_KEY)->id;

$result_details = array();
foreach($post as $question_id => $answer){
    $result_detail = new result_detail();
    $result_detail->question_id = $question_id;
    $result_detail->answer = $answer;
    array_push($result_details, $result_detail);
}

data::storeresult($candidate_id, $result_details);

echo true;
exit();

?> 