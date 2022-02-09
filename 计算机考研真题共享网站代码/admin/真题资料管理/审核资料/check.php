<?php
		header("content-type:text/html;charset=utf-8");
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
		$sql="select * from user_upload";
		//执行sql语句
		$result=$conn->query($sql);	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>审核上传资料</title>

</head>
<style type="text/css">
	body{	
			height: 100%;
		}
	.user_info{
				margin-left: auto;
				margin-right: auto;
				-moz-border-radius: 1em;
				-webkit-border-radius: 1em;
				border-radius:1em;
				
			} 
	
	table{	
			margin-left: auto;
			margin-right: auto;
			border-spacing: 0;/*去掉单元格间隙*/
			text-align: center;
			color: #5f6268;
		
	}
	table td {
		border-bottom: 1px solid rgba(200,198,198,1.00);
		padding: 5px 10px;
		}
	a{
		TEXT-DECORATION:none ;
	}
</style>
<body>
<div class="user_info">
	<table >
			<tr>
				<td>序号</td>
				<td>用户账号</td>
				<td>学校名称</td>
				<td>网盘链接</td>
				<td>提取码</td>
				<td>通过</td>
				<td>删除</td>
			</tr>
				<?php
					while($row = mysqli_fetch_array($result))
					{	echo "<tr>";
					 	echo "<td>".$row['id']."</td>";
					 	echo "<td>".$row['userid']."</td>";
						echo "<td>".$row['college']."</td>";
						echo "<td>".$row['wp_links']."</td>";
						echo "<td>".$row['wp_code']."</td>"; 
					 	$id=$row['id'];
						echo "<td><button><a href=pass.php?id=$id style=color:#28b76b>通过</a></button></td>";
					 	echo "<td><button><a href=delete.php?id=$id style=color:#28b76b>删除</a></button></td>";
					 	echo "<tr>";
					 	
					}
				?>
		</div>	
</body>
</html>
