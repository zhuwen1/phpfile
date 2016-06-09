<?php
/**
 * Created by PhpStorm.
 * User:zhuwen
 * Date: 2016/6/9
 * Time: 13:57
 */

$fileInfo =  $_FILES['myfile'];
$error = $fileInfo['error'];
function upLoadFile($fileInfo,$path="uploads",$flag =false,$allowExt=array('jepg','jpg','gif','png'),$maxSize= 2097152)
{
//1判断错误号
    $filename = $fileInfo['name'];
    if ($fileInfo['error'] > 0) {
        switch ($fileInfo['error']) {
            case 1:
                # code...
                $msg = "上传文件的大小超过了php配置文件的upload_max_filesize选项的值";
                break;
            case 2:
                $msg = "超过了max_flie_size限制的大小";
                break;
            case 3:
                $msg = "文件部分被上传";
                break;
            case 4:
                $msg = "没有选择上传文件";
                break;
            case 6:
                $msg = "没有找到临时文件";
                break;
            case 7:
            case 8:
                $msg = "系统错误";
                break;
            default:
                # code..
                $msg = "日了够";
                break;
        }
        exit($msg);
    }
    if(!file_exists($path)){
        mkdir($path,0777,true);
        chmod($path,0777);
    }
    $ext =strtolower(end(explode(".",$filename)));
    $uniName = md5(uniqid(microtime(true),true)).'.'.$ext;
    $destination = $path."/".$uniName;
    if (!in_array($ext,$allowExt)){
        exit("非法文件类型");
    }
    if ($fileInfo['size']>$maxSize){
        exit("文件过大");
    }
    if(!is_uploaded_file($fileInfo['tmp_name'])){
        exit("文件不是通过http post方式上传过来的");
    }
    if($flag){
        if(!getimagesize($fileInfo['tmp_name'])){
            exit("不是真正的图片类型");
        }
    }
    if(!@move_uploaded_file($fileInfo['tmp_name'],$destination)){
        echo "文件上传失败";
    }
    return $destination;
}