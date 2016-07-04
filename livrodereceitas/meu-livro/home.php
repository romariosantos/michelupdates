<?php 
	session_start();
	//echo $_SESSION['receitas_user_logado'];
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
			
		<h1 class="titleg-rec italic">Meu livro de receitas</h1>
 		
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
	$idUsuario = $_SESSION['receitas_user_id'];
	
	mysql_query("SET NAMES 'utf8'");
	$sqlTotalReceitas = ("SELECT * FROM receita INNER JOIN tb_meulivro ON tb_meulivro.idreceita=receita.id WHERE tb_meulivro.usuario='$idUsuario' ORDER BY tb_meulivro.id DESC");
	$meulivro = mysql_query("SELECT * FROM receita INNER JOIN tb_meulivro ON tb_meulivro.idreceita=receita.id WHERE tb_meulivro.usuario='$idUsuario' ORDER BY tb_meulivro.id DESC LIMIT $inicio, $quantidade");
	$qtdMeuLivro = mysql_num_rows(mysql_query($sqlTotalReceitas));
	
	
	
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
			

			<div class="rec_salvas">

				<ul class="list_rs">
				<?php
					if($_GET['acao'] == "adicionadalivro"){
						echo "<li style='color:green; font-size:15px;'><p><strong>Receita adicionada ao livro com sucesso</strong></p></li>";
					}elseif($_GET['acao'] == "erroalivro"){
						echo "<li style='color:red; font-size:15px;'><p><strong>Erro ao adicionar ao Meu livro de receitas</strong></p></li>";
					}elseif($_GET['acao'] == "removido"){
						echo "<li style='color:green; font-size:15px;'><p><strong>Receita foi removida com sucesso do livro de receitas.</strong></p></li>";
					}elseif($_GET['acao'] == "erroremover"){
						echo "<li style='color:red; font-size:15px;'><p><strong>Erro ao remover receita do Meu livro de receitas</strong></p></li>";
					}
				?>
					
				
				<?php
					if($qtdMeuLivro > 0){
						echo "<div class='q14'>Foram encontrada(s): <strong>".$qtdMeuLivro."</strong> em seu livro de receitas.</div><br />";
					}else{
						echo "<div class='q14'>Não foram encontrada(s) nenhuma receita em seu livro de receitas.<br /><p>Para adicionar faça uma busca acima e clique em <strong>Adicionar ao Livro de Receitas</strong>.</p></div><br />";
					}
					while($rowlivro = mysql_fetch_array($meulivro)){
							$idReceita 		= $rowlivro['idreceita'];
							$nomeReceita 	= $rowlivro['nome'];
							$imageReceita 	= $rowlivro['image'];
							
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
									<li><a href="remover_livro.php?id='.$idReceita.'"><i class="ic ic_config"></i>Remover do Livro de Receitas</a></li>
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
					
					echo "<li><a href='home.php?pg=1&s=".removeInjection($_GET['s'])."'>Primeiro</a></li>";

					for($i = $pg-$links; $i <= $pg-1; $i++){
					if($i<=0){
					}else{
					echo "<li><a href='home.php?pg=".$i."&s=".removeInjection($_GET['s'])."'>".$i."</a></li>";
					}
					}



					echo "<li><a href='#' style='background-color:#f7cb64;'>$pg</a></li>";

					for($i = $pg+1; $i <= $pg+$links; $i++){
					if($i>$paginas){
					}else{
					echo "<li><a href='home.php?pg=".$i."&s=".removeInjection($_GET['s'])."'>".$i."</a></li>";
					}
					}

					echo "<li><a href='home.php?pg=".$paginas."&s=".removeInjection($_GET['s'])."'>Último</a></li>";
					
					echo "</ul>
				</div>";  
					}
					
		?>

				<!--<div class="pag_rs">
					<ul>
						<li><a href="#">Anterior</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">Próximo</a></li>
					</ul>
				</div>-->

			</div>


		</div>

</div>	


<?php
	include_once "../include/footer.php";
}else{
	header("location:../livro/");
}
?>