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
			
		<h1 class="titleg-rec italic">Resultado da busca: <?php echo removeInjection($_GET['s']); ?></h1>
		
			
		
			
<?php
	include "include/left.php";
?>
<?php
	$pg = $_GET['pg'];
	if(isset($pg)){
		$pg = $pg;
	}else{
		$pg = 1;
	}
									
	$quantidade = 10;
									
	$inicio = ($pg*$quantidade) - $quantidade;

	$buscado = removeInjection($_GET['s']);
		
	mysql_query("SET NAMES 'utf8'");
	$sqlBuscaReceita = ("SELECT * FROM receita WHERE nome LIKE '%$buscado%' ORDER BY id DESC LIMIT $inicio, $quantidade");
	$sqlTotalReceitas = ("SELECT * FROM receita WHERE nome LIKE '%$buscado%' ORDER BY id DESC");
	$sqlListaReceita = mysql_query($sqlBuscaReceita);
	$qtdReceitasBusca = mysql_num_rows(mysql_query($sqlTotalReceitas));
	
	
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
			
			<?php
				if($qtdReceitasBusca > 0){
			?>
				<div class="rec_salvas">

				<ul class="list_rs">
				<?php
					if($_GET['acao'] == "receitaexiste"){
						echo "<li style='color:red; font-size:15px;'><strong>Erro ao adicionar ao Meu livro de receitas, essa receita já encontra-se no seu livro de receitas.</strong></li>";
					}
				?>
					<?php
						echo "<div  class='q14'>Foram encontrada(s): <strong>".$qtdReceitasBusca."</strong> receita(s) de <strong>".$buscado."</strong></div><br />";
						while($rowbusca = mysql_fetch_array($sqlListaReceita)){
							$idReceita 		= $rowbusca['id'];
							$nomeReceita 	= $rowbusca['nome'];
							$imageReceita 	= $rowbusca['image'];
							
							echo '<li>
							<div class="crop_img_rs">
								<img src="http://www.receitinhasdavovo.com/images/receitas/'.$imageReceita.'" alt="" />
							</div>

							<div class="infs_rs">
								<div class="title_rs"><a href="#">'.$nomeReceita.'</a></div>

								<ul class="opcoes_rs" id="op'.$idReceita.'">
									<li class="show_opc_rs tg_close" id="id_'.$idReceita.'"><a href="#"><i class="ic ic_navmb"></i> Opções <span></span></a></li>
									<li><a href="imprimir.php?id='.$idReceita.'" target="_blank"><i class="ic ic_print"></i> Imprimir</a></li>
									<li><a href="enviar_mais_fotos.php?id='.$idReceita.'"><i class="ic ic_album"></i> Enviar Fotos</a></li>
									<li><a href="imprimir.php?id='.$idReceita.'&lista=1" target="_blank"><i class="ic ic_config"></i> Lista de compras</a></li>
									<li><a href="adicionar_livro.php?id='.$idReceita.'&s='.$buscado.'"><i class="ic ic_config"></i> Adicionar ao Livro de Receitas</a></li>
									<div class="clear"></div>
								</ul>
							</div>
							<div class="clear"></div>
						</li>';
						}
					?>
				</ul>
				
				
		<?php
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

					echo '<div class="pag_rs"><ul>';
					
					echo "<li><a href='resultado_busca.php?pg=1&s=".removeInjection($_GET['s'])."'>Primeiro</a></li>";

					for($i = $pg-$links; $i <= $pg-1; $i++){
					if($i<=0){
					}else{
					echo "<li><a href='resultado_busca.php?pg=".$i."&s=".removeInjection($_GET['s'])."'>".$i."</a></li>";
					}
					}



					echo "<li><a href='#' style='background-color:#f7cb64;'>$pg</a></li>";

					for($i = $pg+1; $i <= $pg+$links; $i++){
					if($i>$paginas){
					}else{
					echo "<li><a href='resultado_busca.php?pg=".$i."&s=".removeInjection($_GET['s'])."'>".$i."</a></li>";
					}
					}

					echo "<li><a href='resultado_busca.php?pg=".$paginas."&s=".removeInjection($_GET['s'])."'>Último</a></li>";
					
					echo "</ul>
				</div>";  
					}
					
		?>

			</div>
					
			<?php
				}else{
					echo "<div  class='q14'> Não foram encontradas receitas com esse termo:  de <strong>".removeInjection($_GET['s'])."</strong></div><br />";
				}
			?>
			
		
			


		</div>

</div>	


<?php
	include_once "../include/footer.php";
}else{
	header("location:../livro/");
}
?>