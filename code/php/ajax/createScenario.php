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
data::connect();
$id = create_question::insert_into_db($questions,$scenario);

if($id>-1)
    echo "true";
else
    echo "false";
exit();

?>

<pre>Array
(
    [scenario] => Array
        (
            [instructions] => this is a test scenario
            [summary] => test scenario
        )

    [questions] => Array
        (
            [0] => Array
                (
                    [id] => 0
                    [$$hashKey] => 004
                    [selectableTopics] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 1
                                    [text] => C#
                                    [$$hashKey] => 00G
                                )

                            [1] => Array
                                (
                                    [id] => 2
                                    [text] => Aptitude
                                    [$$hashKey] => 00H
                                )

                            [2] => Array
                                (
                                    [id] => 3
                                    [text] => Database
                                    [$$hashKey] => 00I
                                )

                            [3] => Array
                                (
                                    [id] => 4
                                    [text] => C++
                                    [$$hashKey] => 00J
                                )

                        )

                    [timeLimit] => 12
                    [questionTypeText] => Multiple choice
                    [type] => Array
                        (
                            [id] => 1
                            [text] => Multiple choice
                            [$$hashKey] => 00A
                        )

                    [topictext] => 
                    [topic] => 
                    [selTopics] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 1
                                    [text] => C#
                                    [$$hashKey] => 00G
                                )

                        )

                    [leveltext] => Beginner
                    [level] => Array
                        (
                            [id] => 1
                            [text] => Beginner
                            [$$hashKey] => 00O
                        )

                    [answer1] => 12431
                    [answer2] => 2222
                    [answer3] => 3333
                    [answer4] => 4444
                )

            [1] => Array
                (
                    [id] => 1
                    [$$hashKey] => 010
                    [selectableTopics] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 1
                                    [text] => C#
                                    [$$hashKey] => 00G
                                )

                            [1] => Array
                                (
                                    [id] => 2
                                    [text] => Aptitude
                                    [$$hashKey] => 00H
                                )

                            [2] => Array
                                (
                                    [id] => 3
                                    [text] => Database
                                    [$$hashKey] => 00I
                                )

                            [3] => Array
                                (
                                    [id] => 4
                                    [text] => C++
                                    [$$hashKey] => 00J
                                )

                        )

                    [timeLimit] => 12
                    [questionTypeText] => Multiple choice
                    [type] => Array
                        (
                            [id] => 1
                            [text] => Multiple choice
                            [$$hashKey] => 00A
                        )

                    [topictext] => 
                    [topic] => 
                    [selTopics] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 2
                                    [text] => Aptitude
                                    [$$hashKey] => 00H
                                )

                            [1] => Array
                                (
                                    [id] => 3
                                    [text] => Database
                                    [$$hashKey] => 00I
                                )

                        )

                    [leveltext] => 1yr Exp.
                    [level] => Array
                        (
                            [id] => 2
                            [text] => 1yr Exp.
                            [$$hashKey] => 00P
                        )

                    [answer1] => ss
                    [answer2] => ww
                    [answer3] => ee
                    [answer4] => xx
                )

        )

)
</pre>