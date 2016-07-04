<?php
session_start();
if(isset($_SESSION['receitas_user_logado']) AND isset($_SESSION['receitas_user_id'])){
	include_once "../include/conexao.php";
	include_once "../include/headerAdmin.php";
	include_once "../include/funcoes.php";
	
		
	mysql_query("SET NAMES 'utf8'");
	$sqlListaReceita = mysql_query("SELECT * FROM receita WHERE id='$_GET[id]'");
	while($rowbusca = mysql_fetch_array($sqlListaReceita)){
		$idReceita 		= $rowbusca['id'];
		$nomeReceita 	= $rowbusca['nome'];
		$imageReceita 	= $rowbusca['image'];
	}
?>

<div class="geral">

		<div class="breadcrumb">
		
			<?php
				if($_GET['cadastrado'] == 1){
					echo '<div class="cadastrado"><strong>'.$nomeUsuario.'</strong> <br />Cadastrado com sucesso, basta validar seu registro em seu email para ter acesso a todas a funções do site!</div>';
				}
			?>
		
		<div class="clear"></div>
		
			<span class="bread">
				<a href="<?php echo ROOT .'/../';?>">Livro de Receita</a>
				>
			</span>
			
			<span class="bread">
				<a href="<?php echo ROOT .'/home.php';?>">Meu livro de receitas</a> 
			</span>
		 
		</div>
			
		<h1 class="titleg-rec italic">Enviar Mais Fotos: <?php //echo removeInjection($_GET['s']); ?></h1>
		
			
		
			
<?php
	include "include/left.php";
?>


		
		<div class="right_form_er">
			<div class="center_search">
				<div class="title_tdr">Encontrar receitas</div>
				<form action="resultado_busca.php" method="GET">
					<div class="search_rec">
						<input type="text" name="s" placeholder="Buscar receita" class="inp"/>
						<button type="submit" class="btn_s">Buscar</button>
					</div>
				</form>
			</div>

			<div class="title_er">Receita: </div>
			<div class="tt_add_ft" style="margin:20px 0 0 20px;"><?php echo $nomeReceita; ?></div>
			

			<div class="pdd_form_er">
			 	<div class="add_ft">
			 		<img src="http://www.receitinhasdavovo.com/images/receitas/<?php echo $imageReceita; ?>" alt="">
			 	</div>

			 	

			 	<!--<a href="#" class="v_rec_add_ft"><img src="img/icon_href.png" alt=""> VER RECEITA</a>-->

			 	<div class="clear"></div>
			</div>
				

			<form action="sendFotosUser.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
			<div class="title_er">Inserir mais Fotos</div>

			<div class="pdd_form_er">
				  
				<div class="row_inpt">
					<label>
						<div class="tt_inpt">Foto 1</div>
						<input name="foto[]" type="file" />
					</label>
				</div>
				
				<div class="appd_file"></div>

				<div class="row_inpt">
				 <div style="text-align:center; cursor:pointer; font-size:14px; font-weight:bold;" class="add_morefiles">ADICIONAR MAIS CAMPOS</div>
				</div>


				<script type="text/javascript">
					$(function(){
					
					var i = 2; 
						
							$('.add_morefiles').click(function( ){
								if(i > 2){
									$( ".add_morefiles" ).hide();
								}

								$('.appd_file').append('<div class="row_inpt"><label><div class="tt_inpt">Foto '+i+'</div><input name="foto[]" type="file" /></label></div>');
								i += 1;
							});
							
							
						
					});
				</script>
 
			</div>
 

			<div class="pdd_form_er">
				<div class="bg_at_er">
					<strong>Informações</strong> 

					<li>Você está inserindo mais fotos em uma receita já criada</li>

					<li>Envie fotos reais</li>
				</div>
			</div>

			<button class="btn_send">Inserir fotos</button>

			</form>
		</div>

</div>	


<?php
	include_once "../include/footer.php";
}else{
	header("location:../livro/");
}
?>