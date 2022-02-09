<?php
//用于打开网页时展示留言
include_once("connect.php");//连接数据库
$q=mysqli_query($link,"select * from message");//获取数据库的数据
while($row=mysqli_fetch_array($q)){
		$comments[] = array("id"=>$row['id'],"username"=>$row['username'],"comment"=>$row['comment'],"addtime"=>$row['addtime']);
}
echo json_encode($comments);//以json格式编码