<?php

	/*
	* Carrega classe informada
	*/
	if( ! function_exists( 'carrega_classe' ) )
	{

		function &carrega_classe( $classe, $dir='system', $prefixo= 'GU_' )
		{

			static $classes= array();

			if ( isset( $_classes[$classe] ) ){ // Caso a classe não exista...

				return $_classes[$classe];

			}

			$nomeclasse = FALSE;

			foreach ( array( APP_PATCH, PATCH_SYSTEM ) as $caminho ) {

				if( file_exists( $caminho.$dir.'/'.$classe.'.php' ) ){

					$nomeclasse= $prefixo.$classe;

					require_once( $caminho.$dir.'/'.$classe.'.php' );

					break;

				}

			}

			if ( $nomeclasse === FALSE ){

				exit('Classe nao localizada: '.$classe.'.php');

			}

			classes_carregadas( $classe );

			$classes[ $classe ] = new $nomeclasse;

			return $classes[ $classe ];

		}


	}



	//---------------------------------------------------------------------------------------



	/*
	* Registra as classes carregadas para controle
	*/
	if ( ! function_exists('classes_carregadas'))
	{

		function &classes_carregadas( $classe = '' ){

			static $carregadas = array();

			if ($classe != ''){

				$carregadas[strtolower($classe)] = $classe;

			}

			return $carregadas;

		}

	}



	//---------------------------------------------------------------------------------------



	/*
	* Invoca a classe de Excessoes e grava log de erro
	*/
	function manipulador_excessoes( $errno, $errstr, $errfile, $errline )
	{

		$erro =& carrega_classe( 'exceptions', 'system' );

		$erro->gravalogErro( $errno, $errstr, $errfile, $errline );

	}

?>