<?php
$post = $_POST;

//echo alert($post);
//exit();

$topic = new topic();

$topic->text = $post["text"];
$topic->parent_topic_id = $post["parentTopicId"];


$id = $topic->insert_into_db();
if($id<1){
    echo "false";
    exit();
}

$topics = topic::get_all();
if(!isset($topics)){
    echo "false";
    exit();
}

echo json_encode($topics);

?>