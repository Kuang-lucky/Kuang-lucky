<?php
include_once("connect.php");
header("content-type:text/html;charset=utf-8");
session_start();
$username = htmlspecialchars(trim($_POST['username']));
$txt = htmlspecialchars(trim($_POST['txt']));
if(empty($username)){
    $data = array("code"=>355,"message"=>"昵称不能为空！");
    echo json_encode($data);
    exit;
}
if(empty($txt)){
    $data = array("code"=>356,"message"=>"内容不能为空");
    echo json_encode($data);
    exit;
}
$time = date("Y-m-d H:i:s");
$userid=htmlspecialchars(trim($_SESSION['userid']));
$query=mysqli_query($link,"insert into message(userid,username,comment,addtime)values('$userid','$username','$txt','$time')");
if($query)  {
    $data = array("code" => 1, "message"=>"success","username" => $username , "txt" => $txt);
    echo json_encode($data);
}

?>