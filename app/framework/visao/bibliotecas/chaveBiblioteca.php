<div class="col-md-9 bibliotecas-content conteudo-lateral" ng-if="bli.chave">

    <h2 class="bibliotecas-title">Biblioteca Chave</h2>

    <p class="primeirospassos-text">

        É uma biblioteca criada para geração automática de chave.

        <br><br>

        Para carregar a biblioteca, basta chamar: <code>$this->load->biblioteca('chave')</code>.

        <br><br>

        Para inicar a utlização siga os passos seguintes.

        <br><br>

        <?php

            highlight_string('<?php

    class chaveModelo extends GU_Model
    {


        // Método que gera a chave
        public function obterChave()
        {

            // Instancia a biblioteca chave
            $this->load->biblioteca("chave");

            // Chama o método que gera a chave
            $this->chave->geraChave( 20, "int" );

        }

    }

?>');

        ?>

        <br><br>

        o método <code>geraChave</code> espera 3 parametros. O primeiro parametro é passado o tamanho da chave, ele espera um dado <strong>inteiro</strong>, o segundo parametro espera o tipo de chave a ser gerado, os tipos disponiveis são: <code>int</code>, <code>password</code>, <code>text</code> e o default é letra e número. Já o terceiro parametro é caso queira gerar uma chave, e essa chave não pode ser repetida no banco de dados, então é passado o nome da coluna do banco. Veja o exemplo abaixo com os 3 parametros.

        <br><br>

        <?php

            highlight_string('<?php

    class chaveModelo extends GU_Model{


        // Método que gera a chave
        public function obterChave(){

            // Define a tabela a ser utilizada
            $this->bd->tabela = "clientes";

            // Chama o método que gera a chave
            $this->chave->geraChave( 10, "int", "intClienteChave" );

        }

    }

?>');

        ?>

        <br><br>

        <ul>

            <li>1º Parametro: Obrigatório</li>

            <li>2º Parametro: Opcional</li>

            <li>2º Parametro: Opcional</li>

        </ul>

    </p>

</div>