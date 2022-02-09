<?php
	$id=$_GET["id"];
	//连接数据库
	$servername = "localhost";
	$username = "root";
	$password = "1700130234";
	$dbname = "php";
	// 创建连接
	$conn = new mysqli($servername, $username, $password,$dbname);
	//构造SQL查询语句
	$sql="select * from user_upload where id=$id";
	//执行sql语句
	$result=$conn->query($sql);	
	while($row = mysqli_fetch_array($result))
			{	$userid=$row['userid'];
			 	$college=$row['college'];
				$wp_links=$row['wp_links'];
			 	$wp_code=$row['wp_code']; 
			 	$article="空";
			 	$sql_insert = "insert into wp_link (userid,article,college,wp_links,wp_code) values('$userid','$article','$college','$wp_links','$wp_code')";
							$res_insert = $conn->query($sql_insert);
							$num_insert = $res_insert->num_rows;
						if($res_insert){
								echo "<script>alert('审核通过，已上传！'); location='delete.php?id=$id';</script>";
							}
						else{
								var_dump($conn->error_list);
								echo "<script>alert('系统繁忙，请稍候！');location='check.php';</script>";
							}
			}
?>
