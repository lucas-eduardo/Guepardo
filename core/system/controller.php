<?php


	/*
	* Classe de Controle da Aplicação
	*/
	class Controller
	{

		/*
		* Armazena a instancia das classes carregadas
		*/
		private static $instancia;



		//---------------------------------------------------------------------------------------



		/*
		* Cria a instancia do objeto e inicializa o auto-carregamento
		*/
		public function __construct()
		{
			
			self::$instancia =& $this;

			//ATRIBUI TODOS OS OBJETOS DE CLASSE QUE FORAM INSTANCIADOS
			//NA INICIALIZACAO ( Colibri.php ) PARA VARIAVEIS DE CLASSE LOCAIS
			foreach ( classes_carregadas() as $var => $classse ){

				$this->$var =& carrega_classe( $classse,'system' );

			}
			
			$this->load =& carrega_classe( 'loader', 'system' );

			$this->load->inicializar();

		}



		//---------------------------------------------------------------------------------------



		/*
		* Recupera a instancia do objeto
		*/
		public static function &obter_instancia()
		{

			return self::$instancia;
			
		}


	}

?>