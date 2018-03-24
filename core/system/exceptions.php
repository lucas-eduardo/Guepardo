<?php

	/*
	* Classe de manipulação de excessoes
	*/
	class GU_Exceptions
	{

		/*
		* Grava os logs de erros
		*/
		public function gravalogErro( $errno, $errstr, $errfile, $errline )
		{

			$stringerro= "Nivel do erro ( $errno ) - $errstr em $errfile na linha $errline\n";
			
			// Caminho dos logs
			$caminho= APP_PATCH.'logserro';
			
			if( $errno!=8 ){
				
				// Grava o log de erro
				if( !is_dir($caminho) ){
					
					mkdir($caminho, 0777);
				
				}

				$fp = fopen($caminho."/".time().".txt", "w");

				$escreve = fwrite($fp, date('d/m/Y H:i:s').PHP_EOL.$_SERVER['HTTP_REFERER'].PHP_EOL."$errno".PHP_EOL.$stringerro.PHP_EOL );

				fclose($fp);
			
			}
			
			// Se retornar TRUE não faz o tratamento padrão do erro no PHP
			return TRUE;

		}

	}

?>