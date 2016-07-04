<?php 
	class Logar{ 

		static public function login($email, $senha){
			$senha = md5($senha); 
			//login
			$sql = mysql_query("SELECT * FROM tb_usuario WHERE email = '$email' and senha = '$senha' ") or die(mysql_error());
			if(mysql_num_rows($sql) == 1):
				$dados = mysql_fetch_object($sql);
				$id   = $dados->id;
				$nome = $dados->nome;
				
				if(!isset($_SESSION)){
					@session_start();
				}
				
				$_SESSION['receitas_user_logado'] = 1;
				$_SESSION['receitas_user_id'] 	  = $id;
				
				//echo '<script> window.location.href="'.ROOT.'/usuario/'.remAcentos($nome).'-'.$id.'"; </script>';
				return TRUE;
				
			else:
				//echo 'Verifique seu e-mail e/ou senha.';
				return FALSE;
			endif;
		}	
		
	}
?>