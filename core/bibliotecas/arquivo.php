<?php

	// Realiza a manipulação de arquivos
	class GU_arquivo{
		
		// Nome do arquivo
		protected $arquivo;

		// Extensão do arquivo
		protected $extensao;

		// Tamanho do arquivo
		protected $tamanho;



		//---------------------------------------------------------------------------------------



		// Define a extensao e tamanho do arquivo
		public function montaArquivo( $arquivo ){
			
			$this->arquivo= $arquivo['name'];

			$ex_nome= explode( '.', $arquivo['name'] );

			$this->extensao= strtolower(end($ex_nome));

			$this->tamanho= $arquivo['size'];

			return $this;
		
		}



		//---------------------------------------------------------------------------------------



		// Valida a extensão de um arquivo
		public function validaExtensao( array $extensoes ){
				
			if( !in_array($this->extensao, $extensoes) && !empty($this->extensao) ){ 
			
				return false;
				
			}else{
			
				return true;
			
			}
		
		}



		//---------------------------------------------------------------------------------------



		// Valida o tamanho de um arquivo
		public function validaTamanho( $limite ){
			
			if( $this->tamanho > $limite ){

				return false;

			}else{

				return true;

			}
		
		}
		
		
		
		

	}

?>