<?php

	// Inicia dados de sessão
	function iniciaSessao( $tempo=null ){
		
		// Define o tempo de vida
		$inatividade= ( !is_null($tempo) )? $tempo*60 : 180*60 ;
		
		if( !isset($_SESSION) ){// Se a sessão não existe, cria a mesma

			session_start();

		}

		// Destroi caso o tempo tenha vencido
		if (isset($_SESSION['tempolimite'])) {

			$vida_sessao = time() - $_SESSION['tempolimite'];

			if ($vida_sessao > $inatividade) {
				
				session_start();
				session_destroy();
				session_start();
				
			}

		}

		// Renova o tempo de limite
		else{

			$_SESSION['tempolimite'] = time();
			
		}

	}



	//---------------------------------------------------------------------------------------



	// Cria sessão
	function criaSessao( $nome, $valor ){

		$_SESSION[$nome]= $valor;
		
	}



	//---------------------------------------------------------------------------------------



	// Altera sessão
	function alteraSessao( $nome, $valor ){

		$_SESSION[$nome]= $valor;

	}



	//---------------------------------------------------------------------------------------



	// Retorna uma sessão
	function selecionaSessao( $nome ){

		return $_SESSION[$nome];

	}



	//---------------------------------------------------------------------------------------



	// Exclui sessão
	function excluiSessao( $nome ){

		unset( $_SESSION[$nome] );

	}



	//---------------------------------------------------------------------------------------



	// Verifica a existencia de uma sessão
	function verificaSessao( $nome ){

		return isset( $_SESSION[$nome] );

	}

?>