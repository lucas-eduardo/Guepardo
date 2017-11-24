<?php

	function checasessao( $ajax=false, $caminho ){

		if( !isset( $_SESSION[ hash("sha512", SESSAOAPP )] ) && $ajax ){

			echo 'logout';

			exit();

		}else if( !isset( $_SESSION[ hash("sha512", SESSAOAPP )] ) ){

			header( "Location: ".$caminho );

		}

	}

?>