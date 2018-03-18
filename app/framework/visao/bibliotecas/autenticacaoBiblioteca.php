<div class="col-md-9 bibliotecas-content conteudo-lateral" ng-if="bli.autenticacao">

    <h2 class="bibliotecas-title">Biblioteca Autenticação</h2>

    <p class="primeirospassos-text">

        É uma biblioteca criada para fazer toda a autenticação do usuário.

        <br><br>

        Para carregar a biblioteca, basta chamar: <code>$this->load->biblioteca('autenticacao')</code>.

        <br><br>

        Para inicar a utlização siga os passos seguintes.

        <br><br>

        <?php

            highlight_string('<?php

    class loginControlador extends Controller{


        // Método que valida o login
        public function acessarAcao(){

            // Instancia a biblioteca chave
            $this->load->biblioteca("autenticacao");

            // Chama o método que valida o login
            $this->autenticacao
            ->montaNometabela("usuarios")
            ->montaColunausuario("strUsuarioEmail")
            ->montaColunasenha("strUsuarioSenha")
            ->montaRegras( array( array("intUsuarioStatus", "=", 1, "AND") )
            ->montaUsuario( $_POST["form_login_email"] )
            ->montaSenha( hash("sha512", $_POST["form_login_senha"] ) )
            ->montaparametrosUrl( "login", "sucesso" )
            ->montaLogincontroladoracao( "index", "index" )
            ->montaUrlerrologin( "index/acao/errologin" )
            ->montaNomesessao( SESSAOAPP )
            ->login();

        }

    }

?>');

        ?>

        <br>

        <ul>

        	<li>
        		
        		<code>montaNometabela</code> é a função no qual é passado o nome da tabela do banco de dados a ser utilizado.

        	</li>

        	<li>
        		
				<code>montaColunausuario</code> é a função no qual é passado o nome da coluna ao qual será validado o login.

        	</li>

        	<li>
        		
        		<code>montaColunasenha</code> é a função no qual é passado o nome da coluna ao qual será validado a senha.

        	</li>

        	<li>
        		
        		<code>montaRegras</code> é a função no qual é passado um array de condição para o login.

        	</li>

        	<li>
        		
        		<code>montaUsuario</code> é a função no qual é passado o login que o usuário digitou.

        	</li>

        	<li>
        		
        		<code>montaSenha</code> é a função no qual é passado a senha que o usuário digitou.

        	</li>

        	<li>
        		
				<code>montaparametrosUrl</code> é a função no qual é passado o nome do parametro e o valor do mesmo, caso a validação seja com sucesso.

        	</li>

        	<li>
        		
        		<code>montaLogincontroladoracao</code> é a função no qual é passado o controlador e a ação para ser redirecionado após o login.

        	</li>

        	<li>
        		
				<code>montaUrlerrologin</code> é a função no qual é passado a url para ser redirecionado caso dê erro na validação ( for invalido ).

        	</li>

        	<li>
        		
        		<code>montaNomesessao</code> é a função no qual é passado o nome da sessão que vem do config/config.php.

        	</li>

        	<li>
        		
        		<code>login</code> chama a função que verifica todo o login, com base em todas as informações passadas.

        	</li>

        </ul>

        <br><br>

        Para realizar o logout, basta seguir os passos seguintes.

        <br><br>

        <?php

            highlight_string('<?php

    class loginControlador extends Controller{


        // Método que realiza o logout
        public function sairAcao(){

            // Instancia a biblioteca chave
            $this->load->biblioteca("autenticacao");

            // Chama o método que faz o logout
            $this->autenticacao
            ->montaNomesessao( SESSAOAPP )
            ->montaLogouturl( CAMINHO )
            ->logout();

        }

    }

?>');

        ?>

        <br>

        <ul>
        	
        	<li>
        		
        		<code>montaNomesessao</code> é a função no qual é passado o nome da sessão que vem do config/config.php.

        	</li>

        	<li>
        		
        		<code>montaLogouturl</code> é a função no qual é passado a url que será redirecionado após o logout.

        	</li>

        	<li>
        		
        		<code>logout</code> é a função que realiza o logout, com base nas informações passadas.

        	</li>

        </ul>

        <br><br>

        Além das funções de <code>login</code> e <code>logout</code>, é possível chegar o login, com aa seguinte função: <code>checaLogin()</code>.

        <br><br>

        <ul>
        	
        	<li>
        		
        		<code>checaLogin()</code> essa função retorna true caso o usuário esteja logado e false caso não esteja logado.

        		<br><br>

		<?php

            highlight_string('<?php

    class loginControlador extends Controller{


        // Método que chega o login
        public function checaAcao(){

            // Instancia a biblioteca chave
            $this->load->biblioteca("autenticacao");

            // Chama o método que faz a checagem
            $this->autenticacao
            ->montaNomesessao( SESSAOAPP )
            ->checaLogin();

        }

    }

?>');

        ?>

        	</li>

        </ul>

    </p>

</div>