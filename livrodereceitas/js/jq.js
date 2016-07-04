$(function(){
	
	var j_click = $('.j_click'), modal = $('.modal'), bgmod = $('.bgmod'), j_html = $('.j_html');
 
	var root = j_click.attr('data-root');
	
	var formlog = '<h1 class="title-cl">Acessar Conta</h1><form action="'+root+'act_cl.php" method="post"><input type="hidden" name="act" value="clog"/> <input type="text" name="email" placeholder="seuemail@provedor.com" class="inpmod" /> <input type="password" name="senha" placeholder="senha" class="inpmod" /><input type="submit" value="ENTRAR" class="btlc"/></form> <br /> <a href="#" >Esqueceu a senha?</a>';
	
	var formcad = '<h1 class="title-cl">Criar conta (Grátis)</h1><form action="'+root+'act_cl.php" method="post"> <input type="hidden" name="act" value="cconta"/><input type="text" name="nome" placeholder="seu nome completo" class="inpmod" /> <input type="text" name="email" placeholder="seuemail@provedor.com" class="inpmod" /> <input type="password" name="senha" placeholder="crie uma senha" class="inpmod" /><input type="password" name="senha2" placeholder="repita a senha" class="inpmod" /><input type="submit" value="FINALIZAR CADASTRO" class="btlc"/></form> <br /> <span style="color:#666; ">Envie suas receitas para o site e compartilhe com milhares de pessoas.</span>';
	
	$('body').on('click', '.j_click', function(){
		
		var data_click = $(this).attr('data-click');
		
		if(data_click == 'login'){
			modal.fadeIn(300);
			j_html.html(formlog);
			bgmod.fadeIn(200);
		}else if(data_click == 'cadastro'){
			modal.fadeIn(300);
			j_html.html(formcad);
			bgmod.fadeIn(200);
		}
		
		return false;
	});
	
	var j_close_md = $('.j_close_md');
	
	j_close_md.click(function(){
		modal.hide();
		bgmod.hide();
		return false;
	});

	
	modal.click(function(e){
		e.stopPropagation();
	});
	
	$('body, html').click(function(){
		modal.hide();
		bgmod.hide();
	});	
	
	
	var form_busca = $('#busca'), 
		inp_busca  = $('#s'),
		fly_busca  = $('.fly-out-busca');
	
	inp_busca.focus(function(){
		fly_busca.fadeIn(300).text('Encontre receitas');
		
		var termo   = $.trim( $(this).val() ),
			groot   = $(this).attr("data-root"),
			gurl    = groot+'buscar.php',
			gdata   = {'acao' : 'buscar', termo : termo, groot : groot},
			loading = 'Carregando...';
			
		if(inp_busca != '' && inp_busca.length){
			$.ajax({
				type: 'GET',
				url : gurl,
				data: gdata,
				dataType: 'json',
				beforeSend: function(){
					fly_busca.html(loading).fadeIn("fast");
				},
				success: function(r){
					if(r.retorno_busca != null && termo != '')
						fly_busca.html('<strong>Receitas</strong>'+r.retorno_busca);

					if(r.retorno_busca == 1)
						fly_busca.fadeIn(300).html('Nenhum resultado encontrado...');
						 
				
					if(r.retorno_busca == 2)
						fly_busca.html('Digite algum termo'); 
				} 
			});
		}
	}).blur(function(){
		fly_busca.fadeOut(300);
	});
	
	inp_busca.keyup(function(){
		var termo   = $.trim( $(this).val() ),
			groot   = $(this).attr("data-root"),
			gurl    = groot+'buscar.php',
			gdata   = {'acao' : 'buscar', termo : termo, groot : groot},
			loading = 'Carregando...';
		
		if(termo.length >= 3){
			$.ajax({
				type: 'GET',
				url : gurl,
				data: gdata,
				dataType: 'json',
				beforeSend: function(){
					fly_busca.html(loading).fadeIn("fast");
				},
				success: function(r){
					if(r.retorno_busca != null && termo != '')
						fly_busca.html('<strong>Receitas</strong>'+r.retorno_busca);

					if(r.retorno_busca == 1)
						fly_busca.fadeIn(300).html('Nenhum resultado encontrado...');
						 
				
					if(r.retorno_busca == 2)
						fly_busca.html('Digite algum termo'); 
				} 
			});
		}   
	});
	
	$('.fly-out-busca').on('click', '.j_vermais', function(){
		var termo   = $.trim( $(this).attr("data-termo") ),
			offset  = $(this).attr('data-offset'),
			limit   = offset * 2,
			groot   = $(this).attr("data-root"),
			gurl    = groot+'buscar.php',
			gdata   = {'acao' : 'buscalimt', offset : offset, limit : limit, termo : termo, groot : groot },
			loading = 'Carregando...';
		
		$.ajax({
			type: 'GET',
			url : gurl,
			data: gdata,
			dataType: 'json',
			beforeSend: function(){
				fly_busca.html(loading).fadeIn("fast");
			},
			success: function(r){
				if(r.retorno_busca != null && termo != '')
					fly_busca.append(r.retorno_busca);

				if(r.retorno_busca == 1)
					fly_busca.fadeIn(300).html('Nenhum resultado encontrado...');
				
				if(r.retorno_busca == 2)
					fly_busca.html('Digite algum termo'); 
			} 
		});
		
		//alert('Offset: '+offset+' LImit: '+limit);
	});
	
	
	fly_busca.click(function(){
		event.stopPropagation();
	});
	
	
});