<?php
$post = $_POST;

//echo alert($post);
//exit();

$is_valid = $session->validate_while_login($post["usertype"], $post["username"], $post["password"]);

if($is_valid){
    echo "true";
} else {
    echo "false";
}
$session->close();
exit;
?>