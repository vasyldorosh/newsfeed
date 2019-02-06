<?php
$f = $_SERVER['DOCUMENT_ROOT'] . '/../app/Services/Curl.php';
var_dump($f);
include($f);
$image = isset($_GET['image']) ? $_GET['image'] : false;
if (substr($image, 0, 2) == '//') {
    $image = 'https:' . $image;
}
$file_extension = strtolower(substr(strrchr($image, "."), 1));
$ctype = 'image/jpeg';
switch ($file_extension) {
    case "gif": $ctype = "image/gif";
        break;
    case "png": $ctype = "image/png";
        break;
    case "jpeg":
    case "jpg": $ctype = "image/jpeg";
        break;
    default:
}
//header('Content-type: ' . $ctype);
if ($image) {
    $data = (new Curl($image))->init()->execute()->close()->getResponse();
    var_dump($data);
    //echo $data;
}
?>