<?php 
	include_once('include/conexao.php');
	
	if(isset($_GET['acao']) and $_GET['acao'] == 'buscar'){
		$termo = strip_tags(trim(addslashes($_GET['termo'])));
		$termo =  replace_sim($termo);
		//$termo = utf8_encode($termo);
		
		$root  = $_GET['groot'];
		
		$resposta = array();
	 
		if(!empty($termo)){
			 $sql = mysql_query("SELECT * FROM receita WHERE nome LIKE '%$termo%'  ORDER BY nome ASC LIMIT 6") or die(mysql_error());
			 
			if(mysql_num_rows($sql) > 0 ){
  
				$res = '';

				while($row = mysql_fetch_object($sql)){
					
					$sqlcat = mysql_query("SELECT * FROM categoria WHERE id = '$row->categoria' ") or die(mysql_error());
					$rowcat = mysql_fetch_object($sqlcat);
			 
					$res .= '<li><a href="'.ROOT.'/receitas/'.utf8_encode(remAcentos($rowcat->nome)).'/'.utf8_encode(remAcentos($row->nome)).'-'.$row->id.'.html">';
						$res .= '<img src="http://i1.wp.com/www.receitinhasdavovo.com/images/receitas/'.$row->image.'?resize=50,50&&quality=65" title="'.utf8_encode($row->nome).'" alt="'.utf8_encode($row->nome).'"/>';
						$res .= '<div class="title-busca">'.utf8_encode($row->nome).'</div>';
						$res .= '</a>';
					$res .= '</li>';  
				}
				
				if( mysql_num_rows($sql) > 5 ){
					$res .= '<li><a class="j_vermais" data-offset="'.mysql_num_rows($sql).'" data-root="'.ROOT.'" data-termo="'.$termo.'"><img src="'.ROOT.'/img/ver_mais.jpg" style="width:170px; height:50px; float:right; margin-right:100px"></a></li>';
				}

				$resposta['retorno_busca'] = $res;

				echo json_encode($resposta);
			}else{
				echo json_encode(array("retorno_busca" => 1)); // numero 1 
			} 
		}else{
			    echo json_encode(array("retorno_busca" => 2)); // numero 2 
		} 
	}
	
	
	
	if(isset($_GET['acao']) and $_GET['acao'] == 'buscalimt'){
		$termo  = strip_tags(trim(addslashes($_GET['termo'])));
		$termo  =  replace_sim($termo);
		$offset = (int)$_GET['offset'];
		$limit  = (int)$_GET['limit'];
		
		
		$root  = $_GET['groot'];
		
		$resposta = array();
		
		if(!empty($termo) and !empty($offset) and !empty($limit)){
			$sql = mysql_query("SELECT * FROM receita WHERE nome LIKE '%$termo%'  ORDER BY nome ASC LIMIT $offset, $limit") or die(mysql_error());
			 
			if(mysql_num_rows($sql) > 0 ){
				$res = '';
				while($row = mysql_fetch_object($sql)){
					$sqlcat = mysql_query("SELECT * FROM categoria WHERE id = '$row->categoria' ") or die(mysql_error());
					$rowcat = mysql_fetch_object($sqlcat);
			 
					$res .= '<li><a href="'.ROOT.'/receitas/'.remAcentos(utf8_encode($rowcat->nome)).'/'.remAcentos(utf8_encode($row->nome)).'-'.$row->id.'.html">';
						$res .= '<img src="http://i1.wp.com/www.receitinhasdavovo.com/images/receitas/'.$row->image.'?resize=50,50" title="'.utf8_encode($row->nome).'" alt="'.utf8_encode($row->nome).'"/>';
						$res .= '<div class="title-busca">'.utf8_encode($row->nome).'</div>';
						$res .= '</a>';
					$res .= '</li>'; 
				}
				
				if(mysql_num_rows($sql) > 5 ){
					$res .= '<li><a class="j_vermais" data-offset="'.mysql_num_rows($sql).'" data-root="'.ROOT.'" data-termo="'.$termo.'"><img src="'.ROOT.'/img/ver_mais.jpg" style="width:170px; height:50px; float:right; margin-right:100px"></a></li>';
				}
				$resposta['retorno_busca'] = $res;
				echo json_encode($resposta);
			}else{
				echo json_encode(array("retorno_busca" => 1)); // numero 1 
			}
		}else{
			    echo json_encode(array("retorno_busca" => 2)); // numero 2 
		}
	}
	
?>