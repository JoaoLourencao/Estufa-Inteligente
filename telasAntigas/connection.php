<?php 
	
	/*protege contra sql injection*/
	function DBescape($dados){
		$link = DBconnect();

		if(!is_array($dados))
		$dados = mysqli_real_escape_string($link, $dados);
		else{
			$arr = $dados;

			foreach ($arr as $key => $value) {
				$key = mysqli_real_escape_string($link, $key);
				$value = mysqli_real_escape_string($link, $value);

				$dados[$key] = $value; 
			}
		}

		DBclose($link);
		return $dados;
	}


	/*fecha conexao*/
	function DBclose($link){
		@mysqli_close($link) or die(mysqli_error($link));
	}


	
	/*abre conexao com mysql*/

	function DBconnect(){
		$link = @mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error()); 
		mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));

		return $link;
	}
