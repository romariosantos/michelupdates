<div class="left_mlivro">
	<div class="pdd_siberbar">
		<div class="foto_user">
		<a href="meus_dados.php">
		<?php
			if($miniatura != NULL){
				echo '<img src="http://www.receitinhasdavovo.com/images/avatar/'.$miniatura.'" alt="" />';
			}else{
		?>
			<img src="img/thumb.jpg" alt="" />
		<?php
			}
		?>
		</div> <!-- /foto_user -->

		<div class="name_user"><?php echo $nomeUsuario; ?></a> <i class="down_nv nav_tg_cl"> </i> </div>



		<div class="clear"></div>
		
		<?php
			
			$urlnavi = $_SERVER['SCRIPT_NAME'];
			//print_r($_SERVER);
		?>

		<ul class="nav_" >
			<li><a href="home.php" <?php if($urlnavi == '/meu-livro/home.php' OR $urlnavi == '/meu-livro/resultado_busca.php'){ echo 'class="atv_nav_"';}?>><i class="ic ic_love"></i> Meu Livro de Receitas</a></li>
			<li><a href="enviar_receita.php" <?php if($urlnavi == '/meu-livro/enviar_receita.php'){ echo 'class="atv_nav_"';}?>><i class="ic ic_send"></i> Envie uma Receita</a></li>
			<li><a href="fotos_enviadas_de_receitas.php"><i class="ic ic_album"></i> Fotos enviadas de receitas</a></li>
			<li><a href="minhas_receitas_enviadas.php"><i class="ic ic_myrec"></i> Minhas receitas enviadas</a></li>
			<li><a href="receitas_aguardando_aprovacao.php" <?php if($urlnavi == '/meu-livro/receitas_aguardando_aprovacao.php'){ echo 'class="atv_nav_"';}?>><i class="ic ic_agud"></i> Receitas Aguardando aprovação</a></li>
			<li><a href="fotos_aguardando_aprovacao.php"><i class="ic ic_phots_ag"></i> Fotos Aguardando Aprovação</a></li> 
			<li><a href="receitas_avaliadas.php"><i class="ic ic_starts"></i> Receitas Avaliadas</a></li> 
			<li><a href="meus_dados.php" <?php if($urlnavi == '/meu-livro/meus_dados.php'){ echo 'class="atv_nav_"';}?>><i class="ic ic_config"></i> Meus dados</a></li>
		</ul>

		<ul class="nav_" style="display:none;">
			<li><a href="#"><i class="ic ic_ganhos"></i> Meus Ganhos</a></li> 
			<li><a href="#"><i class="ic ic_ganhos"></i> Solicitar Saque</a></li> 
		</ul>

	</div> <!-- /pdd_siberbar -->
</div> <!-- /left_mlivro -->