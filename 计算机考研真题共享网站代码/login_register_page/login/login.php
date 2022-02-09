<html>
<head>
	<!--解决弹框对话框乱码问题-->
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<?php
header("content-type:text/html;charset=utf-8");
session_start();
if (isset($_POST["submit"]) && $_POST["submit"]=="登录"){
	$id=$_POST["userid"];
	$psw=$_POST["password"];
	$code=strtolower($_POST['authcode']);
	$str=strtolower($_SESSION['authcode']);
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
	//设置字符集，解决数据库插入可能出现乱码，设置编码为GBK
	//构造SQL查询语句
	$sql="select userid,userpsw from php_user where userid ='$id' and userpsw='$psw'";
	//执行sql语句
	$result=$conn->query($sql);
	//统计执行结果影响的行数
	$num=$result->num_rows;
	//如果已经存在该用户
	if($num){
				if ($code!=$str) {	
				echo "<script>alert('验证码输入错误');history.go(-1);</script>";	
				}
				//验证码正确
				$_SESSION["userid"]=$id;
				$_SESSION["password"]=$psw;
				//将数据以索引的方式存在数组中
				$row=mysqli_fetch_array($result);
				echo "<script>location='../index.html'</script>";
			
		}
	else{
            //弹出对话框后返回到先前页面
            echo "<script>alert('账号或者密码不正确！');history.go(-1);</script>";

		}
		
	}
else{
	//弹出对话框后返回到先前页面
	echo "<script>alert('请求失败！');history.go(-1);</script>";
}
?>
<body>
		

</body>
</html>
