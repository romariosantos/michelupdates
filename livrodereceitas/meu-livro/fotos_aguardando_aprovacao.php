<?php
session_start();
if(isset($_SESSION['receitas_user_logado']) AND isset($_SESSION['receitas_user_id'])){
	include_once "../include/conexao.php";
	include_once "../include/headerAdmin.php";
	include_once "../include/funcoes.php";
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
			
		<h1 class="titleg-rec italic">Fotos Aguardando Aprovação: <?php //echo removeInjection($_GET['s']); ?></h1>
		
			
		
			
<?php
	include "include/left.php";
?>


		<div class="center_mlivro">
		
 			
			<div class="center_search">
				<div class="title_tdr">Todas as receitas</div>

				<div class="search_rec">
				<form action="resultado_busca.php" method="GET">
					<input type="text" name="s" placeholder="Buscar receita" class="inp2"/>
					<button type="submit" class="btn_s">Buscar</button>
				</form>
				</div>
			</div>
			
			
			<div class="right_form_er">
			<div class="title_er">Atenção</div>

			<div class="pdd_form_er inf_er">
				<div class="tt_inf_er">Suas fotos serão analisadas, assim que forem aprovadas serão publicadas...</div> 
			</div>
			
			<ul class="alb">
			<?php
				mysql_query("SET NAMES 'utf8'");
				$pg = $_GET['pg'];
				if(isset($pg)){
					$pg = $pg;
				}else{
					$pg = 1;
				}
												
				$quantidade = 10;
												
				$inicio = ($pg*$quantidade) - $quantidade;
				
				$sqlListaReceita = mysql_query("SELECT * FROM tb_imagens_adicionais WHERE id_user='$_SESSION[receitas_user_id]' ORDER BY id DESC LIMIT $inicio, $quantidade");
				while($rowbusca = mysql_fetch_array($sqlListaReceita)){
					$imagem	= $rowbusca['nome'];
					echo '<li><a href="#"><img src="http://www.receitinhasdavovo.com/images/receitas_imagens_adicionais/'.$imagem.'"> Title</a></li>';
				}
			?>
			</ul>
				
				<div class="clear"></div>
				<br/><br/>

				<!--<div class="pag_rs space_left">
					<ul>
						<li><a href="#">Anterior</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">Próximo</a></li>
					</ul>
				</div>
				<div class="clear"></div>
				<br/><br/>-->
				
				
				<?php
					$sqlTotalReceitas = ("SELECT * FROM tb_imagens_adicionais WHERE id_user='$_SESSION[receitas_user_id]'");
					echo '<div  style="clear:both; padding-top: 10px;"></div> ';

					$sql_2  = mysql_query($sqlTotalReceitas);
					
					$total_registros = mysql_num_rows($sql_2);

					$paginas = ceil($total_registros/$quantidade);
					$links = 8;

					if(empty($_SERVER['QUERY_STRING'])){
					$anterior = "1"; 
					}elseif($_GET['pg'] != '1'){
						$anterior = ($pg -1);
					}else{
						$anterior = "1";
					}
					if($pg < $paginas){
						$proximo = ($pg +1);
					}else{
						$proximo = $_GET['pg'];
					}
					//upa 

					if($total_registros > 10){

					echo '<div class="pag_rs" style="margin-left:40px;"><ul>';
					
					echo "<li><a href='?pg=1'>Primeiro</a></li>";

					for($i = $pg-$links; $i <= $pg-1; $i++){
					if($i<=0){
					}else{
					echo "<li><a href='?pg=".$i."'>".$i."</a></li>";
					}
					}



					echo "<li><a href='#' style='background-color:#f7cb64;'>$pg</a></li>";

					for($i = $pg+1; $i <= $pg+$links; $i++){
					if($i>$paginas){
					}else{
					echo "<li><a href='?pg=".$i."'>".$i."</a></li>";
					}
					}

					echo "<li><a href='?pg=".$paginas."'>Último</a></li>";
					
					echo "</ul>
					</div>";  
					}
					
		?>
		<div class="clear"></div>
				<br/><br/>
		</div>


		
			
		
			


		</div>

</div>	


<?php
	include_once "../include/footer.php";
}else{
	header("location:../livro/");
}
?>