<?php 
	mysql_connect("localhost","root","");
	mysql_select_db("michel_livroreceitas");
	
	//remove acentos
	function remAcentos( $sub ){
    $acentos = array(
        'À','Á','Ã','Â', 'à','á','ã','â',
        'Ê', 'É',
        'Í', 'í', 
        'Ó','Õ','Ô', 'ó', 'õ', 'ô',
        'Ú','Ü',
        'Ç', 'ç',
        'é','ê', 
        'ú','ü',
        );
    $remove_acentos = array(
        'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
        'e', 'e',
        'i', 'i',
        'o', 'o','o', 'o', 'o','o',
        'u', 'u',
        'c', 'c',
        'e', 'e',
        'u', 'u',
        );
    $res = str_replace($acentos, $remove_acentos, urldecode(trim($sub)));
	//$res = str_replace(' ', '-', $res);
	
	$caracteres = array(' ', ':', '#', '@', '?', '!', '*', '%', '$', '(', ')', '{', '}', '+');
	
	$remove_caracteres = array('-', '', '', '', '', '', '', '', '', '', '', '', '', '');
	
	$res = str_replace($caracteres, $remove_caracteres, trim($res) );
	
	$res = str_replace(',','',$res);
	
	$res = str_replace('®','',$res);
	
	
	return strtolower($res);
	} 
	
	//limita texto
	function limite($str, $qtdlimit, $limpar = true){
		$limitar = $qtdlimit;
		if($limpar == true){ $str = strip_tags($str); }
		
		if(strlen($str) <= $limitar){ return $str; }

		$limitar_str 	   = substr($str, 0, $limitar);
		$ultima_ocorrencia = strrpos($limitar_str, ' ');
		return substr($str, 0, $ultima_ocorrencia);
	}
	
	
	//remove letas e simbolos
	function replace_str($strid){
		$str = preg_replace("/[^0-9\s]/", "", $strid);
		return $str;
	}
	
	//remove simbolos
	function replace_sim($strid){
		$str = preg_replace("/[^a-zA-Z0-9\s]/", " ", $strid);
		return $str;
	}
	
	//Insere conteudo no meio
	function func_insert($texto, $quantia, $insert=""){
		$open_tags = 0;
		$close_tags = 0;

		$sub_1 = substr($texto, 0, $quantia);

		$open_tags = substr_count($sub_1,'<');
		$close_tags = substr_count($sub_1,'>');

		if($open_tags <= $close_tags){
		if(!empty($insert)){
		return $sub_1  . $insert . substr($texto,$quantia);
		}else{
		return $sub_1;
		}
		}else{
		$p_2 = strpos($texto, '>', $quantia);
		$sub_2 = substr($texto,0,$p_2 +1);
		if(!empty($insert)){
		return $sub_2 . $insert . substr($texto, $p_2+1);
		}else{
		return $sub_2;
		}
		}
	}
	
	//pega endereço raiz
	$root = dirname( $_SERVER["PHP_SELF"] ) == DIRECTORY_SEPARATOR ? "" : dirname( $_SERVER["PHP_SELF"] );
	define( "ROOT", $root );
?>