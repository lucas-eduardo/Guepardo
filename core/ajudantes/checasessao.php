<?php

	// Função que verifica a sessão
	function checasessao( $ajax=false, $caminho )
	{

		if( !isset( $_SESSION[ hash("sha512", SESSAOAPP )] ) && $ajax ){ // Se a sessão foi destruida e for via ajax...

			echo 'logout';

			exit();

		}else if( !isset( $_SESSION[ hash("sha512", SESSAOAPP )] ) ){ // Se a sessão foi destruida...

			header( "Location: ".$caminho );

		}

	}

?>