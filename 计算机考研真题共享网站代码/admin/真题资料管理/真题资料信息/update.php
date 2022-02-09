<?php
$id = $_GET['id'];
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
		$sql="select * from wp_link where id=$id";
		//执行sql语句
		$result=$conn->query($sql);	
		while($row = mysqli_fetch_array($result))
		{	
			$college=$row['college'];
			$wp_links=$row['wp_links'];
			$wp_code=$row['wp_code'];
			
		}
?>
<!DOCTYPE html>
<html lang="en" xmlns:margin-top="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>修改真题资料</title>
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
                <form method="post" action="doupdate.php?id=<?php echo $id ?>">
					<!-- 学校名称 -->
                    <div class="edit input-group input-group-md ">
						<span class="input-group-addon" style="color:#28b76b ">
							学校名称：
						</span>
                        <input type="text" class="form-control"  name='college'  value=<?php echo $college ?> />
                    </div>
                    <!-- 修改网盘链接 -->
                    <div class="edit input-group input-group-md input_bk">
						<span class="input-group-addon"   style="color:#28b76b ">
								网盘链接：
						</span>
						<input type="text" class="form-control" name='wp_links' value=<?php echo $wp_links ?> />
 
                    </div>
					<!-- 提取码 -->
                    <div class="edit input-group input-group-md input_bk">
						<span class="input-group-addon"  style="color:#28b76b ">
							提&nbsp;&nbsp;取&nbsp;&nbsp;码：
						</span>
                    <input type="text" class="form-control" type="text" name='wp_code' value=<?php echo $wp_code?> />
					</div>
					<br/>
                    <button  type="submit" class="info btn btn-success btn-block" name="submit" value="提交">提交</button>
					
                </form>
            </div>
        </div>
    </div>
</body>
</html>