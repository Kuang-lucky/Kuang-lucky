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
				background-color: rgb(250,250,250,0.8);
				float: none;
				display: block;
				margin-left: auto;
				margin-right: auto;
				margin-top: 20px;
				text-align: center;
				width: 400px;
				height: 450px;
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
                <h2 class="textcolor">添加用户</h2>
                <form method="post" action="doadd.php" onsubmit="return checkForm(this)">
					<!-- 输入账号 -->
                    <div class="edit input-group input-group-md ">
						<span class="input-group-addon" style="color:#28b76b ">
							帐&nbsp;&nbsp;&nbsp;&nbsp;号：
						</span>
                        <input type="text" class="form-control"  name='userid' id='userid' placehold="请输入手机号码" maxlength="11"/>
                    </div>
					<!-- 输入密码 -->
                    <div class="edit input-group input-group-md ">
						<span class="input-group-addon" style="color:#28b76b ">
							密&nbsp;&nbsp;&nbsp;&nbsp;码：
						</span>
                        <input type="text" class="form-control"  name='userpsw' id='userpsw' placehold="请输入密码" maxlength="12" />
                    </div>
					<!-- 输入用户名 -->
                    <div class="edit input-group input-group-md ">
						<span class="input-group-addon" style="color:#28b76b ">
							用户名：
						</span>
                        <input type="text" class="form-control" type="text" name='username' id='username'  placehold="请输入用户名" />
                    </div>
					
                    <!-- 输入性别 -->
                    <div class="edit input-group input-group-md input_bk">
						<span class="input-group-addon"   style="color:#28b76b ">
								性&nbsp;&nbsp;&nbsp;&nbsp;别：
						</span>
						<input type="text" class="form-control" name='sex' id='sex' placehold="请输入性别" maxlength="2"/>
 
                    </div>
					<!-- 修改邮箱 -->
                    <div class="edit input-group input-group-md input_bk">
						<span class="input-group-addon"  style="color:#28b76b ">
							邮&nbsp;&nbsp;&nbsp;&nbsp;箱：
						</span>
                    <input type="text" class="form-control" type="text" name='E_mail'  id='E_mail' placehold="请输入邮箱"/>
					</div>
					<br/>
                    <button  type="submit" class="info btn btn-success btn-block" name="submit" value="普通用户">添加为普通用户</button>
					<button  type="submit" class="info btn btn-success btn-block" name="submit" value="管理员">添加为管理员</button>
                </form>
            </div>
        </div>
    </div>
</body>
	<script>	 
	function checkForm(){
		var phone = document.getElementById('userid').value;
		var username = document.getElementById('username').value;
		var userpsw= document.getElementById('userpsw').value;
		if(phone=="" || username=="" ||  userpsw=="" ){
			alert("账号、密码、用户名不能为空！");return false;
		}
		else{
			if(!(/^1(3|4|5|7|8|9)\d{9}$/.test(phone))){
					alert("手机号码有误，请重新输入");
					return false;
			}
		}
		
}
</script>
</html>