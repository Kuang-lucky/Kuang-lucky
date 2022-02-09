<?php
$userid = $_GET['userid'];
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
		$sql="select * from php_user where userid=$userid";
		//执行sql语句
		$result=$conn->query($sql);	
		while($row = mysqli_fetch_array($result))
		{	
			$userpsw=$row['userpsw'];
			$username=$row['username'];
			$sex=$row['sex'];
			$E_mail=$row['E_mail'];
			
		}
?>
<!DOCTYPE html>
<html lang="en" xmlns:margin-top="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>修改用户信息</title>
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
                <h2 class="textcolor">修改信息</h2>
                <form method="post" action="doupdate.php?userid=<?php echo $userid ?>">
					<!-- 输入密码 -->
                    <div class="edit input-group input-group-md ">
						<span class="input-group-addon" style="color:#28b76b ">
							密&nbsp;&nbsp;&nbsp;&nbsp;码：
						</span>
                        <input type="text" class="form-control"  name='userpsw'  value=<?php echo $userpsw?> />
                    </div>
					<!-- 输入用户名 -->
                    <div class="edit input-group input-group-md ">
						<span class="input-group-addon" style="color:#28b76b ">
							用户名：
						</span>
                        <input type="text" class="form-control" type="text" name='username'  value=<?php echo $username?> />
                    </div>
					
                    <!-- 修改性别 -->
                    <div class="edit input-group input-group-md input_bk">
						<span class="input-group-addon"   style="color:#28b76b ">
								性&nbsp;&nbsp;&nbsp;&nbsp;别：
						</span>
						<input type="text" class="form-control" name='sex' value=<?php echo $sex?> maxlength="2"/>
 
                    </div>
					<!-- 修改邮箱 -->
                    <div class="edit input-group input-group-md input_bk">
						<span class="input-group-addon"  style="color:#28b76b ">
							邮&nbsp;&nbsp;&nbsp;&nbsp;箱：
						</span>
                    <input type="text" class="form-control" type="text" name='E_mail' value=<?php echo $E_mail?> />
					</div>
					<br/>
                    <button  type="submit" class="info btn btn-success btn-block" name="submit" value="提交">提交</button>
					
                </form>
            </div>
        </div>
    </div>
</body>
</html>