<?php
require_once('php/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Title is not decided yet</title>
    </head>

    <body>
<?php
data::connect();
//$questiontype = new question_type();
//$questiontype->type = 'multiple choice';
//$questiontype->description = 'Choose one of the options from the given.';
//
//$id = $questiontype->insert_into_db();

$question = new question();
$question->content = 'Solve this question';
$question->question_type_id = 2;
$question->time_limit = 12;
$question->level_id = 1;
$question->topic_id = 1;
//$question->scenario_id = 1;

$scenario = new scenario();
$scenario->summary = "abc";
$scenario->instruction = "xyz";
$scenario->content = "as,duiyncvdfyv";

//$id = $question->insert_into_db();
$create_question = new create_question();
$id = $create_question->insert_into_db($question, $scenario);

if($id>-1)
    echo "Hurray!! $id";
else
    echo 'WTF!!';
?>
    </body>

</html>
