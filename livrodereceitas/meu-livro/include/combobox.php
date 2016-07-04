<?php

$target = $_GET['target'];
$val 	= $_GET['val'];

if($target == 'subcategoria')
{
		include "../../include/conexao.php";
		
		$sql = mysql_query("SELECT * FROM subcategoria WHERE id_cat='$val' ORDER BY nome ASC");
			while($row = mysql_fetch_array($sql)){
				echo "<option value='".$row['id']."'>".utf8_encode($row['nome'])."</option>";
		}

}

?>