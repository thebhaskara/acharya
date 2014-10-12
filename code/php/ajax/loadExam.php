<?php
$question_paper_id = $_POST["qid"];
$scenarios = data::startexam($question_paper_id);

$data = array();
$data["scenarios"] = $scenarios;
$data["Exam"] = data::get_exam_using_qp($question_paper_id);

//ob_flush();
//header('Content-Type: application/json');
echo json_encode($data);
exit();
