<?php

	// Cria um Cookie
	function criacookie( $nome, $valor, $duracao=null )
	{

		$duracao= (  is_null( $duracao ) )? ( time() + ( 120 * 24 * 3600 ) ) : $duracao;
		setcookie( $nome, $valor,$duracao,"/" );

	}


	// Apaga um Cookie
	function apagacookie( $nome )
	{

		unset($_COOKIE[$nome]);
		setcookie( $nome, "", -1,"/");

	}

?>