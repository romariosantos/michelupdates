<?php 
	session_start();
if(isset($_SESSION['receitas_user_logado']) AND isset($_SESSION['receitas_user_id'])){
	include_once "../include/conexao.php";
	include_once "../include/funcoes.php";
	include_once "include/redimensionar_imagem.class.php";
	
	if($_GET['acao'] == "editarcook"){
	
		$editReceita = mysql_query("SELECT * FROM receita WHERE id='$_POST[id_receita]'");
			while($rowR = mysql_fetch_array($editReceita)){
				$idreceita			= $rowR['id'];
				$image 				= utf8_encode($rowR['image']);
				$postado_por_user 	= utf8_encode($rowR['postado_por_user']);	
			}
	
	
			if($postado_por_user == $_SESSION['receitas_user_id']){
				
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
				
					if($nomereceita == "" OR $categoria == "" OR $subcategoria == "" OR $ingrediente == "" OR $modopreparo == ""){
						header("Location: receitas_aguardando_aprovacao.php?mensagem=3");
						exit;
					}else{
						if(!empty($foto['name'])){
						
						
							if(!preg_match('/^image\/(jpeg|png|gif|bmp)$/', $foto['type'])){
								header("Location: receitas_aguardando_aprovacao.php?mensagem=6");
								exit;
							}else{
								if($foto["size"] > 1500243) {
									header("Location: receitas_aguardando_aprovacao.php?mensagem=5");
									exit;
								}else{		
									$imagem = $foto['name']; // Nome original da imagem
									$dir = "tmp_foto_receita"; 
									$salva = $dir."/".'tmp_'.$imagem; 
									move_uploaded_file($foto['tmp_name'],$salva ); 
									$info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
									$nova_imagem = $image; // Nome da imagem redimensionada
									$resizeObj = new resize($salva);
									$resizeObj -> resizeImage(800, 'crop');
									$resizeObj -> saveImage($dir."/".$nova_imagem, 90);							
									unlink($salva);
										getCurlNotTimeOut("http://www.receitinhasdavovo.com/webservice/recebe_imagem_receita.php?acao=".$nova_imagem);
									unlink($dir."/".$nova_imagem);
								}
							}
						}
					
					}
					
						
					mysql_query("UPDATE receita SET categoria = '$categoria',subcategoria='$subcategoria',nome='$nomereceita',descricao='$descricao',ingrediente='$ingrediente',modopreparo='$modopreparo',tempo_preparo='$tempo_preparo',rendimento='$rendimento' WHERE id='$idreceita'");
									header("location:receitas_aguardando_aprovacao.php?mensagem=2");
									exit;
				
			}
			
	}else{
	
	//echo "entrou";
	//exit;
	
		$editReceita = mysql_query("SELECT * FROM receita WHERE id='$_GET[id]'");
			while($rowR = mysql_fetch_array($editReceita)){
				$id 				= $rowR['id'];
				$categoria 			= utf8_encode($rowR['categoria']);
				$subcategoria 		= utf8_encode($rowR['subcategoria']);
				$nome 				= utf8_encode($rowR['nome']);
				$descricao			= utf8_encode($rowR['descricao']);
				$image 				= utf8_encode($rowR['image']);
				$ingrediente		= utf8_encode($rowR['ingrediente']);
				$modopreparo		= utf8_encode($rowR['modopreparo']);
				$tempo_preparo 		= utf8_encode($rowR['tempo_preparo']);
				$rendimento 		= utf8_encode($rowR['rendimento']);
				$postado_por_user 	= utf8_encode($rowR['postado_por_user']);	
			}
			
			if($postado_por_user != $_SESSION['receitas_user_id']){
				header("location:receitas_aguardando_aprovacao.php?mensagem=1");
				exit;
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

 
			<form action="?acao=editarcook" method="POST" enctype="multipart/form-data">
			<div class="title_er">Informações da Receita</div>

			<div class="pdd_form_er">
				<div class="row_inpt">
					<label>
						<div class="tt_inpt">Nome da receita</div>
						<input name="nome_receita" placeholder="Nome da receita" value="<?php echo $nome;?>" class="inp"/>
					</label>
				</div>
				
				<div class="row_inpt">
					<label>
						<div class="tt_inpt">Breve descrição:</div>
						<input name="descricao" placeholder="Breve descrição, exemplo: Essa receita é uma delicia!" value="<?php echo $descricao;?>" class="inp"/>
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
									if($row['id'] == $categoria){
										echo "<option value='".$row['id']."' selected='selected'>".utf8_encode($row['nome'])."</option>";
									}else{
										echo "<option value='".$row['id']."'>".utf8_encode($row['nome'])."</option>";
									}
									
								}
							?>
						</select>
					</label>
				</div>
				
				<div class="row_inpt">
					<label>
						<div class="tt_inpt">SubCategoria</div>
						<select name="subcategoria" id="subcategoria" class="sel">
							<?php 
								$sqlcat = mysql_query("SELECT * FROM subcategoria WHERE id_cat='$categoria' ORDER BY nome ASC") or die (mysql_error());
								while($rowc = mysql_fetch_array($sqlcat)){
							?>
							<option value="<?php echo $rowc['id'];?>" <?php if($subcategoria == $rowc['id']){echo 'selected="selected"';} ?> ><?php echo utf8_encode($rowc['nome']);?></option>
							
							<?php }?>
						</select>
					</label>
				</div>

				<div style="margin-bottom:20px;"><img src="http://www.receitinhasdavovo.com/images/receitas/<?php echo $image;?>" width="680px" height="500px"></div>
				
				<a class="alterarsenha">Alterar Imagem</a>
				<a class="cancelar" style="display:none;">Cancelar</a>
				
				<script type="text/javascript">
					$(function(){
						$('.alterarsenha').click(function(e){
							e.preventDefault();
							$( this ).slideUp();
							$('#anexImagem').show("show");
							$('.cancelar').show("show");
						}); 
						
						$('.cancelar').click(function(){
							$('.alterarsenha').show("slow");
							$('.cancelar').hide("slow");
							$('#anexImagem').hide("slow");
							
							 jQuery("input[name='foto']").val( '' );
						});

					});
				</script>
				
				<div class="row_inpt" id="anexImagem" style="display:none;">
					<label>
						<div class="tt_inpt">Foto da receita</div>
						<input name="foto" type="file" />
					</label>
				</div>

				<br/>

				<div class="row_inpt bg_br" style="margin-top:20px;">

					 <div class="bcl">
					 	<span>Tempo de preparo</span> <br/>
					 	<input name="tempo_preparo" class="inp_br" value="<?php echo $tempo_preparo;?>" /> minutos
					 </div>

					 <div class="bcl">
					 	<span>Rendimento</span> <br/>
					 	<input name="rendimento" class="inp_br" value="<?php echo $rendimento;?>" /> porções
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
					
					<textarea name="ingrediente" placeholder="" class="text_ar_er"><?php echo $ingrediente;?></textarea>
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
					
					<textarea name="modopreparo" placeholder="" class="text_ar_er"><?php echo $modopreparo;?></textarea>
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
			
			<input type="hidden" name="id_receita" value="<?php echo $id;?>">
			<input type="hidden" name="id_usuario" value="<?php echo $postado_por_user;?>">

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