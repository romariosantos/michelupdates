<?php
	header('Content-Type: text/html; charset=utf-8');
	
	$nomesite = "Livro de Receita";
	$subnome  = "O jeito mais fácil de cozinhar - Diversas receitas para fazer";
	
	$urloriginal = '/'.basename($_SERVER['SCRIPT_NAME']);


	if($urloriginal == '/index.php'){
			echo "<title>".$nomesite." - ".$subnome."</title>\n";
			echo "<meta name='description' content='".$nomesite.", encontre receitas de bolo, tortas, biscoitos, molhos, sanduiches'>\n";
	}elseif($urloriginal == '/catalago.php'){
	
		if(empty($_GET['pg'])){
			echo "<title>Catálago - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Veja o catálago completo do ".$nomesite."'>\n";
		}else{
			echo "<title>Catálago - Página ".$_GET['pg']." - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Veja o catálago página completo ".$_GET['pg']." do ".$nomesite." na página ".$_GET['pg']."'>\n";
		}
		
	}elseif($urloriginal == '/contato.php'){
			//include('include/conexao.php');
			echo "<title>Contato - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Entre em contato com o ".$nomesite."'>\n";
	}elseif($urloriginal == '/livro.php'){
			//include('include/conexao.php');
			echo "<title>O Meu Livro de Receitas - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Acesse o livro de receitas'>\n";
	}elseif($urloriginal == '/medidas.php'){
			//include('include/conexao.php');
			echo "<title>Medidas - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Veja todas as medidas das receitas'>\n";
	}elseif($urloriginal == '/act_cl.php'){
			//include('include/conexao.php');
			echo "<title>Cadastro de Usuario - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Cadastro de Usuario'>\n";
	}elseif($urloriginal == '/meu-livro/home.php'){
			echo "<title>Meu Livro de Receitas - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Meu Livro de Receitas'>\n";
	}elseif($urloriginal == '/categorias.php'){
			//include_once('include/conexao.php');
			
			$id = $_GET['idc'];
			$ex = explode('-', $id);
			$id = array_pop($ex);

			$id = ( is_numeric($id)  ? $id : replace_str($id) ) ;
			
			$permalink_categoria = $_GET['idc']; //substr($_GET['idc'], 0, -2); 
			
			$sqlcat = mysql_query("SELECT * FROM categoria WHERE id = '$id'") or die(mysql_error());
			$rowcat = mysql_fetch_object($sqlcat);
	
		if(empty($_GET['pg'])){
			echo "<title>".utf8_encode($rowcat->nome)." - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Veja receitas de ".utf8_encode($rowcat->nome)."'>\n";
		}else{
			echo "<title>".utf8_encode($rowcat->nome)." - Página ".$_GET['pg']." - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Veja receitas de ".utf8_encode($rowcat->nome)." - Página ".$_GET['pg']."'>\n";
		}
		
	}elseif($urloriginal == '/subcategorias.php'){	
		//include_once('include/conexao.php');
		
		$exc = explode('-', $_GET['idc']);
		$idc = array_pop($exc);
		$idc = ( is_numeric($idc)  ? $idc : replace_str($idc) ) ;
		
		$exs = explode('-', $_GET['ids']);
		$ids = array_pop($exs);
		$ids = ( is_numeric($ids)  ? $ids : replace_str($ids) ) ;
		
		$sqlcat = mysql_query("SELECT * FROM categoria WHERE id = '$idc' ") or die(mysql_error());
		$rowcat = mysql_fetch_object($sqlcat);
		
		$sqlscat = mysql_query("SELECT * FROM subcategoria WHERE id = '$ids' ") or die(mysql_error());
		$rowscat = mysql_fetch_object($sqlscat);
		
		
		$permalink_categoria = $_GET['idc'].'/'.$_GET['ids']; //substr($_GET['idc'], 0, -2); 

		if(empty($_GET['pg'])){
			echo "<title>".utf8_encode($rowscat->nome." - ".$nomesite)."</title>\n";
			echo "<meta name='description' content='Veja receitas de ".utf8_encode($rowscat->nome)."'>\n";
		}else{
			echo "<title>".utf8_encode($rowscat->nome)." - Página ".$_GET['pg']." - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Veja receitas de ".utf8_encode($rowscat->nome)." - Página ".$_GET['pg']."'>\n";
		}
			
	}elseif($urloriginal == '/busca.php'){
		//include_once('include/conexao.php');
			
			$id = $_GET['idc'];
			$ex = explode('-', $id);
			$id = array_pop($ex);

			$id = ( is_numeric($id)  ? $id : replace_str($id) ) ;
			
			$permalink_categoria = $_GET['idc']; //substr($_GET['idc'], 0, -2); 
			
			$sqlcat = mysql_query("SELECT * FROM categoria WHERE id = '$id'") or die(mysql_error());
			$rowcat = mysql_fetch_object($sqlcat);
			
			echo "<title>".$_GET['s']." - ".$nomesite."</title>\n";
			echo "<meta name='description' content='Veja receitas de ".$_GET['s']."'>\n";
	}elseif($urloriginal == '/contato.php'){
		//include_once('include/conexao.php');
		echo "<title>Contato - ".$nomesite."</title>\n";
		echo "<meta name='description' content='Entre em contato conosco ".$nomesite."'>\n";
	}elseif($urloriginal == '/ver-receita.php'){	
				//include_once('include/conexao.php');
				include_once('include/funcoes.php');
				
				$id = $_GET['id'];
				$ex = explode('-', $id);
				$id = array_pop($ex);

				$id = ( is_numeric($id)  ? $id : replace_str($id) ) ;
				
				$sqlReceita = mysql_query("SELECT * FROM receita WHERE id = '$id' ") or die(mysql_error());
				$row = mysql_fetch_object($sqlReceita);
				
				$sqlcat = mysql_query("SELECT * FROM categoria WHERE id = '$row->categoria' ") or die(mysql_error());
				$rowcat = mysql_fetch_object($sqlcat);
				$nomeReceita = utf8_encode($row->nome);
					
					if($row->categoria == 20 OR $row->categoria == 15 OR $row->categoria == 19 OR $row->categoria == 18){
						echo "<title>".$nomeReceita." - ".$nomesite."</title>\n";
					}else{
						if (preg_match("/receita/is",$nomeReceita)) {
							echo "<title>".$nomeReceita." - ".$nomesite."</title>\n";
						}else{
							echo "<title>Receita de ".$nomeReceita." - ".$nomesite."</title>\n";
							echo "	<meta property='og:title' content='Veja a receita: ".$nomeReceita."' />\n";
						}
					}
			
			if($row->categoria == 20 OR $row->categoria == 15 OR $row->categoria == 19 OR $row->categoria == 18){
					echo "	<meta name='description' content='Faça ".$nomeReceita."'>\n";
			}elseif($row->descricao != NULL){
					//echo "	<meta name='description' content='".utf8_encode($row->descricao)." | Receita de ".$nomeReceita."'>\n";
					echo "	<meta name='description' content='".utf8_encode(metaDescription(strip_tags($row->modopreparo),100))."'>\n";
			}else{
					echo "	<meta name='description' content='".utf8_encode(metaDescription(strip_tags($row->modopreparo),100))."'>\n";
			}		
					if($row->id > 1000){
						$imagem_diretorio = "receitasfull";
					}else{
						$imagem_diretorio = "receitas";
					}
					echo '	<meta property="og:image" content="http://www.receitinhasdavovo.com/images/'.$imagem_diretorio.'/'.$row->image.'"/>';
	}
?>