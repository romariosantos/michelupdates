<?php
	include_once('include/header.php');
	/*
	if(!isset($_COOKIE['receitas_no_ponto']) and $_COOKIE['receitas_no_ponto'] != $id){
		setcookie("receitas_no_ponto", $id, (time()+3600*24) );
		$atualiza = mysql_query("UPDATE receita SET views = (views+1) WHERE id = '$id' ") or die(mysql_error());
	}
	*/
	$refenciamento = $_SERVER['HTTP_REFERER'];
	$diahoje 	   = date('d');
	$minutoagora   = date('i');
	
	if (preg_match("/facebook/i", $refenciamento)){
		if($diahoje > 0){
			//if($minutoagora % 2 == 1){
				//$anuncioAprovado = TRUE;
				$anuncioAprovado = FALSE;
			//}
		}
	}	 

?>

	<div class="geral">
	
		<div class="breadcrumb">
			<span class="bread">
				<a href="<?php echo ROOT.'/index.php'?>">Livro de Receita</a>
				>
			</span>
			
			<span class="bread"> 
				<a href="<?php echo ROOT.'/'.utf8_encode(remAcentos($rowcat->nome)).'-'.$rowcat->id; ?>/"><?php echo utf8_encode($rowcat->nome); ?></a>
				>
			</span>
			
			<span class="bread">
				<span class="breadsel">Receita de <?php echo utf8_encode($row->nome); ?></span>
			</span>
		</div>
		
		
			
		<h1 class="titleg-rec"><a href="<?php echo ROOT.$_SERVER['REQUEST_URI'];?>"><?php echo utf8_encode($row->nome); ?></a></h1>
		<?php 
			if($row->descricao != NULL){
				echo '<h2 class="subtitle-rec">'.utf8_encode($row->descricao).'</h2>';
			}else{
				if($row->categoria != 20 AND $row->categoria != 15 AND $row->categoria != 19 AND $row->categoria != 18){
					echo '<h2 class="subtitle-rec">Faça essa receita "'.utf8_encode($row->nome).'" ela é deliciosa e fácil de fazer.</h2>';
				}
			}
		?>
		<div class="line">
			<div class="set-down"></div>
		</div>
		
			<!--<div class="ads970x250"></div>-->
			
		<div class="clear"></div>
			
		<div class="inforec-img">
			<img src="<?php echo 'http://i1.wp.com/www.receitinhasdavovo.com/images/'.$imagem_diretorio.'/'.$row->image;?>?resize=460,250&quality=90" alt="<?php echo utf8_encode($row->nome); ?>" style="margin-bottom:15px; "/>

			<ul class="thumbs_extras">
				<?php 
					$getImgsExtras = mysql_query("SELECT * FROM tb_imagens_adicionais WHERE id_receita = '$id' ORDER BY id DESC LIMIT 5") or die(mysql_error());

					if(mysql_num_rows($getImgsExtras) > 0):

					while($imgs = mysql_fetch_array($getImgsExtras)){

				?>
				<li><a href="<?php echo 'http://receitinhasdavovo.com/images/receitas_imagens_adicionais/'.$imgs['nome'];?>" data-title="<?php echo utf8_encode($row->nome); ?>" data-lightbox="roadtrip"><img src="<?php echo 'http://i1.wp.com/receitinhasdavovo.com/images/receitas_imagens_adicionais/'.$imgs['nome']?>?resize=86,70&quality=90"><span class="lup"></span></a></li>
				<?php } endif; ?>				 
			</ul> 
			<div class="adsfloat ads_topmb" style="width:100%; height:auto; margin-top:10px;">
				
			</div>
			<div class="clear"></div>

			<div style="color:#666; font-size:1.3em; text-align:center; margin:8px 0 0 0; border:1px solid #ccc; border-radius:3px; padding:3px 2px;">clique para ampliar as imagens</div>
		</div><!--/inforec-img-->
		

		<div class="infos_view_post">
			<ul class="list_view_pst">
				<li>
					<i></i>
					<span><a href="#">Imprimir</a></span>
				</li>

				<li>
					<i></i>
					<span>Compartilhar</span>
				</li>

				<li>
					<i></i>
					<span>Enviar Fotos</span>
				</li>
			</ul>
		</div>

		<div class="infos_view_post">
			<ul class="list_view_pst">
				<li>
					<i></i>
					<span>Favoritos</span>
				</li>

				<li>
					<i></i>
					<span>Avaliações</span>
				</li>

				<li>
					<i></i>
					<span><a href="#">Adicionar ao Meu Livro</a></span>
				</li>
			</ul>
		</div>
	
	
	<div class="clear"></div> <br>
	
	
