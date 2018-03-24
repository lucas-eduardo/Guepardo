<?php

	function &BD()
	{


		if( !file_exists( APP_PATCH.'config/bancodedados.php') ){ // Se o arquivo bancodedados.php não existir dentro do config do app...

			exit( 'O arquivo de configuracao do banco bancodedados.php nao existe!' );

		}

		// Inclue o arquivo
		include( APP_PATCH.'config/bancodedados.php' );

		// Insere a classe PDO
		require_once( PATCH_SYSTEM.'bancodedados/PDO.php');

		// Instancia a classe do PDO
		$BD= new GU_PDO;

		//Define o prefixo das tabelas
		$BD->prefixo_tb= $bd['prefixo'];
		
		// Realiza a conexão com o banco de dados
		$BD->conectar( $bd['driver'], $bd['host'], $bd['banco'], $bd['usuario'], $bd['senha'] );

		return $BD;

	}

?>