<?php
		$adminid = $_GET['adminid'];
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
	
		//构造SQL查询语句
		$sql = "delete  from  php_admin where adminid=$adminid";
		$result=$conn->query($sql);
		if ($result) {
			echo "<script>alert('删除成功');location='admin_info.php';</script>";
			
		} else {
			echo "<script>alert('删除失败');location='admin_info.php';</script>";
		}

	?>