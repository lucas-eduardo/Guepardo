<?php

/*
* Colibri
*
* Framework de desenvolvimento PHP 5 ou superior
* Autores Time de desenvolvimento Organy
* VERSÃO 1.1
*
*/

/*
* Colibri Classe limitelista
* Esta classe gera combo de limitação de listagens de resultados
*
*/

class GU_limitelista{
	
	
	//Select pronto em html
	public $limitelista;
	protected $GU;//instancia do super objeto


	/*
	* Construtor
	* Recupera instancia super objeto
	* carrega ajudantes e blibliotecas necessarias
	*/

	public function __construct(){

		$this->GU =& obter_instancia();

		return $this;

	}
	
	
	//MONTA O ARRAY COM OS ORDENADORES
	public function montaLista( $urlprincipal, $classe='', $id='', $limiteinicial=10 ){

		$classe= ( empty( $classe ) )? '' : "class='$classe'" ;
		$id= ( empty( $id ) )? "id='limitelista'" : "id='$id'" ;
		
		$parametros= $this->GU->url->parametros;//RECUPERA OS PARAMETROS EXISTENTES
		
		$limiteatual= $this->GU->url->getParametro( 'limite' );
		$limiteatual=( !empty( $limiteatual ) )? $limiteatual : $limiteinicial ;
		
		//REMOVE O LIMITE
		unset($parametros['limite']);
		
		
		//PAGINACAO
		$paginacaoatual= $this->GU->url->getParametro('paginacao');//ARMAZENA PAGINACAO ATUAL
		unset($parametros['paginacao']);//REMOVE A PAGINACAO A FIM DE EVITAR DUPLICIDADES
		
		
		//SE EXISTEM MONTAMOS OS PARAMETROS
		$stringparametros= '' ;//STRING LIMITE INICIA VAZIA
		if( count( $parametros ) ){
			
			foreach($parametros as $chavepar => $valorpar ){
				$stringparametros[]= $chavepar.'/'.$valorpar;
			}
			
			$stringparametros= implode('/',$stringparametros).'/';
		}
		
		
		//MONTA O SELECT
		$limitelista='<select title="Resultados por página" name="limitelista" '.$classe.' '.$id.' >';
		$valores= array('5','10','15','20','25','30','50');
		
	
		
		foreach( $valores as $valor ){
			
			$selected= ( $limiteatual==$valor )? 'selected="selected"' : '' ;
			
			//REFAZ A PAGINACAO
			if( $paginacaoatual ){
				$novapaginacao= ceil( ((($paginacaoatual-1)*$limiteatual)+1)/$valor );
				$paginacao= ( !empty( $paginacaoatual ) && $novapaginacao>1 )? '/paginacao/'.$novapaginacao : '' ;
			}
			
			
			$limitelista.='<option '.$selected.' value="'.$urlprincipal.'/'.$this->GU->router->controlador.'/'.$this->GU->router->acao.'/'.$stringparametros.'limite/'.$valor.$paginacao.'">'.$valor.'</option>';
		}
		$limitelista.='</select>';
		
		$this->limitelista= $limitelista;
		
		return $this;
		
	
	}


}

?>