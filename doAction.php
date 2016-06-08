<?php
print_r($_FILES);
$filename = $_FILES['myfile']['name'];
$type  = $_FILES['myfile']['type'];
$tmp_name = $_FILES['myfile']['tmp_name'];
$error = $_FILES['myfile']['error'];
$size = $_FILES['myfile']['size'];

// move_uploaded_file($tmp_name, destination) 将服务器的临时文件移动到指定文件里面
// move_uploaded_file($tmp_name, $filename);
// copy($tmp_name, $filename)

?>