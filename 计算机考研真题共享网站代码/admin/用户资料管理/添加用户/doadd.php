<?php
	$userid = $_POST["userid"];
	$username = $_POST["username"];
	$userpsw = $_POST["userpsw"];
	$sex=$_POST["sex"];
	$E_mail=$_POST["E_mail"];
	//连接数据库
	$servername = "localhost";
	$name = "root";
	$password = "1700130234";
	$dbname = "php";
	// 创建连接
	$conn = new mysqli($servername, $name, $password,$dbname);
	if (isset($_POST["submit"]) && $_POST["submit"] == "普通用户")
	{
		// 创建连接
		$conn = new mysqli($servername, $name, $password,$dbname);
		//SQL语句
		$sql = "select userid from php_user where userid = '$userid'";
		//执行SQL语句
		$result = $conn->query($sql);
		//统计执行结果影响的行数
		$num = $result->num_rows;
		//如果已经存在该用户
		if($num){
					echo "<script>alert('账号已存在'); history.go(-1);</script>";
				}
		else{
					//不存在当前注册用户名称
					$sql_insert = "insert into php_user (userid,username,userpsw,sex,E_mail) values('$userid','$username','$userpsw','$sex','$E_mail')";
					$res_insert = $conn->query($sql_insert);
					$num_insert = $res_insert->num_rows;
					if($res_insert){
							echo "<script>alert('添加成功！'); history.go(-1);</script>";
						}
					else{
							var_dump($conn->error_list);
							echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
						}
			}
						
		}
	else if(isset($_POST["submit"]) && $_POST["submit"] == "管理员"){
		// 创建连接
		$conn = new mysqli($servername, $name, $password,$dbname);
		//SQL语句
		$sql = "select adminid from php_admin where adminid = '$userid'";
		//执行SQL语句
		$result = $conn->query($sql);
		//统计执行结果影响的行数
		$num = $result->num_rows;
		//如果已经存在该用户
		if($num){
					echo "<script>alert('账号已存在'); history.go(-1);</script>";
				}
		else{
					//不存在当前注册用户名称
					$sql_insert = "insert into php_admin (adminid,adminname,adminpsw,sex,E_mail) values('$userid','$username','$userpsw','$sex','$E_mail')";
					$res_insert = $conn->query($sql_insert);
					$num_insert = $res_insert->num_rows;
					if($res_insert){
							echo "<script>alert('添加成功！'); history.go(-1);</script>";
						}
					else{
							var_dump($conn->error_list);
							echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
						}
			}
		
	}
	else{
			echo "<script>alert('请求失败！'); history.go(-1);</script>";
		}
?>