<?php 
	if($_GET['acao'] == 'logar'){
		include('include/conexao.php');
		include('include/funcoes.php');
		include_once('class/Logar.class.php');
		
		$email = removeInjection($_POST['email']);
		$senha = removeInjection($_POST['senha']);
 
		if(Logar::login($email, $senha)){
			echo '<script>window.location.href="meu-livro/home.php";</script>';
		}else{
			echo '<script>window.location.href="livro/?logar=erro";</script>';
		}
		 
		exit;
	}

	include_once('include/header.php');
?>
 
	<div class="geral">
   
		 <div class="breadcrumb">
			<span class="bread">
				<h2>O MEU LIVRO DE RECEITAS</h2>
			</span>
		</div>
		
		
		<div class="line">
			<div class="set-down"></div>
		</div>
		
		
		<?php
						if(empty($_GET['acao'])){
					?>
					<div class="clear"></div>

					<div class="box_login">
					
						<?php
							if($_GET['logar'] == "erro"){
								echo "<div class='cadastrado' style='background-color:#f3932d;'><strong>Erro ao se logar, por favor preencha o login e senha corretamente!</strong></div>";
							}
						?>

						<form action="../livro.php?acao=logar" method="post">
							<strong style="font-size:16px;">Email:</strong> <br />
							<input type="text" name="email" size="30" class="ipt_log" /> <br /><br />
							
							<strong style="font-size:16px;">Senha:</strong> <br />
							<input type="password" name="senha" size="30" class="ipt_log"/> <br /> <br />
							
							<button class="pure-button" />ACESSAR</button> 
							<br /><br />
							<a href="?acao=recuperar" class="esq_senha">Esqueci a senha</a>
						</form>
					</div>	
						 
					<?php
					}elseif($_GET['acao'] == "recuperar"){
					?>

					<div class="box_login">
						<form action="?acao=recuperada" method="post">
							<strong style="font-size:16px;">Email:</strong> <br />
							<input type="text" name="email" size="30" class="ipt_log"/> <br /><br />
							<input type="submit" value="Recuperar" class="pure-button"/> 
						</form>
					</div>		

					<?php
					}elseif($_GET['acao'] == "recuperada"){
					
					echo "<p><strong><h2>Já enviamos um email para recuperação de senha, por favor confira sua Caixa de Entrada ou a Caixa de Spam de seu email!</h2></strong></p>";
					
						//echo "<h3>Senha recuperada com sucesso, verifique sua caixa de entrada.</h3>";
							$sql = mysql_query("SELECT * FROM tb_usuario WHERE email = '$_POST[email]'") or die (mysql_error());
							$contagemUser = mysql_num_rows($sql);
							if($contagemUser > 0){
								while($row = mysql_fetch_array($sql)){
											$id = $row['id'];
											$email = $row['email'];
											$senha = $row['senha'];
											$senhaMini = substr( $senha, 0, 6 );
											
											$nomeremetente     = "Michel Farias";
											$emailremetente    = "michel@designteen.net";
											$assunto           = "Recuperação de senha - Livro de Receita";
											
											 $destinatario = $email;
$corpo = 'Você pediu a recuperação de senha, para alterar a senha acesse:

 http://www.livrodereceita.com/livro/?acao=altsenha&alt='.$senhaMini.'&us='.$id.' 

 
 Assim que alterar, basta logar no site, obrigado!';
 
//para o envio em formato HTML
$headers = "MIME-Version: 1.0";

$headers .= "Content-type: text/html;
charset=iso-8859-1";
 
//endereço do remitente
$headers .= "From: Contato Livro de Receita <michel@designteen.net>";
 
//endereço de resposta, se queremos que seja diferente a do remitente
$headers .= "Reply-To: michel@designteen.net";
 

	mail($destinatario,$assunto,$corpo,$headers);
											
								}
							}else{
								echo "<h3>Não foi possivel recuperar a senha, email não existente no banco de dados!</h3>";
							}
						
					}elseif($_GET['acao'] == "altsenha"){
					
					
						$sql = mysql_query("SELECT * FROM tb_usuario WHERE id = '$_GET[us]'") or die (mysql_error());
							$contagemUser = mysql_num_rows($sql);
							if($contagemUser > 0){
								while($row = mysql_fetch_array($sql)){
									$senha = $row['senha'];
								}
								
								$senhaMini = substr( $senha, 0, 6 );
								
								if($senhaMini == $_GET['alt']){
									echo '<form action="?acao=passalt" method="POST" enctype="multipart/form-data">	
												<h2>Nova Senha</h2><br />
											<input type="password" name="novasenha" class="inptentrar inp_con"/><br />
											<input type="hidden" name="id" value="'.$_GET["us"].'">
											<input type="submit" value="ALTERAR SENHA" class="btentrar"/>
										</form>';
								}
							
							}
							
					}elseif($_GET['acao'] == "passalt"){
						echo "<p><h2>Senha alterada com sucesso!</h2></p>";
						
						$idUser = $_POST['id'];
						$novasenha = md5($_POST['novasenha']);
						mysql_query("UPDATE tb_usuario SET senha='$novasenha' WHERE id=$idUser");
					}
					?>
						 
						
						
	</div>
	
<?php include_once('include/footer.php');?>