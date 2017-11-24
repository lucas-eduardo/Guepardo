<?php

/*
* Colibri
*
* Framework de desenvolvimento PHP 5 ou superior
* Autores Time de desenvolvimento Organy
* VERSÃO 1.0
*
*/



/*
* Colibri Classe Upload
* Realiza o upload de arquivos
*/

class GU_upload{

	protected $caminho;//CAMINHO DO ARQUIVO
	protected $nome;//NOME ARQUIVO
	protected $nometemporario;//NOME TEMPORARIO DO ARQUIVO
	protected $novonome= null;//NOVO NOME DO ARQUIVO
	protected $extensao;//EXTENSAO DO ARQUIVO
	protected $renomear= false;//CHAVE PARA RENOMEAR ARQUIVOS

	

	/*
	* Define o caminho de destino para o arquivo
	*/

	public function montaCaminho( $caminho ){

		$this->caminho= $caminho;

		return $this;

	}




	//-----------------------------------------------------------------------------------------------


	

	/*
	* Define o nome do arquivo
	*/

	public function montaNomearquivo( $nome ){

		$this->nome= $nome;

		return $this;

	}





	//-----------------------------------------------------------------------------------------------


	

	/*
	* Define o nome temporário do arquivo
	*/

	public function montaNometemporarioarquivo( $nometemporario ){

		$this->nometemporario= $nometemporario;

	}




	//-----------------------------------------------------------------------------------------------
	

	

	/*
	* Extrai o nome e nome temporario do arquivo
	* invoca os metodos que definem os nomes
	*/

	public function montaArquivo( $arquivo ){

		$this->montaNomearquivo( $arquivo['name'] );
		$this->montaNometemporarioarquivo( $arquivo['tmp_name'] );

		return $this;

	}





	//-----------------------------------------------------------------------------------------------


	

	/*
	* Ativa o renomeamento de arquivos
	*/

	public function renomearArquivo( $nome=null ){

		$this->novonome= null;
		$this->renomear= true;

		if( !is_null( $nome ) ){ $this->novonome=$nome; }

		return $this;

	}




	//-----------------------------------------------------------------------------------------------


	

	/*
	* Renomeia o arquivo
	*/

	protected function renomeia( $nomeatual ){

		$nomeatual= explode( '.', $nomeatual );

		$this->extensao= strtolower(end($nomeatual));
		

		//GERA NOVO NOME
		if( !is_null( $this->novonome ) ){

			$this->novonome= $this->novonome.'.'.$this->extensao;

		}else{

			do{

				$novo_nome= mt_rand();

			}while( file_exists( $this->caminho.$novo_nome.'.'.$this->extensao ) );

			$this->novonome= $novo_nome.'.'.$this->extensao;

		}
	

	}



	//-----------------------------------------------------------------------------------------------

	

	/*
	* Realiza o upload do arquivo
	*/

	public function upload(){

			//DEFINE O NOME DO ARQUIVO
			if( $this->renomear==true ){ 

				$this->renomeia ( $this->nome ); 

				$nome_arquivo= $this->novonome;

			}else{

				$nome_arquivo= $this->nome;

			}


			if( move_uploaded_file($this->nometemporario, $this->caminho.$nome_arquivo )){

				return array( true , $nome_arquivo );

			}else{

				return array( false , '' );

			}
	

	}
	



}
?>