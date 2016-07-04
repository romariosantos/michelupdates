<?php 
	include_once('include/header.php');		
?>
 
	<div class="geral">
   
		 <div class="breadcrumb">
			<span class="bread">
				<a href="<?php echo ROOT.'/index.php'?>">Livro de Receita</a> > <h3 class="titleg-rec">Cadastro no site</h3>
				
			</span>
		</div>
		
		
		<div class="line">
			<div class="set-down"></div>
		</div>
		

		<?php
			$act = $_POST['act'];
	
	function inj($campo){
		$limpa = strip_tags(trim(addslashes($campo)));
		return $limpa;
	}
	
	switch($act){
		case 'cconta' :
			$nome  		= inj($_POST['nome']);
			$email 		= inj($_POST['email']);
			$senha 		= inj(md5($_POST['senha']));
			$senhaigual = inj(md5($_POST['senha2']));
			$ip 		= $_SERVER["REMOTE_ADDR"];
			$data 		= date('Y-m-d');

			//echo $senha.'<br>'.$senhaigual;
			
			if(!empty($nome) and !empty($email) and !empty($senha) and !empty($senhaigual)){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		
				if(strlen(inj($_POST['senha'])) >= 5){
				
				
							if($senha != $senhaigual){
								echo '<p><h3>Digite as duas senhas iguais para fazer o cadastro!<h3></p>';
							}else{
									$sql = mysql_query("SELECT * FROM tb_usuario WHERE email = '$email' ") or die(mysql_error());
									if(mysql_num_rows($sql) == 0){
															//$code_active_profile = substr(md5(base64_encode('a'.rand(1,999).'m')), 0, 10);
													
															$cadastra = mysql_query("INSERT INTO tb_usuario SET nome = '$nome', email = '$email', senha = '$senha', verificado = 0, desativado = 0, ip = '$ip', data_cadastro = '$data'") or die (mysql_error());
															$id = mysql_insert_id();
															
															if($cadastra){
																$sqluser = mysql_query("SELECT * FROM tb_usuario WHERE id = '$id' ") or die(mysql_error());
																$dados = mysql_fetch_object($sqluser);
																
																$link_user = remAcentos($dados->nome).'-'.$dados->id;
																
																//echo "<p>Usuário cadastrado com sucesso, entre em seu email para validar!</p>";
														
																include_once('class/Logar.class.php');
																
																if(Logar::login($email, inj($_POST['senha']))){
																	echo '<script>window.location.href="meu-livro/home.php?cadastrado=1";</script>';
																}else{
																	echo 'Não foi possível efetuar seu cadastro';
																}
																
															}else{
																echo '<p><h3>Não foi possível efetuar seu cadastro<h3></p>';
															}
													

									}else{
										echo '<p><h3>Erro ao cadastrar, já existe um cadastro com esse email!<h3></p>';
									}
							}
					
				}else{
					echo '<p><h3>Não foi possível efetuar seu cadastro, sua senha tem que ter no minimo 5 caracteres!<h3></p>';
				}
					
				}else{
					echo '<p><h3>E-mail inválido<h3></p>';
				}
			}else{
				echo '<p><h3>Preencha Todos os Campos<h3></p>';
			}
			
			break;
		
		case 'clog' :
			$email = inj($_POST['email']);
			$senha = inj(md5($_POST['senha']));
			
			if(!empty($email) and !empty($senha)){
				include_once('class/Logar.class.php');
				Logar::login($email, $senha);
			}else{
				echo 'Campo e-mail ou senha está vázio';
			}
			
			break;
		
		default : 'Erro na ação';
	}
		?>
		
		
		
			<div class="box_login">

						<form action="" method="post" name="act">
							<strong style="font-size:16px;">Nome:</strong> <br />
							<input type="text" name="nome" size="30" value="<?php echo $_POST['nome'];?>" class="ipt_log" /> <br /><br />
							
							<strong style="font-size:16px;">Email:</strong> <br />
							<input type="text" name="email" value="<?php echo $_POST['email'];?>" size="30" class="ipt_log" /> <br /><br />
							
							<strong style="font-size:16px;">Senha:</strong> <br />
							<input type="password" name="senha" size="30" value="<?php echo $_POST['senha'];?>" class="ipt_log"/> <br /> <br />
							
							<strong style="font-size:16px;">Repetir Senha:</strong> <br />
							<input type="password" name="senha2" value="<?php echo $_POST['senha2'];?>" size="30" class="ipt_log"/> <br /> <br />
							
							<input type="hidden" name="act" value="cconta" size="30" class="ipt_log"/> <br /> <br />
							
							
							
							<button class="pure-button" />FINALIZAR CADASTRO</button> 
							<br /><br />
							<a href="?acao=recuperar" class="esq_senha">Esqueci a senha</a>
						</form>
					</div>	
		
		
	</div>
	
<?php include_once('include/footer.php');?>