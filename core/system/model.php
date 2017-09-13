<?php

	/*
	* Modelo da aplicação
	*/

	class GU_Model{

		/*
		* __get
		*
		* Permite aos modelos acessar todas as classes instanciadas no MD
		* com a mesma sintaxe que os controladores
		*
		*/
		function __get( $chave ){

			$GU =& obter_instancia();
			return $GU->$chave;
			
		}

	}


?>