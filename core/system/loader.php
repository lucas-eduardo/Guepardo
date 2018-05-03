<?php

	/*
	* Carrega ajudantes, bibliotecas, visoes
	*/

	class GU_Loader
	{


		/*
		* Carregar ajudantes
		*/
		protected $caminhos_ajudantes= array();

		/*
		* Carregar bibliotecas
		*/
		protected $caminhos_bibliotecas= array();

		/*
		* Armazena as conexões
		*/
		protected $conexoes= array();



		//---------------------------------------------------------------------------------------



		/*
		* Define o caminho das bibliotecas e ajudantes
		*/
		public function __construct()
		{

			$this->caminhos_ajudantes= array( APP_PATCH,PATCH_SYSTEM );

			$this->caminhos_bibliotecas= array( APP_PATCH.'bibliotecas/',PATCH_SYSTEM.'bibliotecas/' );

		}



		//---------------------------------------------------------------------------------------



		/*
		* Chama o metodo para carregamento automatico os ajuantes e bibliotecas
		*/
		public function inicializar()
		{

			$this->autocarregar();

			return $this;

		}



		//---------------------------------------------------------------------------------------



		/*
		* Carrega o arquivo view especificado
		*/
		public function view( $nome_arquivo, $parametros=null, $caminho=null  )
		{

			$GU =& obter_instancia();

			// Converte os parametros em variaveis com prefixo
			if( is_array($parametros) && count($parametros) >0 ){

				extract($parametros, EXTR_PREFIX_ALL, 'view');

			}

			// Cria automaticamente as variaveis para view
			if( defined('AUTOURLPAR_VISAO') && AUTOURLPAR_VISAO ){

				extract($GU->url->getParametros(), EXTR_PREFIX_ALL, 'viewauto');

			}

			$_co_CO =& obter_instancia();

			foreach ( get_object_vars( $_co_CO ) as $_co_key => $_co_var){

				if ( ! isset( $this->$_co_key ) ){

					$this->$_co_key =& $_co_CO->$_co_key;

				}

			}

			// Define o caminho a ser usado para a view
			$caminhoview = ( !is_null( $caminho ) && !empty( $caminho ) )? $caminho : APP_PATCH;

			// Define o arquivo
			$arquivo_view = $caminhoview.VISAO.$nome_arquivo;			

			// Insere o arquivo
			try{

				if(file_exists($arquivo_view)){

					return require_once($arquivo_view);

					exit;

				}else{

					throw new Exception('O arquivo '.$arquivo_view.' nao foi encontrado<br>');

				}

			}catch (Exception $e) {

				echo $e->getMessage();

			}

		}



		//---------------------------------------------------------------------------------------



		/*
		* Carrega o ajudante especificado
		*/
		public function ajudante( array $ajudantes )
		{


			foreach ( $ajudantes as $ajudante) {

				foreach ( $this->caminhos_ajudantes as $caminho ) {


					if( file_exists( $caminho.'ajudantes/'.$ajudante.'.php' ) ){

						include_once( $caminho.'ajudantes/'.$ajudante.'.php' );

						break;

					}

				}

			}

		}



		//---------------------------------------------------------------------------------------



		/*
		* Metodo que permite carregar e instanciar classes de bibliotecas
		*/
		public function biblioteca( $biblioteca, $prefix=null, $caminho=null )
		{

			$biblioteca = strtolower( $biblioteca );

			// Adiciona um novo caminho caso exista
			if( !is_null( $caminho ) ){ $this->caminhos_bibliotecas[]= trim( $caminho );  }

			$GU =& obter_instancia();

			if( is_null( $prefix ) ){

				$classe= 'GU_'.$biblioteca;

			}else if( $prefix=='' ){

				$classe= $biblioteca;

			}else{

				$classe= $prefix.$biblioteca;

			}

			if ( class_exists( $classe ) ) {

				return;

			}

			foreach ( $this->caminhos_bibliotecas as $caminho ) {

				if( file_exists( $caminho.$biblioteca.'.php' ) ){

					include( $caminho.$biblioteca.'.php' );

					$GU->$biblioteca = new $classe;

					break;

				}

			}

		}



		//---------------------------------------------------------------------------------------



		/*
		* Permita carregar e instanciar modelos
		*/
		public function modelo( $modelo, $condb=FALSE, $caminho=null )
		{

			$modelo = strtolower( $modelo );

			// Adiciona um novo caminho caso exista
			if( !is_null( $caminho ) ){ $this->caminhos_modelos[]= trim( $caminho );  }

			$GU =& obter_instancia();

			$caminhomodelo=( is_null( $caminho ) )? APP_PATCH.'modelos/'.$GU->router->controlador.'/'.$modelo.'Modelo.php' : $caminho.'/'.$modelo.'Modelo.php' ;

			$classemodelo= $modelo.'Modelo';

			if ( class_exists( $classemodelo ) ) {

				return;

			}

			if( file_exists( $caminhomodelo ) ){

				if ( ! class_exists( 'GU_Model' ) ){

					$classe= carrega_classe( 'model', 'system' );

				}

				if( $condb !== FALSE ){

					$GU->load->bancodedados();

				}

				require_once( $caminhomodelo );

				$GU->$modelo = new $classemodelo();

				return;

			}

			exit('Nao foi possivel encontrar o modelo: '.$modelo);

		}



		//---------------------------------------------------------------------------------------



		/*
		* Carrega o gerenciador de banco de dados
		*/
		public function bancodedados()
		{

			// Se ja existir uma conexao com o banco ignora
			if ( in_array( $bd['banco'], $this->conexoes ) ) {

				return;

			}

			$GU =& obter_instancia();

			require_once( PATCH_SYSTEM.'bancodedados/BD.php');

			$GU->bd='';

			$GU->bd =& BD();

			$this->conexoes[]= $bd['banco'];

		}



		//---------------------------------------------------------------------------------------



		/*
		* Carrega automaticamente os ajudantes configurados no config/autocarregamento.php
		*/
		private function autocarregar()
		{

			if( APP_PATCH.'config/autocarregamento.php'  ){

				include(APP_PATCH.'config/autocarregamento.php');

			}

			if ( ! isset( $autocarregar ) ){

				return FALSE;

			}

			// Autoload helpers and languages
			foreach ( array('ajudante') as $tipo ){

				if ( isset( $autocarregar[ $tipo  ] ) AND count( $autocarregar[ $tipo  ] ) > 0 ){

					$this->$tipo( $autocarregar[ $tipo  ] );

				}

			}

			// Autoload helpers and languages
			foreach ( array('biblioteca') as $tipo ){

				if ( isset( $autocarregar[ $tipo  ] ) AND count( $autocarregar[ $tipo  ] ) > 0 ){

					foreach ( $autocarregar[ $tipo  ] as $biblioteca ) {

						$this->$tipo( $biblioteca );

					}

				}

			}

		}

	}

?>