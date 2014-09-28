<?php
$post = $_POST;


$exam_id = $post["selectedExam"]["id"];
foreach($post["candidates"] as $candidate){    
    $candidate_id = $candidate["id"];
    create_paper::createpaper($exam_id, $candidate_id);
}

echo "true";
exit();


?>

<pre>Array
(
    [candidates] => Array
        (
            [0] => Array
                (
                    [id] => 2
                    [first_name] => atul
                    [middle_name] => 
                    [last_name] => agrawal
                    [experience] => 12
                    [current_organization] => 
                    [user_name] => 
                    [password] => 
                    [$$hashKey] => object:7
                )

            [1] => Array
                (
                    [id] => 3
                    [first_name] => bhaskar1
                    [middle_name] => a
                    [last_name] => a
                    [experience] => 12
                    [current_organization] => 
                    [user_name] => 
                    [password] => 
                    [$$hashKey] => object:8
                )

        )

    [selectedExam] => Array
        (
            [id] => 1
            [name] => aaaaaaaaaaaa
            [experience] => aaaaaaaaaaaa
            [total_questions] => aaaaaaaaaaaa
            [duration] => aaaaaaaaaaaa
            [examiner_id] => 1
            [designation] => aaaaaaaaaaaa
            [marks] => aaaaaaaaaaaa
            [skill_ids] => 
            [$$hashKey] => object:5
        )

)
</pre>