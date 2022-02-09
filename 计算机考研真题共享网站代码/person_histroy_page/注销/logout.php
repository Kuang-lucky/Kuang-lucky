<?php
	if($_GET['action']=="logout"){
		session_start();
		setcookie("cookiename", NULL);
		session_unset();
		session_destroy();
		echo  "<script>alert('注销成功');</script>";
	}
?>