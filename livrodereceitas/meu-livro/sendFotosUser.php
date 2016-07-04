<?php
session_start();
if(isset($_SESSION['receitas_user_logado']) AND isset($_SESSION['receitas_user_id'])){
	include_once "../include/conexao.php";
	include_once "../include/headerAdmin.php";
	include_once "../include/funcoes.php";
	include_once "include/redimensionar_imagem.class.php";
	
		
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
				

			<form action="sendFotosUser.php" method="POST" enctype="multipart/form-data">
			<div class="title_er">Inserir mais Fotos</div>

			<div class="pdd_form_er">
				  
				<?php
					$fotos	= $_FILES['foto'];
					$qtd_arquivos = count($fotos["name"])-1;
					for($i = 0; $i <= $qtd_arquivos; $i++){	
					$l++;
							if(!preg_match('/^image\/(jpeg|png|gif|bmp)$/', $fotos['type'][$i])){
								echo "<p style='color:red; font-size:15px;'>Foto ".$l." formato inválido.</p>";
							}else{
								if($fotos["size"][$i] > 1500243) {
									echo "<p style='color:red; font-size:15px;'>Foto ".$l." é muito grande por favor envie uma foto menor que 1.5 mb</p>";
								}else{
									
										$dataatual = date("Y-m-d-H-i-s");
										$novo = explode('.', $fotos['name'][$i]);
										$novo = removeCaracteresAcentos($novo[0]);
										
										$imagem = $fotos['name'][$i]; // Nome originai da imagem
										$dir = "tmp_foto_receita"; 
										$salva = $dir."/".$imagem; 
										move_uploaded_file($fotos['tmp_name'][$i],$salva);
										$info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
										$nova_imagem = $dataatual."-".$novo.".jpg"; // Nome da imagem redimensionada
										$resizeObj = new resize($salva);
										$resizeObj -> resizeImage(800, 'crop');
										$resizeObj -> saveImage($dir."/".$nova_imagem, 90);	
										
										unlink($salva);
											getCurlNotTimeOut("http://www.receitinhasdavovo.com/webservice/recebe_imagem_adicional_receita.php?site=livro&acao=".$nova_imagem);
										unlink($dir."/".$nova_imagem);
										
										
									
										mysql_query("INSERT INTO tb_imagens_adicionais (id_receita,id_user,nome) VALUES ('$idReceita',$_SESSION[receitas_user_id],'$nova_imagem')");
										echo "<p style='color:green; font-size:15px;'>Foto ".$l." foi enviada com sucesso, aguarde a aprovação!</p><br />";
										echo "<img src='http://www.receitinhasdavovo.com/images/receitas_imagens_adicionais/".$nova_imagem."'><br /><br />";
								}
							}
					
					}
				?>
 
			</div>
 

			<div class="pdd_form_er">
				<div class="bg_at_er">
					<strong>Informações</strong> 
					
					<li>Aguarde a aprovação das fotos</li>

					<li>Você está inserindo mais fotos em uma receita já criada</li>

					<li>Envie fotos reais</li>
				</div>
			</div>

			</form>
		</div>

</div>	


<?php
	include_once "../include/footer.php";
}else{
	header("location:../livro/");
}
?>