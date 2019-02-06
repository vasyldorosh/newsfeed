<?php
$image = isset($_GET['image']) ? $_GET['image'] : false;
if (substr($image, 0, 2) == '//') {
    $image = 'https:' . $image;
}
$file_extension = strtolower(substr(strrchr($image,"."),1));
switch( $file_extension ) {
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpeg"; break;
    default:
}
header('Content-type: ' . $ctype);
if ($image) {
    echo file_get_contents($image);
}
