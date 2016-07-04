<?php 		
	session_start();
	require("include/conexao.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
<head> 
	<?php require("include/titulo.php"); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="<?php echo ROOT .'/';?>css/estilo.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT .'/';?>css/media-style.css" />

	<link rel="stylesheet" href="<?php echo ROOT .'/';?>js/lightbox2/src/css/lightbox.css">

	<script type="text/javascript" src="<?php echo ROOT .'/';?>js/jquery-1.10.2.min.js"></script>
	

	<!--<script type="text/javascript" src="<?php echo ROOT .'/';?>js/jquery.cycle.lite.js"></script>-->
	<script type="text/javascript" src="<?php echo ROOT .'/';?>js/jq.js"></script>
	<script type="text/javascript" src="<?php echo ROOT .'/';?>js/jquery.rating.js"></script>
	
	<!--<script type="text/javascript" src="http://www.receitinhasdavovo.org/js/pop.js"></script>-->
	<!--<script src="http://ads67327.hotwords.com/show.jsp?id=67327&cor=005F00"></script>-->
	<script type="text/javascript">
		$(function(){
			 $('#slider ul.sld').cycle({ 
				fx:    'fade', 
				speed:   400, 
				timeout: 5000,
				next:   '#slider ul.sld li #next', 
				prev:   '#slider ul.sld li #prev', 
				pause:  1
			 });
		});
	</script>
	
	<script type="text/javascript">
	jQuery(function(){
		jQuery('form.rating').rating();
	});
	</script>

	


<?php
	$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/b695b6c7fe3ce0b98125cce2584dbd32.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";


$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/d8edea22962715e9e2d736fe9b16bc8e.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";


$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/3889029c735f7ffa515f15edb714c399.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";

$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/146abbf369b868e9e4ce494942529027.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";


$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/f986fa6dc188e9accda2e200c9f42eba.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";

$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/b98589690257ef3d56e0f81987ded02c.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";

$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/e2b5c1d9f90babbc5c43e06d5bb1839d.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";

$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/0c3749609e05e4f9cccd4c54d15f5ae8.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";

$push[] = "<script type=\"text/javascript\">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/44da5ec2310431da344d8b03c3a517bc.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>";

echo $push[rand(0,count($push)-1)];
?>         

</head>

<body>

<div id="fb-root"></div>

	<div id="bg"></div>
	
	<!--<div id="pop">
		<a href="#" class="j_close" >X</a>
	
		<img src="<?php echo ROOT .'/img/fernanda.jpg';?>">
		<h2>RECEBA TODAS RECEITAS EM SEU FACEBOOK! SÓ CLICAR EM <div style="color:red;">ACOMPANHAR ABAIXO</div></h2>
				
		<div class="bt-face">
			<div class="fb-follow" data-href="https://www.facebook.com/Fernanda.chef" data-width="400" data-colorscheme="light" data-layout="box_count" data-show-faces="false"></div>
		</div>
		
		<div class="ct">Aguarde <span>18</span> segundos</div>
	</div>-->

<div class="bgmod"></div>
	
	<div class="modal">
		<a href="#" class="j_close_md">X</a>
		<div class="j_html"></div>
	</div>
	
	<div id="line-top">
		<div class="geral">
		
			<div class="l-line-top">
				<ul class="nav-line">
					 
					<li><a href="<?php  echo ROOT.'/'; ?>contato/">Contato</a></li>
				</ul>
			</div>
			
			<div class="r-line-top">
			
				<ul class="nav-line-r">
				<?php
					if(!$_SESSION['receitas_user_logado']){
				?>
					<li><a href="#" class="tcad j_click" data-click="cadastro" data-root="<?php  echo ROOT.'/'; ?>" >Cadastre-se</a></li>
					<li><a href="<?php  echo ROOT.'/'; ?>livro/" class="tlog">Entrar</a></li>
				<?php
					}else{
						echo '<li><a href="'.ROOT.'/meu-livro/home.php" class="tcad">Meu Livro de Receitas</a></li>';
						echo '<li><a href="'.ROOT.'/meu-livro/sair.php" class="tlog">Sair</a></li>';
					}
				?>
				</ul>
				
			</div>
			
		</div>
	 
	</div>
	
	<div id="header">
		<div class="geral">
			<div class="logo">
				<a href="<?php  echo ROOT.'/'; ?>index.php">
					<img src="<?php echo ROOT .'/';?>img/logo.png" alt="Livro de Receita - o jeito mais fácil de cozinhar" title="Livro de Receita - o jeito mais fácil de cozinhar" />
				</a>
			</div>
			
			<ul class="nav_red">
				<li> <a href="#"></a> </li>
				<li class="btbusca bt_opensearch"> </li>
			</ul>

			<div class="buscamob">
				<form action="<?php echo ROOT .'/';?>busca.php"  method="get">
					<input type="text" name="s" placeholder="Busque sua receita aqui..."  data-root="<?php echo ROOT.'/'; ?>" class="inpbusca" autocomplete="off"/>
					<button type="submit" class="btbusca"></button>
				</form>
			</div>

			<div class="busca">
				<form action="<?php echo ROOT .'/';?>busca.php" id="busca" method="get">
					<input type="text" name="s" id="s" placeholder="Busque sua receita aqui..."  data-root="<?php echo ROOT.'/'; ?>" class="inpbusca" autocomplete="off"/>
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
					$sqlCat = mysql_query("SELECT * FROM categoria WHERE id != 20 AND id != 19 AND id != 3 AND id != 15 AND id != 18 ORDER BY nome ASC ") or die(mysql_error());
					while($rCat = mysql_fetch_object($sqlCat)){

						$cls = ($i % 2 == 0) ? 'style="background:#fff;"' : '' ;
				?>
				<li <?php echo $cls; ?>><a href="<?php echo ROOT.'/'.utf8_encode(remAcentos($rCat->nome)); ?>-<?php echo $rCat->id; ?>/">&raquo;  <?php echo  utf8_encode($rCat->nome);?></a>
					 
				</li>
				<?php $i++; } ?>				 
	 
			</ul>
		</div>

		<div class="clear"></div>
	</div> <!--header-->
	 
	<div id="navegacao">
		<div class="geral">
		
			<ul class="nav">
				<?php 
					$i = 1;
					
					$sqlCat = mysql_query("SELECT * FROM categoria WHERE id != 20 AND id != 19 AND id != 3 AND id != 15 AND id != 18 ORDER BY nome ASC LIMIT 0, 8") or die(mysql_error());
					while($rCat = mysql_fetch_object($sqlCat)){
				?>
				<li><a href="<?php echo ROOT.'/'.utf8_encode(remAcentos($rCat->nome)); ?>-<?php echo $rCat->id; ?>/"><?php echo  utf8_encode($rCat->nome);?></a>
					<ul class="dpnav <?php if($i == 7 or $i == 8){echo 'rdpnav';}?>">
						<?php 
							$sqlSubCat = mysql_query("SELECT * FROM subcategoria WHERE id_cat = '$rCat->id' ORDER BY nome ASC") or die(mysql_error());
							while($rSCat = mysql_fetch_object($sqlSubCat)){
						?>
						<li><a href="<?php echo ROOT.'/'. utf8_encode(remAcentos($rCat->nome)); ?>-<?php echo $rCat->id; ?>/<?php echo utf8_encode(remAcentos($rSCat->nome)); ?>-<?php echo $rSCat->id; ?>/"><?php echo utf8_encode($rSCat->nome); ?></a></li>
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
						<li><a href="<?php echo ROOT.'/'.utf8_encode(remAcentos($rCat2->nome)); ?>-<?php echo $rCat2->id; ?>/"><?php echo utf8_encode($rCat2->nome); ?></a>
							<ul class="sdpnav">
								<?php 
									$sqlSubCat2 = mysql_query("SELECT * FROM subcategoria WHERE id_cat = '$rCat2->id' ORDER BY nome ASC") or die(mysql_error());
									while($rSCat2 = mysql_fetch_object($sqlSubCat2)){
								?>
								<li><a href="<?php echo ROOT.'/'.utf8_encode(remAcentos($rCat2->nome)); ?>-<?php echo $rCat2->id; ?>/<?php echo utf8_encode(remAcentos($rSCat2->nome)); ?>-<?php echo $rSCat2->id; ?>/"><?php echo utf8_encode($rSCat2->nome); ?></a></li>
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
				$('#nav_mob').fadeIn();
			});

			$('a.cl_navmob').click(function(e){
				e.preventDefault();

				$('#nav_mob').fadeOut();
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
		});
	</script>