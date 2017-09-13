<?php

	// Realiza o controle de acesso dos usuários
	class GU_autenticacao{

		//PROPRIEDADES PROTEGIDAS
		protected

		$GU,
		$redirecionadorAjudante,
		$nomeTabela,
		$colunaUsuario,
		$regrasAdicionais,
		$colunaSenha,
		$usuario,
		$senha,
		$url=null,
		$controladorLogin='index',
		$acaoLogin='index',
		$controladorLogout='index',
		$acaoLogout='index',
		$nomeSessao='Usuarioautenticado'// Nome será atribuido a sessão de autenticação

		;



		//---------------------------------------------------------------------------------------



		/*
		* Recupera instancia o objeto, se conecta ao banco de dados e 
		* carrega ajudantes e blibliotecas necessárias
		*/
		public function __construct(){

			$this->GU =& obter_instancia();

			$this->GU->load->ajudante( array('sessao') );

			iniciasessao();

			$this->GU->load->biblioteca( 'redirecionador' );

			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define nome da tabela a ser usada
		public function montaNometabela( $tabela ){

			$this->nomeTabela= $tabela;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define coluna do usuario
		public function montaColunausuario( $coluna ){

			$this->colunaUsuario= $coluna;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define coluna da senha
		public function montaColunasenha( $coluna ){

			$this->colunaSenha= $coluna;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define regras adicionais
		public function montaRegras( array $regras ){

			$this->regrasAdicionais= $regras;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define usuario
		public function montaUsuario( $usuario ){

			$this->usuario= $usuario;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define senha
		public function montaSenha( $senha ){

			$this->senha= $senha;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define parametros para url
		public function montaparametrosUrl( $nome, $valor ){

			$this->GU->redirecionador->defineparametrosUrl($nome, $valor);
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define controlador e acao para redirecionamento apos o login
		public function montaLogincontroladoracao( $controlador, $acao ){

			$this->controladorLogin= $controlador;
			$this->acaoLogin= $acao;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define controlador e acao para redirecionamento apos o login
		public function montaUrlerrologin( $url ){

			$this->url= $url;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define a url de redirecionamento em caso de logout
		public function montaLogouturl( $url ){

			$this->url= $url;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define controlador e acao para redirecionamento em caso de logout
		public function montaLogoutcontroladoracao( $controlador, $acao ){

			$this->controladorLogout= $controlador;
			$this->acaoLogout= $acao;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define nome da sessao
		public function montaNomesessao( $nome ){

			$this->nomeSessao= $nome;
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Realiza o login
		public function login(){

			$this->GU->load->bancodedados();

			$this->GU->bd->tabela= $this->nomeTabela;

			$where[]= array( $this->colunaUsuario,'=',$this->usuario,'AND' );

			// Define as regras adicionais
			if( count( $this->regrasAdicionais ) > 0 && is_array( $this->regrasAdicionais ) ){

				foreach( $this->regrasAdicionais as $regras ){

					// Monta as regras adicionais array( 'coluna', 'operador', 'valor', 'continuador' )
					$where[]= $regras;

				}

			}

			$where[]= array($this->colunaSenha,'=',$this->senha,'');

			$sql= $this->GU->bd
			->setfetch()
			->read( $where, '1' );

			if( $this->GU->bd->linhas>0 ){

				criasessao( hash('sha512', $this->nomeSessao ), true );
				criasessao( $this->nomeSessao.'_Usuariodados', $sql );
				criasessao( $this->nomeSessao.'_Datalogin', date("Y/m/d H:i:s") );

				$this->GU->redirecionador->irparacontroladorAcao( $this->controladorLogin, $this->acaoLogin );

			}else{

				$this->GU->redirecionador->irparaUrl( $this->url );

			}

		}



		//---------------------------------------------------------------------------------------



		// Realiza o logout
		public function logout(){

			excluisessao( hash('sha512', $this->nomeSessao ) );
			excluisessao( $this->nomeSessao."_Usuariodados" );
			/* session_destroy(); Foi desabilitado pois ao deslogar da central do cliente deslogava do painel */

			if( !verificasessao( hash('sha512', $this->nomeSessao ) ) && !verificasessao( $this->nomeSessao."_Usuariodados" ) ){

				if( is_null( $this->url ) ){

					$this->GU->redirecionador->irparacontroladorAcao( $this->controladorLogout, $this->acaoLogout );

				}else{

					$this->GU->redirecionador->irparaUrl( $this->url );

				}

			}

			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Checa se o usuario esta logado
		public function checaLogin( $condicao ){

			switch($condicao){

				case "boleano":

					if( !verificasessao( hash('sha512', $this->nomeSessao ) ) ){

						return false;

					}else{

						return true;

					}

				break;

				case "redirecionar":

					if( !verificasessao( hash('sha512', $this->nomeSessao ) ) ){

						if( is_null( $this->url ) ){

							$this->GU->redirecionador->irparacontroladorAcao( $this->controladorLogin,$this->acaoLogin );

						}else{

							$this->GU->redirecionador->irparaUrl( $this->url );

						}

					}

				break;

				case "parar":

					if( !verificasessao( hash('sha512', $this->nomeSessao ) ) ){

						exit;

					}

				break;

			}

		}



		//---------------------------------------------------------------------------------------



		// Retorna os dados do usuario
		public function dadosUsuario( $coluna ){

			$sessao= selecionasessao( $this->nomeSessao."_Usuariodados");
			return $sessao[$coluna];

		}

	}

?>