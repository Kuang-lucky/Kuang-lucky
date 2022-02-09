<?php
session_start();
date_default_timezone_set($timezone); //北京时间
//用户名和密码都输入后，连接数据库
		$servername="localhost";
		$username="root";
		$password="1700130234";
		$dbname="php";
		//创建连接
		$conn= new mysqli($servername,$username,$password,$dbname);
		//检测连接
		if ($conn->connect_error){
				echo("连接失败");
				die("连接失败：" . $conn->connect_error);
			}
		$adminid=$_SESSION['adminid'];
		$comment = $_POST['comment'];
		$addtime = date('Y-m-d H:i:s');
		//创建SQL语句，获取管理员名字
		$sql_1="select * from php_admin where adminid=$adminid";  //为了获取管理员名字
		//执行sql语句
		$result_1=$conn->query($sql_1);
		while($row_1 = mysqli_fetch_array($result_1))
		{	
			$adminname=$row_1['adminname'];
				
		}
		//将回复内容插入到数据库
		$sql="insert into message(userid,username,comment,addtime) values('$adminid','$adminname','$comment','$addtime')";
		$result= mysqli_query($conn,$sql);
		if($result){
			exit("<script>
				alert('发布成功');
				location.href='pubilc.php';
			</script>");
		}else{
			exit("<script>
				alert('发布失败');
				location.href='public.php';
			</script>");
		}
?>
