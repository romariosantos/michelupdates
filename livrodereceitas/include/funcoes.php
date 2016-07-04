<?php
function removeInjection($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql);
		   if(!is_null($sql)) {
			$sql = trim($sql);
		   }
	   $sql = strip_tags($sql);
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql);
	   return $sql;
	}

function getCurlNotTimeOut($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $store = curl_exec($ch);
    return $store;
}

function metaDescription($texto, $tamanho){
	 $texto = strip_tags($texto);
	 $tamanho = $tamanho;
	 $corte = substr($texto, 0,$tamanho);
	 
	 $final = strrpos($corte, ' '); 
	 $meta = substr($corte, 0,$final);
	 $meta = str_replace("\n", ". ", $meta);
	 
	 $contagem = strlen($texto);
	 
	 if($contagem > $tamanho){
		return $meta.' ...';
	 }else{
		return $meta;
	 }
	 
}

function removeCaracteresAcentos($texto){
	$novo = preg_replace('/[^a-z0-9_ ]/i', '', $texto);
	$novo = str_replace('(','',$novo);
	$novo = str_replace(')','',$novo);
	return $novo;
}


?>