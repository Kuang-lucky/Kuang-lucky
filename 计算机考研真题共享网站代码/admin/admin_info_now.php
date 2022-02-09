<?php
		header("content-type:text/html;charset=utf-8");
		session_start();
		$adminid=$_SESSION["adminid"];
		$psw=$_SESSION["adminpsw"];
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
		$sql="select adminname from php_admin where adminid ='$adminid'";
		$sql_psw="select adminpsw from php_admin where adminid ='$adminid'";
		$sql_1="select sex from php_admin where  adminid ='$adminid'";
		$sql_2="select E_mail from php_admin where adminid ='$adminid'";
		//执行sql语句
		$result=$conn->query($sql);
		$result_psw=$conn->query($sql_psw);	
		$result_1=$conn->query($sql_1);
		$result_2=$conn->query($sql_2);
		
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户信息</title>

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
				width: 400px;
				height: 430px;
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
			width: 380px;
			height: 330px;
			border: 1px solid #999;
			border-spacing: 0;/*去掉单元格间隙*/
			text-align: center;
			color: #5f6268;
		
	}
	table td {
		padding: 10px 20px;

		}
</style>
<body>
	<div class="user_info">
		<h2 class="h2_info">用户信息</h2>
		<table  >
			
			<tr>
				<td>账号:</td>
				<td>
					<?php echo $_SESSION["adminid"]; ?>
				</td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><?php 
						while($row=mysqli_fetch_array($result_psw))
						  {	
							  echo $row['adminpsw'] ;
								
						  }			
					 ?>
				</td>
			</tr>
			<tr>
				
				<td>用户名:</td>
				<td><?php 
						while($row=mysqli_fetch_array($result))
						  {	
							  echo $row['adminname'] ;
								
						  }			
					 ?>
				</td>
			</tr>
			<tr>
				<td>性别:</td>
				<td>
					<?php 
						while($row=mysqli_fetch_array($result_1))
						  {
						  		echo $row['sex'] ;
						  }			
					 ?>
				</td>
			</tr>
			<tr>
				<td>邮箱:</td>
				<td>
					<?php 
							while($row=mysqli_fetch_array($result_2))
							  {
									echo $row['E_mail'] ;
							  }			
					 ?>
				</td>
			</tr>
			
		</table>
		
	</div>
	
</body>
</html>
