<?php 
	session_start();
	include('../include/conexao.php');
 
	unset($_SESSION['receitas_user_logado']);
	unset($_SESSION['receitas_user_id']);	
	echo "<script type=\"text/javascript\">window.location.href='../index.php';</script>";
	session_destroy(); 
?>