<?php

	class GU_redirecionador
	{

		protected $parametrosurl= array();

		protected $GU;


		public function __construct()
		{

			$this->GU =& obter_instancia();

		}


		// Redireciona para página
		protected function ir( $url )
		{

			header("Location:".rtrim(CAMINHO, "/").'/'.$url);

		}


		public function obtercontroladorAtual()
		{

			return $this->GU->router->controlador;

		}


		public function obteracaoAtual()
		{

			return $this->GU->router->acao;

		}


		// Recupera e monta os parametros da url
		protected function obterparametrosUrl()
		{

			$parametrosurl= "";		

			$aux=1;

			foreach( $this->GU->url->parametros as $nome=>$valor ){

				// Barra no final
				$bar= ( count( $this->GU->url->parametros ) < $aux )? '/' : '' ;

				$parametrosurl.= ( empty($parametrosurl) )?  $nome.'/'.$valor.$bar :  '/'.$nome.'/'.$valor.$bar ;

				$aux++;	

			}

			return $parametrosurl;

		}


		// Remove parametro
		public function delParametro($parametro)
		{

			unset( $this->GU->url->parametros[$parametro] );

			array_values( $this->GU->url->parametros );

			return $this;

		}


		// Recebe os parametros da url
		public function defineparametrosUrl( $nome, $valor )
		{

			$this->GU->url->parametros[$nome]= $valor;

			return $this;

		}


		// Envia pedido para redirecionar para um controlador
		public function irparaControlador( $controlador )
		{

			$this->ir( $controlador.'/index/'.$this->obterparametrosUrl() );

		}


		// Envia pedido para redirecionar para uma ação
		public function irparaAcao( $acao )
		{

			$this->ir( $this->obtercontroladorAtual().'/'.$acao.'/'.$this->obterparametrosUrl() );

		}


		// Envia pedido para redirecionar para um controlador e uma ação
		public function irparacontroladorAcao( $controlador, $acao , $parametros=null )
		{

			$parametrosurl= $this->obterparametrosUrl();
			
			$barraparametros= ( !empty( $parametrosurl ) || !is_null( $parametros ) )? '/'  : '' ;

			$barraparametrosfuncao=( !empty( $parametrosurl ) && !is_null( $parametros )  )?  '/' : '' ;

			$this->ir( $controlador.'/'.$acao.$barraparametros.$this->obterparametrosUrl().$barraparametrosfuncao.$parametros );

		}


		// Envia pedido para redirecionar para o inicio
		public function irparaInicio()
		{

			$this->ir( 'index' );

		}


		// Redireciona para uma url
		public function irparaUrl( $url )
		{

			header("Location: ".$url);

		}

	}

?>