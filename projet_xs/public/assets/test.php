<?php

//if(!empty($_POST['data'])){
//$data = $_POST['data'];
//$fname = mktime() . ".png";//generates random name
//var_dump($_FILES);
////$file = fopen("upload/" .$fname, 'w');//creates new file
////fwrite($file, $data);
////fclose($file);
//}

$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
//saving
$fileName = 'upload/photo.png';
echo file_put_contents($fileName, $fileData);

?>