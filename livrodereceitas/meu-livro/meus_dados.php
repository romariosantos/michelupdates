<?php
session_start();
if(isset($_SESSION['receitas_user_logado']) AND isset($_SESSION['receitas_user_id'])){
	include_once "../include/conexao.php";
	include_once "../include/funcoes.php";
	include_once "include/redimensionar_imagem.class.php";
	
	
	if($_GET['acao'] == "alterar"){
		$nome 					=  $_POST['nome'];
		$email 					=  $_POST['email'];
		$senha 					=  $_POST['senha'];
		$miniatura				=  $_POST['miniatura'];
		$novasenha 				=  md5($_POST['novasenha']);
		$confirmarnovasenha 	=  md5($_POST['confirmarnovasenha']);
		$foto 					=  $_FILES['foto'];
		
		
		if($_POST['novasenha'] == "" AND $_POST['confirmarnovasenha'] == "" AND $senha == ""){
		
			if(!empty($foto)){
				if(!preg_match('/^image\/(jpeg|png|gif|bmp)$/', $foto['type'])){
					header("location:?mensagem=4");
					exit;
				}else{
					if($foto["size"] > 1000243) {
						header("location:?mensagem=5");
						exit;
					}else{
							
							$imagem = $foto['name']; // Nome originai da imagem
							$dir = "tmp_avatar"; 
							$salva = $dir."/".$imagem; 
							move_uploaded_file($foto['tmp_name'],$salva ); 
							$info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
							$nova_imagem = $_SESSION['receitas_user_id']."_avatar".".jpg"; // Nome da imagem redimensionada
							$resizeObj = new resize($salva);
							$resizeObj -> resizeImage(50, 50, 'crop');
							$resizeObj -> saveImage($dir."/".$nova_imagem, 100);
							unlink($salva);
								getCurlNotTimeOut("http://www.receitinhasdavovo.com/webservice/avatar.php?site=livro&acao=".$nova_imagem);
							unlink($dir."/".$nova_imagem);
							
							mysql_query("UPDATE tb_usuario SET nome='$nome', miniatura='$nova_imagem' WHERE id=$_SESSION[receitas_user_id]");
							header("location:?mensagem=1");
					}
				}
			}else{
				mysql_query("UPDATE tb_usuario SET nome='$nome' WHERE id=$_SESSION[receitas_user_id]");
				header("location:?mensagem=1");
			}
			
		}elseif($novasenha != "" AND $confirmarnovasenha != "" AND $senha != ""){
				$senhaconferida = md5($senha);
				
					$selecionaProfile = mysql_query("SELECT * FROM tb_usuario WHERE id='$_SESSION[receitas_user_id]'");
					while($rowProfile = mysql_fetch_array($selecionaProfile)){
							$senhabanco	= $rowProfile['senha'];
					}
					
					if($senhaconferida == $senhabanco){ //verifica se a senha digitada é igual a do banco se for... true
						if($novasenha == $confirmarnovasenha){
							mysql_query("UPDATE tb_usuario SET nome='$nome', senha='$novasenha' WHERE id=$_SESSION[receitas_user_id]");
							header("location:?mensagem=1");
							exit;
						}else{
							header("location:?mensagem=3");
							exit;
						}
					}else{
						header("location:?mensagem=2");
						exit;
					}
			
			
		}
			

		
	}
	
	include_once "../include/headerAdmin.php";
	include_once "../include/funcoes.php";
	
	$selecionaProfile = mysql_query("SELECT * FROM tb_usuario WHERE id='$_SESSION[receitas_user_id]'");
	while($rowProfile = mysql_fetch_array($selecionaProfile)){
			$id 		= $rowProfile['id'];
			$nome 		= $rowProfile['nome'];
			$email 		= $rowProfile['email'];
			$miniatura 	= $rowProfile['miniatura'];
			$verificado = $rowProfile['verificado'];
	}
?>

<div class="geral">

		<div class="breadcrumb">
		
			<?php
				if($_GET['mensagem'] == 1){
					echo '<div class="cadastrado"><strong>'.$nomeUsuario.'</strong> <br />Dados alterados com sucesso</div>';
				}elseif($_GET['mensagem'] == 2){
					echo '<div class="cadastrado"><strong style="color:red;">Erro</strong> <br />Senha não confere com a do banco de dados</div>';
				}elseif($_GET['mensagem'] == 3){
					echo '<div class="cadastrado"><strong style="color:red;">Erro</strong> <br />As senhas digitadas não são iguais, por favor digite a mesma!</div>';
				}elseif($_GET['mensagem'] == 4){
					echo '<div class="cadastrado"><strong style="color:red;">Erro</strong> <br />Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo</div>';
				}elseif($_GET['mensagem'] == 5){
					echo '<div class="cadastrado"><strong style="color:red;">Erro</strong> <br />Arquivo em tamanho muito grande! A imagem deve ser de no máximo 1 MB. Envie outro arquivo</div>';
				}
			?>
		
		<div class="clear"></div>
		
			<span class="bread">
				<a href="<?php echo ROOT .'/../';?>">Livro de Receita</a>
				>
			</span>
			
			<span class="bread">
				<a href="<?php echo ROOT .'/home.php';?>">Meu livro de receitas</a> 
				>
			</span>
			
			<span class="bread">
				<a href="<?php echo ROOT .'/meus_dados.php';?>">Meus Dados</a> 
			</span>
		 
		</div>
			
		<h1 class="titleg-rec italic">Meus Dados</h1>
		
			
		
			
<?php
	include "include/left.php";
?>



		<div class="right_form_er">
		
			
			  
			<form action="?acao=alterar" method="POST" enctype="multipart/form-data">
			<div class="title_er">Meus dados</div>
			
			

			<div class="pdd_form_er">
			
			
				<div class="row_inpt">
					<label>
						<div class="tt_inpt">Nome</div>
						<input type="text" name="nome" placeholder="Nome" value="<?php echo $nome; ?>" class="inp"/>
					</label>
				</div>
				
				

				<div class="row_inpt">
					<label>
						<div class="tt_inpt">E-mail</div>
						<input type="text" name="email" placeholder="exemplo@email.com" value="<?php echo $email; ?>" class="inp" READONLY/>
					</label>
				</div>
				
				
			
				
					<a href="#" class="alterarsenha">Alterar Senha</a>
					<a href="#" class="cancelar" style="display:none;">Cancelar</a>
				
				
				
				

				<div id="ShowHide" style="display:none;">
					<div class="row_inpt">
						<label>
							<div class="tt_inpt">Senha Atual:</div>
							<input type="password" name="senha" placeholder="Digite aqui para alterar" class="inp"/>
						</label>
					</div>
					
					<div class="row_inpt">
						<label>
							<div class="tt_inpt">Nova Senha:</div>
							<input type="password" name="novasenha" placeholder="Digite aqui para alterar" class="inp"/>
						</label>
					</div>
					
					<div class="row_inpt">
						<label>
							<div class="tt_inpt">Confirmar nova senha:</div>
							<input type="password" name="confirmarnovasenha" placeholder="Digite aqui para alterar" class="inp"/>
						</label>
					</div>
				</div>
				 
				<div style="clear:both; margin-top:10px;"></div>

				<div class="row_inpt" style="margin-left:50px;">
					
					<label>
						<?php
							if($miniatura != NULL){
								echo '<img src="http://www.receitinhasdavovo.com/images/avatar/'.$miniatura.'" style="width:50px;"/>';
							}else{
						?>
							<img src="img/thumb.jpg" alt="" />
						<?php
						}
						?>
						
						<div class="tt_inpt">Foto do perfil:</div><br>
						<div class="clear"></div>
						<input name="foto" type="file" />
					</label>
					
					
				</div>

				 
			</div>

			 
			 

			<div class="pdd_form_er">
				<div class="bg_at_er">
					<strong>Informações</strong> 

					<li>Não é possivel alterar o e-mail.</li>
					
					<li>Preencha todas informações corretamente.</li>

					<li>Não é obrigado a alterar a senha, apenas se quiser!</li>
				</div>
			</div>

			<button class="btn_send">Salvar alterações</button>

			</form>
		</div>


	</div>

</div>	

 
 
	<script type="text/javascript">
		$(function(){
			$('.alterarsenha').click(function(e){
				e.preventDefault();
				$( this ).slideUp();
				$('#ShowHide').show("show");
				$('.cancelar').show("show");
			}); 
			
			$('.cancelar').click(function(){
				$('.alterarsenha').show("slow");
				$('.cancelar').hide("slow");
				$('#ShowHide').hide("slow");
				
				 jQuery("input[name='senha']").val( '' );
				 jQuery("input[name='novasenha']").val( '' );
				 jQuery("input[name='confirmarnovasenha']").val( '' );
			});

		});
	</script>

<?php
	include_once "../include/footer.php";
}else{
	header("location:../livro/");
}
?>