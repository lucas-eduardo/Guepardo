<?php

	/*
	* Classe Roteador
	* Define o roteamento das requisicoes
	*/

	class GU_Router
	{

		private $requisicao;
		private $separador;
		public $controlador;
		public $acao;



		//---------------------------------------------------------------------------------------



		/*
		* Configura o controlador e acao
		*/
		public function __construct()
		{

			// Caso não exista, define 'index/index' como padrão.
			$this->requisicao= (isset($_GET['requisicao'])) ? $_GET['requisicao'] : 'index/index' ;

			// Separa a ação e controlador por barra
			$this->separador= explode('/',$this->requisicao);

			// Define o controlador
			$this->controlador= $this->separador[0];

			// Define a ação
			$this->acao= ( !isset($this->separador[1]) || $this->separador[1]==NULL ) ?  'index' :  $this->separador[1] ;

		}

	}

?>