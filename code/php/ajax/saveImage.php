<?php
$post = $_POST;
$string = NOW;
$string = str_replace(array(':'),"-", $string);
$output_file = 'testScreens/qp1'.$string.'.png';
echo alert($output_file);
$base64_string = $post["photo"];
echo alert($base64_string);

$ifp = fopen($output_file, "wb");

$data = explode(',', $base64_string);

fwrite($ifp, base64_decode($data[1]));
fclose($ifp);

echo true;
exit;
?>
