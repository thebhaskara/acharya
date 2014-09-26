<?php
$post = $_POST;

//echo alert($post);
//exit();

$level = new level();

$level->text = $post["text"];
$level->experience = $post["experience"];
$level->correct_answer_weightage = $post["correct"];
$level->wrong_answer_weightage = $post["wrong"];


data::connect();
$id = $level->insert_into_db();
if($id<1){
    echo false;
    exit();
}
echo true;
exit();
?>