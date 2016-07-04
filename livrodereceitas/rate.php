<?php
session_start();
include "include/conexao.php";

$rate = explode('#',$_POST['rating']);
$r = $rate[1];

$id_receita = $_POST['id_rec'];
$id_user    = $_SESSION['receitas_user_id'];


if($id_receita != ""){
	$cont = mysql_query("SELECT * FROM pontuacao WHERE id_receita = '$id_receita' AND id_user = '$id_user'");
	$contagemVotacao = mysql_num_rows($cont);

	if($contagemVotacao == 0){
		if($id_user != 0){
			$inst = mysql_query("INSERT INTO pontuacao (id_receita,id_user,pontos) VALUES ('$id_receita','$id_user','$r')");
		}else{
			echo utf8_decode("<p><br>Para votar precisa estar cadastrado, Faça um cadastro
			<a href='#' class='tcad j_click' data-click='cadastro' data-root='/' > Cadastre-se agora</a> ou <a href='/livro/'>Faça o login</a></p>");
		}
	}elseif($contagemVotacao == 1){
		$inst = mysql_query("UPDATE pontuacao SET pontos='$r' WHERE id_receita='$id_receita' AND id_user='$id_user'");
	}else{
		echo "<p>Sua votação para essa receita ja foi computada</p>";
	}
}else{
	echo "Nenhuma receita selecionada";
}
//$db = mysql_query("SELECT * FROM pontuacao");

//var_dump( mysql_fetch_row($db) ); //show

/*
$SQL = "UPDATE pontuacao 
			SET pontos = pontos + ".$r." 
		  WHERE id_receita = '$id_receita'";
*/
	
?>