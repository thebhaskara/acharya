<?php
$post = $_POST;

//echo alert($post);
//exit();

$exam                   = new exam();
$exam->name             = $post["name"];
$exam->experience       = $post["experience"];
$exam->total_questions  = $post["questionsCount"];
$exam->duration         = $post["duration"];
//$exam->examiner         = $post["name"];
$exam->examiner         = 1;
$exam->designation      = $post["designation"];
$exam->marks            = $post["marks"];

$exam_parameters        = array();

foreach($post["parameters"] as $detail){
    
    $exam_parameter                         = new exam_parameter();
    $exam_parameter->exam                   = $exam;
    $exam_parameter->number_of_questions    = $detail["questionsCount"];
    $exam_parameter->topic_id               = $detail["topic"]["id"];
    $exam_parameter->level_id               = $detail["level"]["id"];
    
    array_push($exam_parameters, $exam_parameter);
    
}



$id     = data::insert_exam_into_db($exam, $exam_parameters);

if($id<1){
    echo false;
    exit();
}
echo true;
exit();

?> 