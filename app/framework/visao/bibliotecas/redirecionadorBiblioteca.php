<div class="col-md-9 bibliotecas-content conteudo-lateral" ng-if="bli.redirecionador">

    <h2 class="bibliotecas-title">Biblioteca Redirecionador</h2>

    <p class="primeirospassos-text">

        É uma biblioteca criada para fazer todo redirecionamento.

        <br><br>

        Para carregar a biblioteca, basta chamar: <code>$this->load->biblioteca('redirecionador')</code>.

        <br><br>

        Para inicar a utlização siga os passos seguintes.

        <br><br>

        <?php

            highlight_string('<?php

    class indexControlador extends Controller
    {


        // Método que gera a chave
        public function obterChave()
        {

            // Instancia a biblioteca chave
            $this->load->biblioteca("redirecionador");

        }

    }

?>');

        ?>

        <br><br>

        A biblioteca possui 10 métodos:

        <ul>

            <li>obtercontroladorAtual()</li>
            <li>obteracaoAtual()</li>
            <li>obterparametrosUrl()</li>
            <li>delParametro()</li>
            <li>defineparametrosUrl()</li>
            <li>irparaControlador()</li>
            <li>irparaAcao()</li>
            <li>irparacontroladorAcao()</li>
            <li>irparaInicio()</li>
            <li>irparaUrl()</li>

        </ul>

        O método <code>obtercontroladorAtual()</code> obtém o controlador atual ao qual você se encontra.

        <br><br>

        O método <code>obteracaoAtual()</code> obtém a ação atual ao qual você se encontra.

        <br><br>

        O método <code>obterparametrosUrl()</code> obtém todos os parametros passados na url, e retorna em um array.

        <br><br>

        O método <code>delParametro()</code> espera ser passado o nome de uma parametro da url para apagar o mesmo.

        <br><br>

        O método <code>defineparametrosUrl()</code> espera ser 2 parametros, o nome do parametro que você quer criar e o valor do mesmos.

        <br><br>

        O método <code>irparaControlador()</code> espera ser passado o nome do controlador ao qual você quer ir.

        <br><br>

        O método <code>irparaAcao()</code> espera ser passado o nome da ação ao qual você quer ir, mais essa ação deve estar criada dentro do controlador já.

        <br><br>

        O método <code>irparacontroladorAcao()</code> espera 3 parametros, o primeiro é esperado o nome do controlador, o segundo é o nome da ação e opcionalmente você pode estar passando parametros como o terceiro parametro.

        <br><br>

        O método <code>irparaInicio()</code> volta para a primeira página do seu controlador.

        <br><br>

        O método <code>irparaUrl()</code> espera ser passado uma url ao qual você quer ser redirecionado.

    </p>

</div>