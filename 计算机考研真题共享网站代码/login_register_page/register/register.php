<html>
<head>
    <!-- 解决弹窗对话框乱码问题 -->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
 
<?php
	if (isset($_POST["Submit"]) && $_POST["Submit"] == "注册"){
			$userid = $_POST["userid"];
			$user = $_POST["username"];
			$psw = $_POST["password"];
			$psw_confirm = $_POST["confirm"];
			$sex="未知";
			$E_mail="未知";
			if($psw == $psw_confirm)
			{
				//连接数据库
				$servername = "localhost";
				$username = "root";
				$password = "1700130234";
				$dbname = "php";
				// 创建连接
				$conn = new mysqli($servername, $username, $password,$dbname);
				//设定字符集,解决数据库插入可能出现乱码，设置编码为GBK
				//mysql_query("set names 'gdk'");
				//SQL语句
				$sql = "select userid from php_user where userid = '$userid'";
				//执行SQL语句
				$result = $conn->query($sql);
				//统计执行结果影响的行数
				$num = $result->num_rows;
				//如果已经存在该用户
				if($num){
							echo "<script>alert('用户名已存在'); history.go(-1);</script>";
						}
				else{
							//不存在当前注册用户名称
							$sql_insert = "insert into php_user (userid,username,userpsw,sex,E_mail) values('$userid','$user','$psw','$sex','$E_mail')";
							$res_insert = $conn->query($sql_insert);
							$num_insert = $res_insert->num_rows;
							if($res_insert){
									echo "<script>alert('注册成功！'); history.go(-1);</script>";
								}
							else{
									var_dump($conn->error_list);
									echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
								}
					 }
						
				}
		}
	else{
			echo "<script>alert('请求失败！'); history.go(-1);</script>";
		}
?>