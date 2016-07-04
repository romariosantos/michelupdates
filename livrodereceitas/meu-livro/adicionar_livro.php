<?php
session_start();
if(isset($_SESSION['receitas_user_logado']) AND isset($_SESSION['receitas_user_id'])){

	include_once "../include/conexao.php";
	include_once "../include/funcoes.php";

	$idUsuario = $_SESSION['receitas_user_id'];
	$idReceita = removeInjection($_GET['id']);			

	$verificaSql = mysql_query("SELECT * FROM tb_meulivro WHERE usuario='$idUsuario' AND idreceita='$idReceita'");
	$contagemMeuLivro = mysql_num_rows($verificaSql);
	
	if($contagemMeuLivro < 1){
	
			$inserirMeuLivro = mysql_query("INSERT INTO tb_meulivro (usuario, idreceita) VALUES ('$idUsuario','$idReceita')");
			
			if($inserirMeuLivro){
				header("location:home.php?acao=adicionadalivro");
			}else{
				header("location:home.php?acao=erroalivro");
			}
	}else{
		header("location:resultado_busca.php?acao=receitaexiste&s=".$_GET['s']);
	}
	
}else{
	header("location:../livro/");
}
?>
