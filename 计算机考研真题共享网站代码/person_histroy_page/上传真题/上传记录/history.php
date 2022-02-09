<?php
		header("content-type:text/html;charset=utf-8");
		session_start();
		if(!isset($_SESSION['userid'])){
			echo "<script>alert('请先登录');location='../../../login_register_page/login/login.html'</script>";
		}
		$userid=$_SESSION["userid"];
		$psw=$_SESSION["password"];
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
		$sql="select * from user_upload where userid=$userid";
		//执行sql语句
		$result=$conn->query($sql);
		
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>上传历史</title>

</head>
<style type="text/css">
	body{	background-image: url("../../../Files/image/2.jpeg");
			background-repeat: no-repeat ;
			background-size: 100%  ;
			height: 100%;
		}
	.user_info{
				background-color: rgb(255,255,255,0.8);
				margin-top: 30px;;
				margin-left: auto;
				margin-right: auto;
				width: 70%;
				height: 400px;
				-moz-border-radius: 1em;
				-webkit-border-radius: 1em;
				border-radius:1em;
				
			} 
	.h2_info{
		padding-top: 10px;
		color: #5f6268;
		text-align: center;
	}
	table{	
			margin-left: auto;
			margin-right: auto;
			width: 90%px;
			height: 280px;
			border: 1px solid #999;
			border-spacing: 0;/*去掉单元格间隙*/
			color: #5f6268;
			text-align: center;
		
	}
	
</style>
<body>
	<div class="user_info">
		<h2 class="h2_info">上传历史</h2>
		<table  >
			
			 <tr>
            <td>学校全称</td>
            <td>网盘链接</td>
            <td >提取码</td>
        </tr>
            <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>" ;
                    echo "<td>".$row['college']."</td>";
                    echo "<td>".$row['wp_links']."</td>";
                    echo "<td>".$row['wp_code']."</td>";
                    echo "</tr>";
                }
            ?>
			
		</table>
		
	</div>
	
</body>
</html>
