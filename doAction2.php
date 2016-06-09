<?php
/**
 * Created by PhpStorm.
 * User: zhuwen
 * Date: 2016/6/9
 * Time: 10:48
 */
header('content-type:text/html;charset=utf-8');
$allowExt = array('jpeg','jpg','png','gif','wbmp');
$maxSize  = 2097152;//允许的最大值
$fileInfo = $_FILES['myfile'];

$tmp_name = $fileInfo['tmp_name'];
$filename = $fileInfo['name'];
$error = $fileInfo['error'];
$size = $fileInfo['size'];

//1.判断错误号
if($error == 0){
    //判断文件大小是否符合要求
    if($size>$maxSize) {
        exit('上传文件过大');
    }
    //判断文件大类型是否正确
    $ext =strtolower(end(explode(".",$filename)));//获取文件后缀名
    if (!in_array($ext,$allowExt)){
        exit("非法文件类型");
    }
    if(!is_uploaded_file($tmp_name)){
        exit("文件不是通过http post方式上传过来的");
    }
    $path ='uploads';
    if(!file_exists($path)){
    	mkdir($path,0777,true);
    	chmod($path,0777);
    }
    // $destination = $filename;
    $uniName = md5(uniqid(microtime(true),true)).'.'.$ext;
   	$destination = $path."/".$uniName;
   //产生唯一名字
    if(move_uploaded_file($tmp_name,$destination)){
        echo "文件上传成功";
    }else{
        echo "文件上传失败";
    }
}else{
    //匹配错误信息
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