<div class="ladoesquerdo">

			<div class="bannerResponsivo600">
				<?php include "include/adsResponsivo.php";?>
			</div>
			
		<div class="ingredientesss">
			<h3 class="titleg-2">Modo de Preparo:</h3>
			<div class="line">
				<div class="set-down"></div>
			</div>
				
	 
			<?php 					
				echo utf8_encode(nl2br($row->modopreparo));
			?>
			
			
			<div class="banner336ads">
				<?php include "include/ads-336-280.php";?>
			</div>
		</div>
			
				
			
			<div class="clear"></div>	
					
				<div class="mododepreparo">	
					<h3 class="titleg-2">Ingredientes:</h3>
					<div class="line">
						<div class="set-down"></div>
					</div>
					
					<?php 
						
						echo utf8_encode(nl2br($row->ingrediente));
					?>
					<div class="banner336adsinferior">
						<?php include "include/ads-336-280.php";?>
					</div>
					<?php
						$qrvideo = mysql_query("SELECT * FROM video WHERE id_post='$row->id' AND todos_sites=1");
						while($row = mysql_fetch_array($qrvideo)){
							$link 		= utf8_encode($row['link']);
						}
						
						if(mysql_num_rows($qrvideo) > 0){
							$link = explode('v=',$link);
							$idtube = $link[1];
							
							echo '<div class="clear"></div>';
							echo '<br /><br /><br /><strong>VISUALIZE PASSO A PASSO DESSA RECEITA EM VÍDEO:</strong><br /><br />
							<br /><iframe width="420" height="315" src="//www.youtube.com/embed/'.$idtube.'" frameborder="0" allowfullscreen></iframe>';
						}
					?>
				</div>
	
	 

	<div class="clear"></div>
		
	<div style="margin:25px 10px 10px 10px;">
	<h4>COMPARTILHAR ESSA RECEITA <div class="whatsapp">NO WHATSAPP E </div>NO FACEBOOK</h4><br />
		<div class="whatsapp">
			<a href="whatsapp://send?text=<?php echo urlencode(utf8_encode($row->nome).' | Veja a receita: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'].'?whatsapp'); ?>" data-action="share/whatsapp/share"><img style="max-width: 220px; margin:0 auto; border-radius: 8px;" src="<?php echo ROOT.'/';?>img/share-whatsapp2.png" alt=""></a>
		</div>
		<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(utf8_encode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'].'?facebookshare')); ?>" data-action="share/whatsapp/share"><img style="max-width: 220px; margin:0 auto; border-radius: 8px;" src="<?php echo ROOT.'/';?>img/facebookshare.png" alt=""></a>
	</div>
		
	<?php
		$rsPontuacao = mysql_query("SELECT * FROM pontuacao WHERE id_receita = '$id'");
		while($rowPontuacao = mysql_fetch_array($rsPontuacao)){
			$contagemPontuacao += $rowPontuacao['pontos'];
			$votos++;
		}
		$media = ( !empty($contagemPontuacao) ) ? ceil($contagemPontuacao/$votos) : '';
	?>
	
	<p><br />Avalie essa receita:</p>
	<form style="display:none" title="Average Rating: <?php echo $media; //qtd valor medio votado ?>" class="rating" action="<?php echo ROOT.'/';?>rate.php">
		<input type="hidden" name="valor" value="1" />
		<input type="hidden" name="id_receita" id="id_receita" value="<?php echo $id;?>" />
		<input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['receitas_user_id'];?>" />
		<select id="r1">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
	</form>
	
	<?php
	if($votos == 0 OR $_SESSION['receitas_user_id'] == 0){
		$classe="votacaonaoexibir";
	}else{
		$classe="votacao";
	}
		echo "<div class='".$classe."' style='display:none;'>";
			echo "<br>Total de pessoas que votaram <strong>".$votos."</strong>";
			echo "<br>Media: <strong>".$media."</strong>";
		echo "</div>";
	?>
	
	<div class="alert" style="color:red;"></div>
					
</div>
 
	
<!--
<div class="ladodireito" style="float:right !important;"></div> 
-->
 



	<div class="right-rec">
	
	<div class="titleg">Últimas receitas</div>
		<div class="line last_rec">
			<div class="set-down last_rec"></div>
		</div>

	 <div class="clear"></div>

	<ul class="list-destaques">
		  
			<?php
				$sqlDestaques = mysql_query("SELECT * FROM receita WHERE categoria != 20 AND categoria != 19 AND categoria != 3 AND categoria != 15 AND categoria != 18 ORDER BY id DESC LIMIT 5");
				
				while($rDest = mysql_fetch_object($sqlDestaques)){
				
				$cat  = mysql_query("SELECT * FROM categoria WHERE id = '$rDest->categoria'");
				$scat = mysql_query("SELECT * FROM subcategoria WHERE id = '$rDest->subcategoria'");
				
				$rowCat = mysql_fetch_object($cat);
			?>
				<li>
					<a href="<?php echo ROOT.'/';?>receitas/<?php echo utf8_encode(remAcentos($rowCat->nome)).'/'.utf8_encode(remAcentos($rDest->nome)).'-'.$rDest->id.'.html'; ?>" title="<?php echo utf8_encode($rDest->nome);?>">
						<img src="http://i1.wp.com/www.receitinhasdavovo.com/images/receitas/<?php echo $rDest->image;?>?resize=150,120&quality=80" alt="Image <?php echo utf8_encode($rDest->nome);?>" />
						<div class="title-dest"><?php echo utf8_encode(limite($rDest->nome, 30));?></div>
						<!--<div class="by-dest">por Romário zika</div>-->
					</a>
				</li>

			<?php
				}
			?>
	</ul>
			
	
	</div>
	

	 

	<div class="clear"></div>


	<div class="clear"></div>

	<div style="background:#eee; padding:10px;">
		<?php 
			$id = (int)$id;

			$getPost = mysql_query("SELECT * FROM receita WHERE id = '$id' ") or die (mysql_error());
			$rowRec = mysql_fetch_object($getPost);

			if($rowRec->postado_por_user){
				$id_por_user = $rowRec->postado_por_user;
				$getUser = mysql_query("SELECT * FROM tb_usuario WHERE id = '$id_por_user'") or die(mysql_error());
				$rowPostPor = mysql_fetch_array($getUser);
		?>
			<div style="background:#fff; width:45px; height:45px; float:left; margin-right:10px;" class="foto-user">
				<img src="<?php echo ROOT.'/'; ?>images/usuarios/user_avatar.png" alt=""  width="100%">
			</div>
			
			<div style="font-size:1.3em; color:#555; margin-top:3px;">Enviada por</div>
			<div style="font-size:1.7em; color:#d00;"><?php echo $rowPostPor['nome']; ?></div>
		
		<?php }else{ ?>
			<div style="background:#fff; width:45px; height:45px; float:left; margin-right:10px;" class="foto-user">
				<img src="<?php echo ROOT.'/'; ?>images/usuarios/user_avatar.png" alt="" width="100%">
			</div>
			
			<div style="font-size:1.3em; color:#555; margin-top:3px;">Enviada por</div>
			<div style="font-size:1.7em; color:#d00;">Romário Santos</div>
		<?php } ?>
		
		<div class="clear"></div>
	</div>

	

	

	<!--<iframe src="//www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/pages/As-Melhores-Receitas/375571822525083?ref=hl&group_id=0&amp;width=292&amp;height=342&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%2323CCC&amp;stream=false&amp;header=false" style="background-color: transparent; border:none; overflow:hidden; width:220px; height:342px; margin-top:30px; " ></iframe>-->

	<!--<div class="inf-enviado">
		<img src="<?php //echo ROOT.'/'; ?>img/rec1.jpg" alt=""/>
		<div class="env-by">Veja quem gostou da receita</div>
		<a href="#">MF</a>
		
		
	</div>-->
	
	<div class="clear"></div>
	<div style="font-size:1.8em; margin:10px 0 15px 0;">
	<p><strong>SE INSCREVA EM NOSSO CANAL DO YOUTUBE E RECEBA NOSSOS VÍDEOS:</strong></p>
		<iframe src="https://www.youtube.com/subscribe_widget?p=maysupergata" style="overflow: hidden; margin-top:10px; height: 72px; width: 100%; border: 0;" scrolling="no" frameborder="0"></iframe>
	</div>
		
		 
</div>

	
<?php include_once('include/footer.php');?>