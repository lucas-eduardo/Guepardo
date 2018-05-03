<div class="col-md-9 ajudantes-content conteudo-lateral" ng-if="aju.carregando">

    <h2 class="ajudantes-title">Carregamento de Ajudantes</h2>

    <p class="primeirospassos-text">

        O carregamento dos ajudantes são bem simples, dentro do seu modelo e/ou controlador, basta estar utilizando: <code>$this->load->ajudantes( array() );</code> e no mesmo você estará passando os nomes dos ajudantes ao qual irá utilizar. Por exemplo: <br>
        Tenho um ajudante chamado: <code>texto.php</code>, basta então chamar: <code>$this->load->ajudantes( array("texto") );</code> <br><br>

        Para a criação de um ajudante chamado <code>texto.php</code> que será carregada dentro do modelo e/ou controlador, é preciso estar criando da seguinde maneira! <br><br>

        <?php

            highlight_string('<?php

    function retiraAcento($texto){

        // Algoritmo

    }

?>');

        ?> <br><br>

        Para estar utilizando as funções, basta chamar o nome da função direto: <code>retiraAcento("olá mundo");</code>

    </p>

</div>