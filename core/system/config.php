<?php
	
	/*
	
		Framework Guepardo - Desenvolvido inicialmente por Lucas Eduardo

		link: https://github.com/ManualDeveloper/Guepardo

	*/



	//---------------------------------------------------------------------------------------



	/*
	* Define a versão do framework
	*/
	define( "VersaoGuepardo", "1.5" );



	//---------------------------------------------------------------------------------------



	/*
	* Define a pasta do sistema
	*/
	if( realpath( $system ) !== FALSE && is_dir( $system ) ){

		define('PATCH_SYSTEM', rtrim( realpath( $system ),'/' ).'/' );

	}else{

		exit( 'A pasta do sistema nao esta correta, verifique a configuracao no arquivo index.php.' );

	}



	//---------------------------------------------------------------------------------------



	/*
	* Define a pasta da aplicacao
	*/
	if( realpath( $application ) !== FALSE && is_dir( $application ) ){

		define('APP_PATCH', rtrim( realpath( $application ),'/' ).'/');

	}else{

		exit( 'A pasta de sua aplicacao nao esta correta, verifique o arquivo index.php.' );

	}



	//---------------------------------------------------------------------------------------



	/*
	* Carrega os DEFINES na configuração da aplicação do framework
	*/
	require( APP_PATCH.'config/config.php' );



	//---------------------------------------------------------------------------------------



	/*
	* Define o timezone
	*/
	date_default_timezone_set(TIMEZONE);



	//---------------------------------------------------------------------------------------



	/*
	* Define o tempo de execução
	*/
	if ( function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0 ){

		@set_time_limit(300);

	}



	//---------------------------------------------------------------------------------------



	/*
	* Carrega as funções padrao
	*/
	require( PATCH_SYSTEM.'system/default.php' );



	//---------------------------------------------------------------------------------------



	/*
	* Carrega a classe de url
	*/
	$URL =& carrega_classe( 'url','system' );



	//---------------------------------------------------------------------------------------



	/*
	* Carrega a classe de rotas
	*/
	$ROT =& carrega_classe( 'router','system' );

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	if( ERR_LOGS ){
		
		set_error_handler( 'manipulador_excessoes' );
	
	}



	//---------------------------------------------------------------------------------------



	/*
	* Carrega a classe controlador
	*/
	require( PATCH_SYSTEM.'system/controller.php' );



	//---------------------------------------------------------------------------------------



	/*
	* Retorna a instancia do controlador
	*/
	function &obter_instancia()
	{

		return Controller::obter_instancia();

	}



	//---------------------------------------------------------------------------------------



	/*
	* Inclui o controlador secundario da aplicação
	*/
	$arquivo_controlador = APP_PATCH.CONTROLADORES.$ROT->controlador.'Controlador.php';

	try{

		if( file_exists( $arquivo_controlador ) ){
			
			// Inclui o arquivo controlador
			require_once( $arquivo_controlador );

			// Instancia o controlador
			$classe= $ROT->controlador.'Controlador';
			
			try{

				if( class_exists( $classe ) ){
					
					// Instancia a classe do controlador
					$md_classe= new $classe;
					
					// Se o método existe, o mesmo é chamado
					$metodo= $ROT->acao.'Acao';
					
					try{

						if( method_exists( $classe,$metodo ) ){
							
							if(method_exists($classe,'inicializacao')){ // Se o método existe...
								
								// Chama a inicialização do controlador
								$md_classe->inicializacao();

							}
							
							// Executa o método
							$md_classe->$metodo();
							
						}else{

							throw new Exception("O método '$metodo' nao existe na classe '$classe'<br>");

						}

					}catch (Exception $e) {

						echo $e->getMessage();

					}


				}else{

					throw new Exception("A classe '$classe' nao existe no arquivo '$arquivo_controlador'<br>");

				}
			}catch (Exception $e) {

				echo $e->getMessage();

			}


		}else{

			throw new Exception('O arquivo controlador '.$arquivo_controlador.' nao foi encontrado<br>');

		}
		
	}catch (Exception $e) {

		echo $e->getMessage();

	}

?>