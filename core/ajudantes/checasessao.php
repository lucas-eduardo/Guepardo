<?php

	function checasessao( $ajax=null, $caminho ){

		if( !isset( $_SESSION[ hash("sha512", SESSAOAPP )] ) && $ajax=='requisicaoajax' ){

			echo 'logout';

			exit();

		}else if( !isset( $_SESSION[ hash("sha512", SESSAOAPP )] ) ){

			header( "Location: ".$caminho );

		}

	}

?>