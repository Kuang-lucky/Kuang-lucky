<?php
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
		$userid = $_GET['userid'];
		$username = $_POST['username'];
		$userpsw = $_POST['userpsw'];
		$sex = $_POST['sex'];
		$E_mail=$_POST['E_mail'];
		$sql="update php_user set userpsw= '"."$userpsw' ,username= '"."$username',sex= '"."$sex',E_mail= '"."$E_mail' where userid = $userid";
		$result= mysqli_query($conn,$sql);
		if($result){
			exit("<script>
				alert('修改成功');
				location.href='update_user_info.php'
			</script>");
		}else{
			exit("<script>
				alert('修改失败');
				location.href='update_user_info.php';
			</script>");
		}
?>
