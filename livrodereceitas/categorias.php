<?php
	include_once('include/header.php');		
?>
 
	<div class="geral">
   
		 <div class="breadcrumb">
			<span class="bread">
				<a href="<?php echo ROOT.'/index.php'?>">Livro de Receita</a>
				>
			</span>
			 
			<span class="bread">
				<span class="breadsel"><?php echo utf8_encode($rowcat->nome);?></span>
			</span>
		</div>
		
		<h1 class="titleg-rec"><?php echo utf8_encode($rowcat->nome);?></h1>
		<div class="line">
			<div class="set-down"></div>
		</div>
		
		
		<ul class="list-destaques">
			<?php 
				$i = 1;
				
				
				$pg = $_GET['pg'];
				if(isset($pg)){
					$pg = $pg;
				}else{
					$pg = 1;
				}
												
				$quantidade = 30;
												
				$inicio = ($pg*$quantidade) - $quantidade;
				$sqlDestaques = mysql_query("SELECT * FROM receita WHERE categoria = '$id' ORDER BY id DESC LIMIT $inicio, $quantidade") or die(mysql_error());
				$counter = mysql_num_rows($sqlDestaques);
				
				if($counter <	1){
					echo "<p><br />Nenhum artigo nesta categoria.<br /></p>";
				}else{
				
				
				
				while($rDest = mysql_fetch_object($sqlDestaques)){
				
				$cat  = mysql_query("SELECT * FROM categoria WHERE id = '$rDest->categoria'") or die(mysql_error());
				$scat = mysql_query("SELECT * FROM subcategoria WHERE id = '$rDest->subcategoria'") or die(mysql_error());
				
				$rowCat = mysql_fetch_object($cat);
			?>
			<li <?php if($i % 6 == 0){echo 'class="rdt"';} ?>>
				
				<a href="<?php echo ROOT.'/';?>receitas/<?php echo utf8_encode(remAcentos($rowCat->nome)).'/'.utf8_encode(remAcentos($rDest->nome)).'-'.$rDest->id.'.html'; ?>" title="<?php echo utf8_encode($rDest->nome);?>">
					<img src="http://i1.wp.com/receitinhasdavovo.com/images/receitas/<?php echo $rDest->image;?>?resize=140,110" alt="Image <?php echo utf8_encode($rDest->nome);?>" />
					<div class="title-dest"><?php echo utf8_encode(limite($rDest->nome, 25));?></div>
					<!--<div class="by-dest">por Romário zika</div>-->
				</a>
			</li>
			
			<?php
				if($i % 6 == 0){
						if($k < 3){
					
							echo '<div class="ads728"></div>';
						}
					$k++;
				}
			?>
			 
			<?php $i++; }}?>
		</ul>
		
		
		
		<div class="clear"></div>

		<?php
		
		echo '<div  style="clear:both; padding-top: 10px;"></div> ';

		$sql_2  = mysql_query("SELECT * FROM receita WHERE categoria='$id'");
		
		$total_registros = mysql_num_rows($sql_2);

		$paginas = ceil($total_registros/$quantidade);
		$links = 3;

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

		if($total_registros > 30){

		echo '<div style="text-align:center;"> <ul class="pagination">';
		
		echo "<li><a href='".ROOT."/".$permalink_categoria."/'>Primeiro</a></li>";

		for($i = $pg-$links; $i <= $pg-1; $i++){
		if($i<=0){
		}else{
		echo "<li><a href='".ROOT."/c/".$permalink_categoria."/".$i."' >".$i."</a></li>";
		}
		}



		echo "<li><a href='#' class='atv'>$pg</a></li>";

		for($i = $pg+1; $i <= $pg+$links; $i++){
		if($i>$paginas){
		}else{
		echo "<li><a href='".ROOT."/c/".$permalink_categoria."/".$i."'>".$i."</a></li>";
		}
		}

		echo "<li><a href='".ROOT."/c/".$permalink_categoria."/".$paginas."'>Último</a></li>";

		echo "</ul> </div>";  
		}
		?>
		
		
		<div class="clear"></div>
		
	</div>
	
<?php include_once('include/footer.php');?>