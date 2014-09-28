<?php
$post = $_POST;

//echo alert($post);
//exit();

if($post["ussertype"] == EXAMINER){
    $user = new examiner();
    //$examiner->designation   = $post["firstname"];
    //$examiner->joining_date  = $post["firstname"];
    $user->first_name           = $post["firstname"];
    $user->middle_name          = $post["middlename"];
    $user->last_name            = $post["lastname"];
    $user->experience           = $post["experience"];
    //$user->current_organization = $post["organisation"];
    $user->user_name            = $post["username"];
    $user->password             = $post["password"];
} else {
    $user                       = new candidate();
    $user->first_name           = $post["firstname"];
    $user->middle_name          = $post["middlename"];
    $user->last_name            = $post["lastname"];
    $user->experience           = $post["experience"];
    //$user->current_organization = $post["organisation"];
    $user->user_name            = $post["username"];
    $user->password             = $post["password"];

}

$id = $user->insert_into_db();

if($id>0){
    echo "true";
} else {
    echo "false";
}
exit;
?>