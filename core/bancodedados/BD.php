<?php

	function &BD(){


		if ( ! file_exists( APP_PATCH.'config/bancodedados.php') ){

			exit( 'O arquivo de configuracao do banco bancodedados.php nao existe!' );

		}


		include( APP_PATCH.'config/bancodedados.php' );

		require_once( PATCH_SYSTEM.'bancodedados/PDO.php');

		$BD= new GU_PDO;

		$BD->prefixo_tb= $bd['prefixo'];//Define o prefixo das tabelas
		
		$BD->conectar( $bd['driver'], $bd['host'], $bd['banco'], $bd['usuario'], $bd['senha'] );

		return $BD;

	}

?>