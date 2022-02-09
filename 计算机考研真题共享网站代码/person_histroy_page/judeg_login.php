<?php
	header("content-type:text/html;charset=utf-8");
		session_start();
		if(!isset($_SESSION['userid'])){
			echo "<script>alert('请先登录');location='../login_register_page/login/login.html'</script>";
		}
	else{
		echo "<script>location='person_center.html'</script>";
	}
?>