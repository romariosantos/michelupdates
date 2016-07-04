<?php 
	session_start();
if(isset($_SESSION['receitas_user_logado']) AND isset($_SESSION['receitas_user_id'])){
	include_once "../include/conexao.php";
	include_once "../include/funcoes.php";
	include_once "include/redimensionar_imagem.class.php";
	

	if($_GET['acao'] == "sendreceita"){
		$nomereceita 		= utf8_decode($_POST['nome_receita']);
		$descricao	 		= utf8_decode($_POST['descricao']);
		$categoria 			= $_POST['categoria'];
		$subcategoria 		= $_POST['subcategoria'];
		$foto				= $_FILES['foto'];
		$tempo_preparo 		= utf8_decode($_POST['tempo_preparo']);	
		$rendimento 		= utf8_decode($_POST['rendimento']);	
		$ingrediente 		= utf8_decode($_POST['ingrediente']);	
		$modopreparo 		= utf8_decode($_POST['modopreparo']);
		
		//print_r($_POST);
		
			if($nomereceita == "" OR $categoria == "" OR $subcategoria == "" OR empty($foto) OR $ingrediente == "" OR $modopreparo == ""){
				header("Location: ?mensagem=1&nome_receita=".urlencode($nomereceita)."&descricao=".urlencode($descricao)."&modopreparo=".urlencode($modopreparo)."&ingrediente=".urlencode($ingrediente)."&tempo_preparo=".urlencode($tempo_preparo)."&rendimento=".urlencode($rendimento));
				exit;
			}else{
				if(!preg_match('/^image\/(jpeg|png|gif|bmp)$/', $foto['type'])){
					header("Location: ?mensagem=2&nome_receita=".urlencode($nomereceita)."&descricao=".urlencode($descricao)."&modopreparo=".urlencode($modopreparo)."&ingrediente=".urlencode($ingrediente)."&tempo_preparo=".urlencode($tempo_preparo)."&rendimento=".urlencode($rendimento));
					exit;
				}else{
				
					if($foto["size"] > 1500243) {
						header("Location: ?mensagem=3&nome_receita=".urlencode($nomereceita)."&descricao=".urlencode($descricao)."&modopreparo=".urlencode($modopreparo)."&ingrediente=".urlencode($ingrediente)."&tempo_preparo=".urlencode($tempo_preparo)."&rendimento=".urlencode($rendimento));
						exit;
					}else{
							$dataatual = date("Y-m-d-H-i-s");
							$novo = explode('.', $foto['name']);
							$novo = removeCaracteresAcentos($novo[0]);
							$novoNome = $dataatual."-".$novo;
							
							
							$imagem = $foto['name']; // Nome originai da imagem
							$dir = "tmp_foto_receita"; 
							$salva = $dir."/".$imagem; 
							move_uploaded_file($foto['tmp_name'],$salva ); 
							$info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
							$nova_imagem = $novoNome.".jpg"; // Nome da imagem redimensionada
							$resizeObj = new resize($salva);
							$resizeObj -> resizeImage(800, 'crop');
							$resizeObj -> saveImage($dir."/".$nova_imagem, 90);							
							unlink($salva);
								getCurlNotTimeOut("http://www.receitinhasdavovo.com/webservice/recebe_imagem_receita.php?site=livro&acao=".$nova_imagem);
							unlink($dir."/".$nova_imagem);
							
							mysql_query("INSERT INTO tb_receitas_recebidas (categoria,subcategoria,nome,descricao,image,ingrediente,modopreparo,tempo_preparo,rendimento,postado_por_user) VALUES ('$categoria','$subcategoria','$nomereceita','$descricao','$nova_imagem','$ingrediente', '$modopreparo','$tempo_preparo','$rendimento',$_SESSION[receitas_user_id])");
							header("location:receitas_aguardando_aprovacao.php?mensagem=4");
							
							
					
					}
				
				
				}
			}
	}
	include_once "../include/headerAdmin.php";
	
?>

<div class="geral">

		<div class="breadcrumb">
		
			<?php
				if($_GET['mensagem'] == 1){
					echo '<div class="cadastrado"><strong style="color:red;">Erro</strong> <br />Preencha todos os campos para enviar a receita!</div>';
				}elseif($_GET['mensagem'] == 2){
					echo '<div class="cadastrado"><strong style="color:red;">Erro</strong> <br />Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo</div>';
				}elseif($_GET['mensagem'] == 3){
					echo '<div class="cadastrado"><strong style="color:red;">Erro</strong> <br />Arquivo em tamanho muito grande! A imagem deve ser de no máximo 1 MB. Envie outro arquivo</div>';
				}elseif($_GET['mensagem'] == 4){
					echo '<div class="cadastrado"><strong>Receita enviada com sucesso</strong> <br />Sua Receita foi enviada com sucesso em breve estará no site caso for aprovada!</div>';
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
			
		<h1 class="titleg-rec italic">Enviar Receita</h1>
		
			
		
			
<?php
	include "include/left.php";
?>


		<div class="center_mlivro">
		
 			
			
		<div class="right_form_er">
			<div class="title_er">Enviar Receitas</div>

			<div class="pdd_form_er inf_er">
				<div class="tt_inf_er">Enviar receitas para o site é muito fácil, basta preencher o formulário corretamente e seguir algumas regras bem simples:</div>

				<li>> Informe um ingrediente / um passo do preparo por linha;</li>
				<li>> Seja detalhista no modo de preparo, afinal esta é a parte mais importante da receita;</li>
				<li>> Não copie receitas de outros sites ou livros publicados.</li>
				<li>> Imagem deve ter no máximo 1.5 MB.</li>
			</div>

 
			<form action="?acao=sendreceita" method="POST" enctype="multipart/form-data">
			<div class="title_er">Informações da Receita</div>

			<div class="pdd_form_er">
				<div class="row_inpt">
					<label>
						<div class="tt_inpt">Nome da receita</div>
						<input name="nome_receita" placeholder="Nome da receita" value="<?php echo $_GET['nome_receita'];?>" class="inp"/>
					</label>
				</div>
				
				<div class="row_inpt">
					<label>
						<div class="tt_inpt">Breve descrição:</div>
						<input name="descricao" placeholder="Breve descrição, exemplo: Essa receita é uma delicia!" value="<?php echo $_GET['descricao'];?>" class="inp"/>
					</label>
				</div>

				<div class="row_inpt">
					<label>
						<div class="tt_inpt">Categoria</div>
						<script type="text/javascript">
								$(function(){

									$('#categoria').change(function(){
									
										
										var target = 'subcategoria';
										var val = $(this).val();

										$.get('include/combobox.php',{ target:target,val:val }, function(result){ $('#subcategoria').html(result); });
										
									});
									
								});
							</script>
						<select name="categoria" id="categoria" class="sel">
							<option value="off">Selecione uma categoria</option>
							<?php
								$sql = mysql_query("SELECT * FROM categoria ORDER BY nome ASC");
								while($row = mysql_fetch_array($sql)){
									echo "<option value='".$row['id']."'>".utf8_encode($row['nome'])."</option>";
								}
							?>
						</select>
					</label>
				</div>
				
				<div class="row_inpt">
					<label>
						<div class="tt_inpt">SubCategoria</div>
						<select name="subcategoria" id="subcategoria" class="sel">	
						</select>
					</label>
				</div>

				<div class="row_inpt">
					<label>
						<div class="tt_inpt">Foto da receita</div>
						<input name="foto" type="file" />
					</label>
				</div>

				<br/>

				<div class="row_inpt bg_br">

					 <div class="bcl">
					 	<span>Tempo de preparo</span> <br/>
					 	<input name="tempo_preparo" class="inp_br" value="<?php echo $_GET['tempo_preparo'];?>" /> minutos
					 </div>

					 <div class="bcl">
					 	<span>Rendimento</span> <br/>
					 	<input name="rendimento" class="inp_br" value="<?php echo $_GET['rendimento'];?>" /> porções
					 </div>

					 

					 <div class="clear"></div>
				</div>

			</div>

			<div class="title_er">Ingredientes</div>

			<div class="pdd_form_er">

				<div class="row_inpt"> 
					<div class="tt_inpt tt_inptG">Ao listar os ingredientes:
						<li>Escreva um ingrediente por linha</li>
					</div> 
					
					<textarea name="ingrediente" placeholder="" class="text_ar_er"><?php echo $_GET['ingrediente'];?></textarea>
				</div>

				<div class="clear"></div>
			</div>


			<div class="title_er">Modo de Preparo</div>

			<div class="pdd_form_er">

				<div class="row_inpt"> 
					<div class="tt_inpt tt_inptG">Ao escrever o passo a passo:
						<li>Escreva um passo por linha</li>
						<li>Os passos serão posteriormente formatados pela nossa equipe.</li>
					</div> 
					
					<textarea name="modopreparo" placeholder="" class="text_ar_er"><?php echo $_GET['modopreparo'];?></textarea>
				</div>

				<div class="clear"></div>
			</div>


			<div class="title_er">Enviar a receita</div>

			<div class="pdd_form_er">
				<div class="bg_at_er">
					<strong>Antes de enviar:</strong> 

					<li>Revise sua receita para ter certeza que as quantidades estão corretas e todos os itens listados.</li>

					<li>Por favor, só envie fotos tiradas por você, fotos tiradas da internet não serão aceitas e você ainda corre o risco de ter seu cadastro removido do site.</li>
				</div>
			</div>

			<button class="btn_send">Enviar receita</button>

			</form>
		</div>

				
			</div>


		</div>

</div>	


<?php
	include_once "../include/footer.php";
}else{
	header("location:../livro/");
}
?>