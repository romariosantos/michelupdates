<?php 
	include_once('include/conexao.php');
	include_once('include/header.php');
	
	$id = $_GET['id'];
	$ex = explode('-', $id);
	$id = array_pop($ex);

	$id = ( is_numeric($id)  ? $id : replace_str($id) ) ;
	
	$sqlUser = mysql_query("SELECT * FROM tb_usuario WHERE id = '$id'") or die(mysql_error());
	$dados = mysql_fetch_object($sqlUser);
	
	$totalRec = '1';
 
?>
 
	<div class="geral">
 
		<h1 class="titleg">Receitas enviadas por <?php echo $dados->nome;?> <span>total: <?php echo $totalRec;?></span></h1>
		<div class="line">
			<div class="set-down"></div>
		</div>
		
		<div class="left-user">
		
		<ul class="list-destaques">
			<?php 
				$i = 1;
				$sqlDestaques = mysql_query("SELECT * FROM receita WHERE id_user = '$id' ORDER BY id DESC") or die(mysql_error());
				 
				while($rDest = mysql_fetch_object($sqlDestaques)){
				
				$cat  = mysql_query("SELECT * FROM categoria WHERE id = '$rDest->categoria'") or die(mysql_error());
				$scat = mysql_query("SELECT * FROM subcategoria WHERE id = '$rDest->subcategoria'") or die(mysql_error());
				 
				$rowCat = mysql_fetch_object($cat);
			?>
			<li <?php if($i % 4 == 0){echo 'class="rdt"';} ?>>
				<a href="<?php echo ROOT.'/';?>receitas/<?php echo remAcentos(utf8_encode($rowCat->nome)).'/'.remAcentos(utf8_encode($rDest->nome)).'-'.$rDest->id.'.html'; ?>" title="<?php echo utf8_encode($rDest->nome);?>">
					<img src="<?php echo ROOT.'/';?>images/receitas/<?php echo $rDest->image;?>" alt="Image <?php echo utf8_encode($rDest->nome);?>" />
					<div class="title-dest"><?php echo utf8_encode(limite($rDest->nome, 25));?></div>
					<div class="by-dest">por <?php echo $dados->nome; ?></div>
				</a>
			</li>	
		 
			<?php $i++; }?>
		</ul>
		
		<div class="clear"></div>
		</div>
		
		<div class="right-rec">
			
			<div class="inf-enviado">
				
				<img src="<?php echo ROOT.'/'; ?>img/rec1.jpg" alt=""/>
				
				<div class="env-by">Enviado por</div>
				<a href="#"><?php echo $dados->nome; ?></a>
				
				<div class="clear"></div>
			</div>
			
			
			<img src="http://www-images.theonering.org/torwp/wp-content/uploads/2013/07/TORN-Tuesday-300-250.png" alt="" />
		</div> <!--/right-rec-->
		
		
		<div class="clear"></div>
		
		<div class="titleg">Super Destaques</div>
		<div class="line">
			<div class="set-down"></div>
		</div>
		
		<div id="s-destaques">
			<ul class="sdst">
				<li>
					<a href="#">
						<img src="<?php echo ROOT.'/';?>img/dest1.jpg" alt="" />
						<div class="title-sdst">Pavê de chocolate branco</div>
						<div class="by-sdst">por Romário zika</div>
					</a>
				</li>
				
				<li>
					<a href="#">
						<img src="<?php echo ROOT.'/';?>img/dest2.jpg" alt="" />
						<div class="title-sdst">Camarão no Abacaxi</div>
						<div class="by-sdst">por Romário zika</div>
					</a>
				</li>
				
				<li>
					<a href="#">
						<img src="<?php echo ROOT.'/';?>img/dest1.jpg" alt="" />
						<div class="title-sdst">Pavê de chocolate branco</div>
						<div class="by-sdst">por Romário zika</div>
					</a>
				</li>
			</ul>
			
			<div class="clear"></div>
		</div>
 
	</div>
	
<?php include_once('include/footer.php');?>