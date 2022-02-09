<?php
		header("content-type:text/html;charset=utf-8");
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
		 //定义分页可能需要的参数
		 $pagesize=6;//每页显示数
		 $start_row;//定义每页的首条数据在查询中的起始位置
		 $pages;//总页数
	     $page;//当前页
 
	  	//构建查询语句获取总记录数和计算总页数
		  $sql="select * from php_admin order by adminid desc";
		  $result=$conn->query($sql);	
		  $records=mysqli_num_rows($result);

		  $page=isset($_GET['page'])?$_GET['page']:1;
		  $start_row=($page-1)*$pagesize;
		  $pages=ceil($records/$pagesize);
		  $sql="select * from php_admin order by adminid asc limit {$start_row},{$pagesize}";
		  $result=$conn->query($sql);
		//构造SQL查询语句
		$sql="select * from php_admin";
		//执行sql语句
		$result=$conn->query($sql);	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理员信息</title>

</head>
<style type="text/css">
	body{	
			height: 100%;
		}
	.user_info{
				margin-left: auto;
				margin-right: auto;
				-moz-border-radius: 1em;
				-webkit-border-radius: 1em;
				border-radius:1em;
				
			} 
	.h2_info{
		padding-top: 10px;
		color: #5f6268;
		text-align: center;
	}
	table{	
			margin-left: auto;
			margin-right: auto;
			border-spacing: 0;/*去掉单元格间隙*/
			text-align: center;
			color: #5f6268;
		
	}
	table td {
		border-bottom: 1px solid rgba(200,198,198,1.00);
		padding: 10px 20px;
		}
	a{
		TEXT-DECORATION:none ;
	}
	tr>td>a:link,tr>td>a:visited{
      	padding:10px;
        color:#28b76b;
        text-decoration:none;
      }
     td>span{
     	color:black;
     }
     span>a{
      color:silver;
     }
</style>
<body>
<div class="user_info">
	<table >
			<tr>
				<td>账号</td>
				<td>密码</td>
				<td>用户名</td>
				<td>性别</td>
				<td>邮箱</td>
				<td>修改</td>
				<td>删除</td>
			</tr>
				<?php
					while($row = mysqli_fetch_array($result))
					{	echo "<tr>";
					 	echo "<td>".$row['adminid']."</td>";
					 	echo "<td>".$row['adminpsw']."</td>";
						echo "<td>".$row['adminname']."</td>";
						echo "<td>".$row['sex']."</td>";
						echo "<td>".$row['E_mail']."</td>"; 
					 	$id=$row['adminid'];
						echo "<td><button><a href=update.php?adminid=$id style=color:#28b76b>修改</a></button></td>";
					 	echo "<td><button><a href=delete.php?adminid=$id style=color:#28b76b>删除</a></button></td>";
					 	echo "<tr>";
					 	
					}
				?>
				<?php 
					echo "<tr align='center'>";
               		echo "<td colspan='8'>";
					if($pages<=9)  
					   {  
						  $start=1;
						  $next=$page+1;
						  $forward=$page-1;
						  $end=$pages;
							//当前页是第1页的话，“上一页”不可用
						  if($page==1)
						  {
							  echo "<span><a style='disabled'>上一页</span>";
							  for($i=1;$i<=$pages;$i++)
								{
								  if($i==$page) //当前页显示为无链接标记
									{echo "<span>$i</span>";}
								  else
									{echo "<a href=?page=$i>$i</a>";}//正常显示其他页面的链接
								}
							  echo "<a href=?page=$next>下一页</a>";
						  }
						  //当前页是最终页的话，“下一页”不可用
						  elseif($page==$pages)
						   {
							  $forward=$page-1;
							  echo "<a href=?page=$forward>上一页</a>";
							  for($i=1;$i<=$pages;$i++)
								{
								  if($i==$page) //当前页显示为无链接标记
									 {echo "<span>$i</span>";}
								  else
									 {echo "<a href=?page=$i>$i</a>";}
								}
							  echo "<span><a style='disabled'>下一页</span>";
								 //当前页是最后一页的话，“下一页”不可用
							}
						  else
						  	{
							   echo "<a href=?page=$forward>上一页</a>";
							   for($i=1;$i<=$pages;$i++)
								{
								   if($i==$page) //当前页显示为无链接标记
									 	{echo "<span>$i</span>";}
								   else
									 	{echo "<a href=?page=$i>$i</a>";}
								 }
							   echo "<a href=?page=$next>下一页</a>";
							}
						}
				?>
		</div>	
</body>
</html>
