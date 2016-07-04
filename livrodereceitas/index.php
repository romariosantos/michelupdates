<?php
	error_reporting(0);
	//include_once('include/conexao.php');
	include_once('include/header.php');
?>
 
	<div class="geral">
		
		<div class="b-left">
		
			<div id="slider">
				
				<ul class="sld">
					<?php 
						$sqlSlide = mysql_query("SELECT * FROM receita WHERE categoria != 20 AND categoria != 19 AND categoria != 3 AND categoria != 15 AND categoria != 18 ORDER BY views DESC LIMIT 4") or die(mysql_error());
						while($rowS = mysql_fetch_object($sqlSlide)){
						
						$catd    = mysql_query("SELECT * FROM categoria WHERE id = '$rowS->categoria' AND id != 20 AND id != 19 AND id != 3 AND id != 15 AND id != 18") or die(mysql_error());
						$rowCatd = mysql_fetch_object($catd);
					?>
					
					<li>  
						<a href="#" class="arrow-left" id="prev"></a>
						<a href="#" class="arrow-right" id="next"></a>
						<img src="http://www.receitinhasdavovo.com/images/receitas/<?php echo $rowS->image;?>" alt=""/>
						<div class="title-slider"><a href="receitas/<?php echo utf8_encode(remAcentos($rowCatd->nome)).'/'.utf8_encode(remAcentos($rowS->nome)).'-'.$rowS->id.'.html'; ?>" title="<?php echo utf8_encode($rowS->nome);?>"><?php echo utf8_encode(limite($rowS->nome, 40));?></a></div>
					</li>
					
					<?php } ?>
				</ul>
				
			</div>
		</div>
		
		<div class="b-right">
			
			<div class="send-rec">
				<a href="act_cl.php">Envie suas receitas <img src="img/icone-right.png" alt="Envia sua receita"  /></a>
			</div>
			
			
			<div class="titler">Top Receitas</div>
			<div class="line">
				<div class="set-down"></div>
			</div>
			
			
			<ul class="top-receitas">
				<?php 
					$sqlDestaquest = mysql_query("SELECT * FROM receita WHERE categoria != 20 AND categoria != 19 AND categoria != 3 AND categoria != 15 AND categoria != 18 ORDER BY views DESC LIMIT 3") or die(mysql_error());
					while($rDestt = mysql_fetch_object($sqlDestaquest)){
					
					$catt    = mysql_query("SELECT * FROM categoria WHERE id = '$rDestt->categoria' AND id != 20 AND id != 19 AND id != 3 AND id != 15 AND id != 18") or die(mysql_error());
					$rowCatt = mysql_fetch_object($catt);
				?>
				<li>
					<a href="receitas/<?php echo utf8_encode(remAcentos($rowCatt->nome)).'/'.utf8_encode(remAcentos($rDestt->nome)).'-'.$rDestt->id.'.html'; ?>" title="<?php echo utf8_encode($rDestt->nome);?>">
						<img src="http://i1.wp.com/receitinhasdavovo.com/images/receitas/<?php echo $rDestt->image;?>?resize=140,110" alt="Image <?php echo utf8_encode($rDestt->nome);?>"  />
						<div class="title-toprec"><?php echo utf8_encode(limite($rDestt->nome, 20));?></div>
						<!--<div class="by-toprec">por Romário zika</div>-->
					</a>
				</li>
				 <?php }?>
			</ul> 

		</div>


		
		<div class="clear"></div>
		
		<div class="titleg">Receitas Destaques</div>
		<div class="line">
			<div class="set-down"></div>
		</div>
		
		
		<ul class="list-destaques">
			<?php 
				$i = 1;
				$sqlDestaques = mysql_query("SELECT * FROM receita WHERE categoria != 20 AND categoria != 19 AND categoria != 3 AND categoria != 15 AND categoria != 18 ORDER BY id DESC LIMIT 18") or die(mysql_error());
				while($rDest = mysql_fetch_object($sqlDestaques)){
				
				$cat  = mysql_query("SELECT * FROM categoria WHERE id = '$rDest->categoria'") or die(mysql_error());
				$scat = mysql_query("SELECT * FROM subcategoria WHERE id = '$rDest->subcategoria'") or die(mysql_error());
				
				$rowCat = mysql_fetch_object($cat);
			?>
			<li <?php if($i % 6 == 0){echo 'class="rdt"';} ?>>
				<a href="receitas/<?php echo utf8_encode(remAcentos($rowCat->nome)).'/'.utf8_encode(remAcentos($rDest->nome)).'-'.$rDest->id.'.html'; ?>" title="<?php echo utf8_encode($rDest->nome);?>">
					<img src="http://i1.wp.com/receitinhasdavovo.com/images/receitas/<?php echo $rDest->image;?>?resize=140,110" alt="Image <?php echo utf8_encode($rDest->nome);?>" />
					<div class="title-dest"><?php echo utf8_encode(limite($rDest->nome, 25));?></div>
					<!--<div class="by-dest">por Romário zika</div>-->
				</a>
			</li>	
			 
			<?php $i++; }?>
		</ul>
		
		
		
	
	</div>
	
<?php include_once('include/footer.php');?>