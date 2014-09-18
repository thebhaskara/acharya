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

$questiontype = new question_type();
$questiontype->type = 'multiple choice';
$questiontype->description = 'Choose one of the options from the given.';

$questiontypeid = $questiontype->insert_into_db();

$question = new question();
$question->content = 'Solve this bloody question';
$question->time_limit = 120;
$question->question_type_id = $questiontypeid;

$id = $question->insert_into_db();
if($id>-1)
    echo "Hurray!! $id";
else
    echo 'WTF!!';

        ?>
    </body>

</html>
