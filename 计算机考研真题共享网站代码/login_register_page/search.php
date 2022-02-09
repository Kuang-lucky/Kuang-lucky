<?php
	session_start();
	if(isset($_SESSION['userid'])){
		    $school = $_POST['search'];  //接收超链接name属性的内容
			$link = mysqli_connect("localhost:3306","root","1700130234");//数据库端口的连接
			mysqli_select_db($link, "php");//连接数据库
			mysqli_query($link, "set name 'utf-8'");//查询语句设置字符集
			$str =" select wp_links,wp_code from wp_link  where college like '%".$school."%'";  //查询语句
			$result = mysqli_query($link,$str);
			$arr=array();
			while($row = mysqli_fetch_array($result))
			{
				$arr[] = $row;
			}
	}else{
	echo "<script>alert('请先登录');location='../login_register_page/login/login.html'</script>";
	}
  
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

<!-- FontAwesome JS-->
<link href="../Files/assets/fontawesome/css/font-awesome.min.css">
<script defer src="../Files/assets/fontawesome/js/all.min.js"></script>
<!-- Theme CSS -->  
<link id="theme-style" rel="stylesheet" href="../Files/assets/css/theme.css">
 <style type="text/css">
		body{
				background-image: url("../Files/image/2.jpeg");
				background-color: darkseagreen;
				background-repeat: no-repeat ;
				background-size: 50%  ;
				height: 100%;
			}
		.col-center-block{
				background-color: rgb(255,255,255,0.8);
				float: none;
				display: block;
				text-align: center;
				margin-left: auto;
				margin-right: auto;
				margin-top: 150px;
				margin-bottom: 150px;
				text-align: center;
				max-width: 50%;
				-moz-border-radius: 1em;
				-webkit-border-radius: 1em;
				border-radius:1em;
			}
		.message_info_main{
				display:inline-block;
				padding: 20px;
			}
		table,th,td{
				border:1px solid #28b76b;
		 }
		 .foot{
			 padding-top: 70px;
			 background-color: white;

		 }
		
        </style>
</head>
<body>
<!--头信息-->
<header class="header fixed-top">	    
	<div class="branding docs-branding">
		<div class="container-fluid position-relative py-2">
			<div class="docs-logo-wrapper">
				<div class="site-logo"><a class="navbar-brand" href="../login_register_page/index.html"><img class="logo-icon mr-2" src="../Files/assets/images/coderdocs-logo.svg" alt="logo"><span class="logo-text">计算机考研<span class="text-alt">真题资料共享网</span></span></a></div>    
			</div><!--//docs-logo-wrapper-->
			<div class="docs-top-utilities d-flex justify-content-end align-items-center">
				<ul class="social-list list-inline mx-md-3 mx-lg-5 mb-0 d-none d-lg-flex">
					<li class="list-inline-item"><a href="../login_register_page/index.html" title="首页"><i class="fa fa-home fa-fw"></i></a></li>
					<li class="list-inline-item"><a href="../person_histroy_page/person_center.html" title="个人中心"><i class="fa fa-user fa-fw"></i></a></li>
					<li class="list-inline-item">
						<a href="../login_register_page/login/admin_login.html" title="后台登录"><i class="fa fa-desktop fa-fw"></i></a>
					</li>
					<li class="list-inline-item"><a href="../login_register_page/register/register.html" title="注册"><i class="fa fa-registered fa-fw"></i></a></li>
				</ul><!--//social-list-->
				<a href="../login_register_page/login/login.html" class="btn btn-primary d-none d-lg-flex">登录</a>
			</div><!--//docs-top-utilities-->
		</div><!--//container-->
	</div><!--//branding-->
</header><!--//header-->


<!--提取资料框-->
<div class="container">
        <div class="row row-centered">
        	<div class="col-xs-6 col-md-5 col-center-block">
					<div class="message_info_main">
						<table>
								<tr>
								<td>网盘链接</td>
								<td>提取码</td》
								></tr>    
								<?php
								foreach ($arr as $key=>$value)
									 {
								?>
									  <tr>
											<td><?php echo $value['wp_links'];?></td>
											<td><?php echo $value['wp_code'];?></td>
									  </tr>

								<?php }?>
						   </table>	
					</div>
		</div>
	</div>
</div>
<div class="foot">
	<!--页脚-->
	<footer class="footer " >
		<div class="footer-bottom text-center py-5"  >
			<small class="copyright">
			Copyright 2021 邝秀花 版权所有 <br/>
			联系邮箱：1834643058@qq.com <br/>
			温馨提示：强烈谴责将本网站资料盗卖的行为。
		</small>
		</div>	
	</footer>
</div>
</body>
</html>



