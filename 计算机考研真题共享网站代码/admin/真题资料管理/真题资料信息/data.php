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
		  $pagesize=9; //每页显示数
		  $start_row;//定义每页的首条数据在查询中的起始位置
		  $pages;//总页数
		  $page;//当前页

		//构建查询语句获取总记录数和计算总页数
		  $sql="select * from wp_link order by id desc";
		  $result=$conn->query($sql);	
		  $records=mysqli_num_rows($result);
		  $page=isset($_GET['page'])?$_GET['page']:1;
		  $start_row=($page-1)*$pagesize;
		  $pages=ceil($records/$pagesize);
		  $sql="select * from wp_link order by id asc limit {$start_row},{$pagesize}";
		  $result=$conn->query($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>真题资料信息</title>

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
	
	table{	
			margin-left: auto;
			margin-right: auto;
			border-spacing: 0;/*去掉单元格间隙*/
			text-align: center;
			color: #5f6268;
		
	}
	table td {
		border-bottom: 1px solid rgba(200,198,198,1.00);
		padding: 10px;
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
				<td>序号</td>
				<td>学校名称</td>
				<td>网盘链接</td>
				<td>提取码</td>
				<td>修改</td>
				<td>删除</td>
			</tr>
				<?php
					while($row = mysqli_fetch_array($result))
					{	echo "<tr>";
					 	echo "<td>".$row['id']."</td>";
						echo "<td>".$row['college']."</td>";
						echo "<td>".$row['wp_links']."</td>";
						echo "<td>".$row['wp_code']."</td>"; 
					 	$id=$row['id'];
						echo "<td><button><a href=update.php?id=$id style=color:#28b76b>修改</a></button></td>";
					 	echo "<td><button><a href=delete.php?id=$id style=color:#28b76b>删除</a></button></td>";
					 	echo "<tr>";
					 	
					}
				?>
				<?php  
               echo "<tr align='center'>";
               echo "<td colspan='16'>";

              //以下处理网页10页以上的情况
               if($pages>9)
               {
 		          //如果是当前页是第一页
               if($page==1)
               {
                //当前页是第1页的话，“上一页”不可用
                echo "<span><a style='disabled'>上一页</span>";
                $start=1;
                $next=$page+1;
                $end=$start+3;
                for($i=$start;$i<=$end;$i++)
                { 
                  if($i==1) //当前页显示为无链接标记
                  {echo "<span>$i</span>";}
                  else{
                  echo "<a href=?page=$i>$i</a>";}
                }
                echo "<span>...</span>";
                echo "<a href=?page=$pages>$pages</a>";
                echo "<a href=?page=$next>下一页</a>";
               }
 
               //如果当前页不是第1页且页码小于5
               if($page!=1&&$page<4)
               {
                $start=1;
                $next=$page+1;
                $end=4;  
                $forward=$page-1;
                echo "<a href=?page=$forward>上一页</a>";
                for($i=$start;$i<=$end;$i++)
                  {
                    //如果是当前页为无链接标记
                    if($page==$i) {echo "<span>$i</span>";}
                    else
                      {echo "<a href=?page=$i>$i</a>";}
                  }
                echo "<span>...</span>";
                echo "<a href=?page=$pages>$pages</a>";
                echo "<a href=?page=$next>下一页</a>"; 
               }
               //如果当前页大于4且小于总页数-某个数(中间页码的考虑)
               if($page>=4&&$page<$pages-2)
               {
                $start=$page-1;
                $end=$page+1;
                $forward=$page-1;
                $next=$page+1;
                echo "<a href=?page=$forward>上一页</a>";
                echo "<a href=?page=1>1</a>";
                echo "<span>...</span>";
                for($i=$start;$i<=$end;$i++)
                  {
                    //如果是当前页为无链接标记
                    if($page==$i) {echo "<span>$i</span>";}
                    else
                      {echo "<a href=?page=$i>$i</a>";}
                  }
                echo "<span>...</span>";
                echo "<a href=?page=$pages>$pages</a>";
                echo "<a href=?page=$next>下一页</a>"; 
               }
              //当前页不是最后一页且为最后四页
              if($page!=$pages&&$page>=$pages-2)
               {
                 $start=$pages-3;//倒数第4页为前节点，注意哦
                 $forward=$page-1;
                 $next=$page+1;
                 $end=$pages;  
                
                echo "<a href=?page=$forward>上一页</a>";
                echo "<a href=?page=1>1</a>";
                echo "<span>...</span>";
                for($i=$start;$i<=$end;$i++)
                  {
                    //如果是当前页为无链接标记
                    if($page==$i) {echo "<span>$i</span>";}
                    else
                      {echo "<a href=?page=$i>$i</a>";}
                  }
                echo "<a href=?page=$next>下一页</a>"; 
               }
              //当前页是最后一页
               if($page==$pages)
               {
                $forward=$page-1;
                echo "<a href=?page=$forward>上一页</a>";
                echo "<a href=?page=1>1</a>";
                echo "<span>...</span>";
                $start=$page-3;
                $end=$page;
                for($i=$start;$i<=$end;$i++)
                { 
                  if($i==$page) //当前页显示为无链接标记
                  {echo "<span>$i</span>";}
                  else{
                  echo "<a href=?page=$i>$i</a>";}
                }
                //当前页是最后一页的话，“下一页”不可用
                echo "<span><a style='disabled'>下一页</span>";
               }
             }
               echo "</td>";
               echo "</tr>";
 		  ?>
		</div>	
</body>
</html>
