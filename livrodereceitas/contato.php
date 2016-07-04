<?php 
	include_once('include/header.php');		
?>
 
	<div class="geral f14">
   
		 <div class="breadcrumb">
			<span class="bread">
				<a href="<?php echo ROOT.'/index.php'?>">Livro de Receita</a>
				>
			</span>
		</div>
		
		
		<div class="line">
			<div class="set-down"></div>
		</div>
		
		<Br />
		<?php
			if(!$_GET['acao'] == "enviar"){
		?>
			 
			<form action="?acao=enviar" method="POST" enctype="multipart/form-data">	
					Nome<br />
				<input type="text" name="nome"   class="inptentrar inp_con"/><br />
					Email<br />
				<input type="text" name="email"   class="inptentrar inp_con"/><br />
					Assunto<br />
				<input type="text" name="assunto"  class="inptentrar inp_con"/><br />
					Mensagem<br />
				<textarea name="mensagem" cols="35" rows="7" class="t_con"></textarea>
				<br />
				<br />
				<?php
					$numero1 = rand(0,20);
					$numero2 = rand(0,20);
				?>
				FACA A SOMA: Qual resultado <?php echo $numero1." + ".$numero2."?"; ?><br />
				<input type="hidden" name="quantidade1" value="<?php echo $numero1+$numero2;?>"/>

				<input type="text" name="quantidade2"  class="inptentrar inp_con"/><br />

				<input type="submit" value="Enviar" class="btentrar"/>
			</form>
			 
			<?php
			}
			?>
			
			<?php
				if(count($_POST)>0){
				
					$nome = $_POST['nome'];
					$email = $_POST['email'];
					$assunto = $_POST['assunto'];
					$mensagem = $_POST['mensagem'];
					
					if($nome == "" OR $email == "" OR $assunto == "" OR $mensagem == ""){
						echo "PREENCHA TODOS OS CAMPOS E TENTE NOVAMENTE!";
					}else{
					
						if($_GET['acao'] == "enviar"){
						
						$mensagem_email_enviar = "NOME: $nome<br><br>
						EMAIL: $email<br><br>
						ASSUNTO: $assunto<br><br>
						MENSAGEM: $mensagem<br><br>";
						
						$nosso_assunto = "CONTATO - RECEITINHAS DA VOVO";
						$quebra_linha = "\r\n";
						$headers = "MIME-Version: 1.1" .$quebra_linha;
						$headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
						$headers .= "From: " . $email.$quebra_linha;

						/// DEPOIS É SÓ FAZER UM FUNCAO MAIL TROCANDO O MEU EMAIL PELO DO CARA

						if($_POST['quantidade1'] == $_POST['quantidade2']){
							$mensagemenviada = mail("michel@designteen.net",$nosso_assunto,$mensagem_email_enviar, $headers);
						}else{
							echo "<p><strong>A SOMA NAO CORRESPONDE, INFELIZMENTE HOUVE ESSA FALHA AO ENVIAR EMAIL DE CONTATO</strong></p>";
						}
						
							if($mensagemenviada){
								echo '<center><strong><br><br>MENSAGEM ENVIADA COM SUCESSO!</strong></center>';
								echo '<center><strong><br><br>EM BREVE ENTRAREMOS EM CONTATO!</strong></center><br><br>';
								
							}
							
						}
					
					}
					
				
					
				}
			?>
		
	</div>
	
<?php include_once('include/footer.php');?>