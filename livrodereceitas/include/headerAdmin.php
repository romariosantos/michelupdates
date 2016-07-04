<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
<head>
	<?php include "../include/titulo.php"; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT .'/';?>css/estilo.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT .'/';?>css/estilo-int.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT .'/';?>css/media-style.css" />

	<script type="text/javascript" src="<?php echo ROOT .'/../';?>js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo ROOT .'/../';?>js/jq.js"></script>
	<script type="text/javascript" src="<?php echo ROOT .'/../';?>js/jquery.rating.js"></script>

<script type="text/javascript">
	jQuery(function(){
		jQuery('form.rating').rating();
	});
	</script>

	 
</head>
<body>

<?php
	$sql = mysql_query("SELECT * FROM tb_usuario WHERE id='$_SESSION[receitas_user_id]'");
	while($row = mysql_fetch_array($sql)){
		$nomeUsuario	= $row['nome'];
		$miniatura		= $row['miniatura'];
	}
?>


<div id="bg"></div>
<div class="bgmod"></div>
	
	<div id="line-top">
		<div class="geral">
		
			<div class="l-line-top">
				<ul class="nav-line"> 
					<li><a href="<?php  echo ROOT.'/../'; ?>contato/">Contato</a></li>
				</ul>
			</div>
			
			<div class="r-line-top">
			
				<ul class="nav-line-r">
				<?php
					if(!$_SESSION['receitas_user_logado']){
				?>
					<li><a href="#" class="tcad j_click" data-click="cadastro" data-root="<?php  echo ROOT.'/../'; ?>" >Cadastre-se</a></li>
					<li><a href="<?php  echo ROOT.'/../'; ?>livro/" class="tlog">Entrar</a></li>
				<?php
					}else{
						echo '<li><a href="'.ROOT.'/../meu-livro/home.php" class="tcad">Meu Livro de Receitas</a></li>';
						echo '<li><a href="'.ROOT.'/../meu-livro/sair.php" class="tlog">Sair</a></li>';
					}
				?>
				</ul>
				
			</div>
			
		</div>
	 
	</div>
	
	<div id="header">
		<div class="geral">
			<div class="logo">
				<a href="<?php  echo ROOT.'/../'; ?>index.php">
					<img src="<?php echo ROOT .'/../';?>img/logo.png" alt="Livro de Receita - o jeito mais fácil de cozinhar" title="Livro de Receita - o jeito mais fácil de cozinhar" />
				</a>
			</div>

			<ul class="nav_red">
				<li> <a href="#"></a> </li>
				<li class="btbusca bt_opensearch"> </li>
			</ul>
			
			<div class="buscamob">
				<form action="<?php echo ROOT .'/../';?>busca.php"  method="get">
					<input type="text" name="s" placeholder="Busque sua receita aqui..."  data-root="<?php echo ROOT.'/'; ?>" class="inpbusca" autocomplete="off"/>
					<button type="submit" class="btbusca"></button>
				</form>
			</div>


			<div class="busca">
				<form action="<?php echo ROOT .'/../';?>busca.php" id="busca" method="get">
					<input type="text" name="s" id="s" placeholder="Busque sua receita aqui..."  data-root="<?php echo ROOT.'/../'; ?>" class="inpbusca" autocomplete="off"/>
					<button type="submit" class="btbusca"></button>
				</form>
				
				<div class="fly-out-busca">
					 
				</div>

			</div>
		</div>

		<div class="clear"></div>
		<div id="nav_mob">
			<a href="#" class="cl_navmob">Fechar (menu)</a>
			<ul>
				<li>  <a href="<?php echo ROOT; ?>">&raquo; Início</a> </li>
				<?php  
					$i = 0;
					$sqlCat = mysql_query("SELECT * FROM categoria ORDER BY nome ASC ") or die(mysql_error());
					while($rCat = mysql_fetch_object($sqlCat)){

						$cls = ($i % 2 == 0) ? 'style="background:#fff;"' : '' ;
				?>
				<li <?php echo $cls; ?>><a href="<?php echo ROOT.'/../'.utf8_encode(remAcentos($rCat->nome)); ?>-<?php echo $rCat->id; ?>/">&raquo;  <?php echo  utf8_encode($rCat->nome);?></a>
					 
				</li>
				<?php $i++; } ?>				 
	 
			</ul>
		</div>

		<div class="clear"></div>
	</div>
	 
	<div id="navegacao">
		<div class="geral">
		
			<ul class="nav">
				<?php 
					$i = 1;
					
					$sqlCat = mysql_query("SELECT * FROM categoria ORDER BY nome ASC LIMIT 0, 8") or die(mysql_error());
					while($rCat = mysql_fetch_object($sqlCat)){
				?>
				<li><a href="<?php echo ROOT.'/../'.remAcentos(utf8_encode($rCat->nome)); ?>-<?php echo $rCat->id; ?>/"><?php echo  utf8_encode($rCat->nome);?></a>
					<ul class="dpnav <?php if($i == 7 or $i == 8){echo 'rdpnav';}?>">
						<?php 
							$sqlSubCat = mysql_query("SELECT * FROM subcategoria WHERE id_cat = '$rCat->id' ORDER BY nome ASC") or die(mysql_error());
							while($rSCat = mysql_fetch_object($sqlSubCat)){
						?>
						<li><a href="<?php echo ROOT.'/../'. remAcentos(utf8_encode($rCat->nome)); ?>-<?php echo $rCat->id; ?>/<?php echo remAcentos(utf8_encode($rSCat->nome)); ?>-<?php echo $rSCat->id; ?>/"><?php echo utf8_encode($rSCat->nome); ?></a></li>
						<?php } ?>
					</ul>
				</li>
				<?php $i++; } ?>
				
			 
				<li><a href="#">Mais[+]</a>
					<ul class="dpnav rdpnav">
						<?php 
							$sqlCat2 = mysql_query("SELECT * FROM categoria ORDER BY nome ASC LIMIT 8,50") or die(mysql_error());
							while($rCat2 = mysql_fetch_object($sqlCat2)){
						?>
						<li><a href="<?php echo ROOT.'/../'.remAcentos(utf8_encode($rCat2->nome)); ?>-<?php echo $rCat2->id; ?>/"><?php echo utf8_encode($rCat2->nome); ?></a>
							<ul class="sdpnav">
								<?php 
									$sqlSubCat2 = mysql_query("SELECT * FROM subcategoria WHERE id_cat = '$rCat2->id' ORDER BY nome ASC") or die(mysql_error());
									while($rSCat2 = mysql_fetch_object($sqlSubCat2)){
								?>
								<li><a href="<?php echo ROOT.'/../'.remAcentos(utf8_encode($rCat2->nome)); ?>-<?php echo $rCat2->id; ?>/<?php echo remAcentos(utf8_encode($rSCat2->nome)); ?>-<?php echo $rSCat2->id; ?>/"><?php echo utf8_encode($rSCat2->nome); ?></a></li>
								<?php } ?>
							</ul>
						</li>
						<?php } ?>
					</ul>
				</li>
				 
			</ul> 
		</div> 
	</div>

	<script type="text/javascript">
		$(function(){
			$('#nav_mob ul li').click(function(e){ 
				var self = $(this);

				self.find('ul').css({
					'display' : 'block'
				}); 
			});
  			

  			$('ul.nav_red li a').click(function(e){ 
  				e.preventDefault();
				$('#nav_mob').fadeIn();
			});

			$('a.cl_navmob').click(function(e){
				e.preventDefault();

				$('#nav_mob').fadeOut();
			});


			$('i.down_nv').click(function(e){ 
  				e.preventDefault();

  				var self = $(this);
  
				if( self.hasClass('nav_tg_cl') ){ 
					self.css( 'background' , 'url(img/sprite_icons.png) no-repeat -294px center' );
					self.removeClass('nav_tg_cl').addClass('nav_tg_open').find('span').text('(Fechar)');
					$('ul.nav_').removeClass('display_none').addClass('display_block');
				}else if( self.hasClass('nav_tg_open')){
					self.css( 'background' , 'url(img/sprite_icons.png) no-repeat -279px center' );
					self.removeClass('nav_tg_open').addClass('nav_tg_cl').find('span').text('(Abrir)');
					$('ul.nav_').removeClass('display_block').addClass('display_none');
				} 

			});


			$('.bt_opensearch').click(function(e){
				e.preventDefault();
				$('.buscamob').fadeIn();
				 $(this).fadeOut();
			});

			$(window).resize(function(){
				var w = $(this).width();

				if(w >= 900){
					$('.buscamob').hide();
					$('.bt_opensearch').css('display', 'block');
				}
			});

			$('li.show_opc_rs').on('click', function(e){
				e.preventDefault();
 
				var self = $(this),
					id   = self.attr('id').replace('id_', '');

				if( self.hasClass('tg_close') ){ 
					self.removeClass('tg_close').addClass('tg_open').find('span').text('(Fechar)');
					$('#op'+id+' li').fadeIn();
				}else if( self.hasClass('tg_open')){
					self.removeClass('tg_open').addClass('tg_close').find('span').text('(Abrir)');
					$('#op'+id+' li').fadeOut();
				} 
				 
			});


		});
	</script>
	
	
	
	