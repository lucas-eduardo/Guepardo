<?php

	// Cria um Cookie
	function criacookie( $nome, $valor, $duracao=null )
	{

		$duracao= (  is_null( $duracao ) )? ( time() + (60 * 60 * 24 * 30) ) : $duracao;
		setcookie( $nome, $valor, $duracao, "/" );

	}


	// Apaga um Cookie
	function apagacookie( $nome )
	{

		unset($_COOKIE[$nome]);
		setcookie( $nome, "", -1, "/");

	}

?>