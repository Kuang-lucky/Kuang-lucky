<html>
<head>
    <!-- 解决弹窗对话框乱码问题 -->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
 
<?php
	session_start();
	if (isset($_POST["Submit"]) && $_POST["Submit"] == "上传"){
			$adminid = $_SESSION['adminid'];
			$college = $_POST["college"];
			$article="空";
			$wp_links = $_POST["wp_links"];
			$wp_code = $_POST["wp_code"];
			//连接数据库
			$servername = "localhost";
			$username = "root";
			$password = "1700130234";
			$dbname = "php";
			// 创建连接
			$conn = new mysqli($servername, $username, $password,$dbname);
			//SQL语句
			$sql = "select wp_links from wp_link where wp_links = '$wp_links'";
			//执行SQL语句
			$result = $conn->query($sql);
			//统计执行结果影响的行数
			$num = $result->num_rows;
			//如果已经存在该用户
			if($num){
						echo "<script>alert('链接已存在'); history.go(-1);</script>";
					}
			else{
						//不存在当前真题资料链接
						$sql_insert = "insert into wp_link (userid,article,college,wp_links,wp_code) values('$adminid','$article','$college','$wp_links','$wp_code')";
							$res_insert = $conn->query($sql_insert);
							$num_insert = $res_insert->num_rows;
						if($res_insert){
								echo "<script>alert('上传成功！'); history.go(-1);</script>";
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