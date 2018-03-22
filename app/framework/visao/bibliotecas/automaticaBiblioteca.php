<div class="col-md-9 bibliotecas-content conteudo-lateral" ng-if="bli.automatico">

    <h2 class="bibliotecas-title">Carregamento Automático de Bibliotecas</h2>

    <p class="primeirospassos-text">

        O carregamento automático parte do arquivo <code>autocarregamento.php</code> que se encontra em <code>suaaplicacao/app/aplicacao/config/autocarregamento.php</code>, nele você encontrará <code>$autocarregar['ajudante'] = array();</code> e <code>$autocarregar['biblioteca'] = array();</code>, para realizar o autocarregamento da biblioteca, basta passar o nome dela no array, por exemplo: <code>$autocarregar['biblioteca'] = array("obter_users");</code>, a diferença entra no modo de criar a biblioteca, veja a seguir: <br><br>

        <?php

            highlight_string('<?php

    class GU_obter_users
    {

        // Cria uma propriedade protegida chamada GU de Guepardo.
        protected $GU;

        /*
        * Método construtor, que recupera do o objeto,
        * sendo possível trabalhar com banco de dados, carregar ajudantes e bibliotecas
        */
        public function __construct()
        {

            $this->GU =& obter_instancia();
            return $this;

        }

        // Seus métodos

    }

?>');

        ?> <br><br>

        Como pode ser observado no código acima, é criado uma propriedade protegida, para usar atribuir uma instancia de todo o objeto. Já no construct ele atribui toda a instancia do framework na propriedade <code>GU</code>, onde com isso você estará tendo acesso ao banco de dados por exemplo, veja outro exemplo abaixo. <br><br>

        <?php

            highlight_string('<?php

    class GU_obter_users
    {

        // Cria uma propriedade protegida chamada GU de Guepardo.
        protected $GU;

        /*
        * Método construtor, que recupera do o objeto,
        * sendo possível trabalhar com banco de dados e carregar ajudantes.
        */
        public function __construct()
        {

            $this->GU =& obter_instancia();
            return $this;

        }


        //------------------------------------------------------------


        // Recupera usuarios
        public function getUsers()
        {

            // Carrega toda a instancia do banco de dados
            $this->GU->load->bancodedados();

            // Conecta na tabela
            $this->GU->bd->tabela="usuarios";

        }

    }

?>');

        ?> <br><br>

        Para utilizar os métodos, basta colocar: <code>$this->obter_users->metodo();</code>. <br><br>

        <span class="text-muted font12">Lembrando que a propriedade protegida <code>GU</code>, pode ser qualquer nome, desde que você utilize em toda a sua biblioteca!</span>

    </p>

</div>