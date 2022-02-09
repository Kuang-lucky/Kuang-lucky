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
		$id = $_GET['id'];
		$college = $_POST['college'];
		$wp_links = $_POST['wp_links'];
		$wp_code = $_POST['wp_code'];
		//修改更新语句
		$sql="update wp_link set college= '"."$college' ,wp_links= '"."$wp_links',wp_code= '"."$wp_code' where id = $id";
		$result= mysqli_query($conn,$sql);
		if($result){
			exit("<script>
				alert('修改成功');
				location.href='data.php'
			</script>");
		}else{
			exit("<script>
				alert('修改失败');
				location.href='data.php';
			</script>");
		}
?>
