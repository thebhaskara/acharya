<?php
$post = $_POST;

//echo alert($post);
//exit();

$sce = $post["scenario"];


$scenario = new scenario();
$scenario->summary = $sce["summary"];
$scenario->instruction = $sce["instructions"];
$scenario->content = $sce["content"];

$ques = $post["questions"];
$questions = array();

foreach ($ques as $que) {
//    echo alert($que);
    $question = new question();

    $question->content = $que["content"];
    $question->time_limit = $que["timeLimit"];
    $question->question_type_id = $que["typeId"];
    $question->level_id = $que["levelId"];
    $question->scenario = $scenario;

    $question->topic_ids = array();
    foreach($que["selTopics"] as $topic) {
        array_push($question->topic_ids, $topic["id"]);
    }
    
    $question->answers = array(
        array($que["answer1"], isset($que["answer1isright"])?$que["answer1isright"]: false),
        array($que["answer2"], isset($que["answer2isright"])?$que["answer2isright"]: false),
        array($que["answer3"], isset($que["answer3isright"])?$que["answer3isright"]: false),
        array($que["answer4"], isset($que["answer4isright"])?$que["answer4isright"]: false)
    );
//    echo alert($question);
    array_push($questions, $question);
}

//echo alert($scenario);
//echo alert($questions);
//exit();

$id = data::insert_question_into_db($questions,$scenario);

if($id>-1)
    echo "true";
else
    echo "false";
exit();

?>