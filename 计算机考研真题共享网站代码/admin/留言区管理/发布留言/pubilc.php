<?php
session_start();
header("Content-Type: text/html; charset=utf-8");//设置头部样式
date_default_timezone_set($timezone); //北京时间
$adminid=$_SESSION['adminid'];
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
		$sql="select * from php_admin where adminid=$adminid";  //为了获取管理员名字
		//执行sql语句
		$result=$conn->query($sql);
	while($row = mysqli_fetch_array($result))
		{	
			$adminname=$row['adminname'];
				
		}
?>
<!DOCTYPE html>
<html lang="en" xmlns:margin-top="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>发布留言</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入 Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<!-- FontAwesome JS-->
	<link href="../../../Files/assets/fontawesome/css/font-awesome.min.css">
	<script defer src="../../../Files/assets/fontawesome/js/all.min.js"></script>
	<script src="../../../Files/css/bootstrap.min.css"></script>

    <!-- 整体背景 -->
    <style type="text/css">
        html{
            height: 100%;
        }
       body{	background-image: url("../../../Files/image/2.jpeg");
				background-repeat: no-repeat ;
				background-size: 100%  ;
				height: 100%;
		}
        .col-center-block {
				background-color: rgb(255,255,255,0.8);
				float: none;
				display: block;
				margin-left: auto;
				margin-right: auto;
				margin-top: 30px;
				text-align: center;
				width: 400px;
				height: 400px;
				-moz-border-radius: 1em;
				-webkit-border-radius: 1em;
				border-radius:1em;
        }
        .edit {
            margin-top: 20px;
        }
        .textcolor{
			color: #5f6268;
			padding-top: 30px;
		}
    </style>
</head>
<body>
    <div class="container">
        <div class="row row-centered">
            <div class="col-xs-6 col-md-4 col-center-block">
                <h2 class="textcolor">发布留言</h2>
				
                <form method="post" action="dopublic.php" >
					<!-- 管理员名称 -->
                    <div class="edit input-group input-group-md ">
						<span class="input-group-addon" style="color:#28b76b ">
							发布人员：
						</span>
                        <input type="text" class="form-control"  name='adminname'  value=<?php echo $adminname; ?> />
                    </div>
                    <!-- 发布内容 -->
                    <div class="edit input-group input-group-md input_bk">
						<span class="input-group-addon"   style="color:#28b76b ">
							发布内容：
						</span>
						<input type="text" class="form-control" name='comment'  placeholder="请输入留言内容" />
                    </div>
					<!-- 回复内容 -->
                    <div class="edit input-group input-group-md input_bk">
						<span class="input-group-addon"   style="color:#28b76b ">
							发布时间：
						</span>
						<input type="text" class="form-control" name='addtime'  value=<?php echo date('Y-m-d H:i:s'); ?> />
                    </div>
					<br/>
                    <button  type="submit" class="info btn btn-success btn-block" name="submit" value="回复">发布</button>
					
                </form>
            </div>
        </div>
    </div>
</body>
</html>