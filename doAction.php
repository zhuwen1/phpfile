<?php 
print_r($_FILES);
	//1获取文件名字号
$filename = $_FILES['myfile']['name'];
$error = $_FILES['myfile']['error'];
$tmp_name = $_FILES['myfile']['tmp_name'];
$size = $_FILES['myfile']['size'];
$type = $_FILES['myfile']['type'];
echo($filename)."<br><br>";
//判断错误号，只有为0的时候upload_err_ok,没有错误发生
if($error == UPLOAD_ERR_OK){
	if(move_uploaded_file($tmp_name, $filename)){
		echo "文件".$filename."上传成功";
	}else{
		echo "文件".$filename."上传失败";
	}
}else {
	switch ($error) {
		case 1:
			# code...
			echo "上传文件的大小超过了php配置文件的upload_max_filesize选项的值";
			break;
		case 2:
			echo "超过了max_flie_size限制的大小";
		break;
		case 3:
		 	echo "文件部分被上传";
		 	break;
		case 4:
			echo "没有选择上传文件";
			break;
		case 6:
			echo "没有找到临时文件";
			break;
		case 7:
		case 8:
			echo "系统错误";
			break;
		default:
			# code..
			echo "日了够";
			break;
	}
}

?>