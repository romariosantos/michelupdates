<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
if(isset($_SESSION['receitas_user_logado']) AND isset($_SESSION['receitas_user_id'])){
	include_once "../include/conexao.php";
	include_once "../include/funcoes.php";
	
	$id = (int) $_GET['id'];
	$sqlReceita = mysql_query("SELECT * FROM receita WHERE id='$id'");
		while($rows = mysql_fetch_array($sqlReceita)){
			$nome 			= $rows['nome'];
			$categoria 		= $rows['categoria'];
			$subcategoria 	= $rows['subcategoria'];
			$descricao 		= $rows['descricao'];
			$image	 		= $rows['image'];
			$ingredientes 	= $rows['ingrediente'];
			$modopreparo 	= $rows['modopreparo'];
			$postado_por_user = $rows['postado_por_user'];
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Livro de Receita</title>

	<link rel="stylesheet" type="text/css" href="css/estilo-int.css" /> 
	<style type="text/css">
		body{
			background: #f4f0e6;
		}
	</style>
</head>
<body>
	
	<div class="content_imp">
		<div class="barra_print">
			<span>Imprimir Receita</span>
			<button class="print_rec">Imprimir</button>
			<div class="clear"></div>
		</div>

		<div class="print">
			<div class="header">
				<div class="logo"><img src="../img/logo.png"></div>
			</div>

			<div class="inf_rec">
				<img src="http://www.receitinhasdavovo.com/images/receitas/<?php echo utf8_encode($image); ?>" style="width:320px; height:220px;">
				<div class="title_imp_rec"><?php echo utf8_encode($nome); ?></div>
				
				<?php
					$sqlUser = mysql_query("SELECT * FROM tb_usuario WHERE id='$postado_por_user'");
					while($rows = mysql_fetch_array($sqlUser)){
						$nomeuser 			= $rows['nome'];
					}
					
					if($nomeuser != ""){
				?>
					<br /><strong>Receita enviada por:</strong> <?php echo $nomeuser;?>
				<?php
				}
				?>
				<div class="clear"></div>
			</div>

			<ul class="ing">
				<strong>Ingredientes</strong><br />
				<?php echo utf8_encode(nl2br(strip_tags($ingredientes))); ?>
			</ul>

	<?php
		if(!isset($_GET['lista'])){
	?>
			<ul class="mod_prep">
				<strong>Modo de Preparo</strong><br />
				
				<?php echo utf8_encode(nl2br(strip_tags($modopreparo))); ?>
			</ul>

			<div class="clear"></div>
<?php
$categoriaReceita = mysql_query("SELECT * FROM categoria WHERE id = '$categoria'") or die(mysql_error());
					while($rowCat = mysql_fetch_array($categoriaReceita)){
						$nomeCategoria = $rowCat['nome'];
					}

		}
?>
			
			<div class="footer_imp">
				<div class="clear"></div>Esta receita está disponível na página <br/>
				 <a href="http://www.livrodereceita.com/receitas/<?php echo remAcentos(utf8_encode($nomeCategoria)).'/'.remAcentos(utf8_encode($nome)).'-'.$id.'.html'; ?>">http://www.livrodereceita.com/receitas/<?php echo remAcentos(utf8_encode($nomeCategoria)).'/'.remAcentos($nome).'-'.$id.'.html'; ?></a>
			</div>

		</div>



	</div>
	 
	<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script> 
	<script type="text/javascript">
		$(function() {
	      $('.print_rec').click(function(){
	        window.print();
	        return false;
	      });
	    });
	</script> 
</body>
</html>

<?php
}else{
	header("location:../livro/");
}
?>