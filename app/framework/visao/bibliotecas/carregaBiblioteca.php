<div class="col-md-9 bibliotecas-content conteudo-lateral" ng-if="bli.carregando">

    <h2 class="bibliotecas-title">Carregamento de Bibliotecas</h2>

    <p class="primeirospassos-text">

        O carregamento das bibliotecas são bem simples, dentro do seu modelo e/ou controlador, basta estar utilizando: <code>$this->load->biblioteca();</code> e no mesmo você estará passando o nome da sua biblioteca. Por exemplo: <br>
        Tenho uma biblioteca chamada: <code>obter_users.php</code>, basta então chamar: <code>$this->load->biblioteca("obter_users");</code> <br><br>

        Para a criação de uma biblioteca chamada <code>obter_users.php</code> que será carregada dentro do modelo e/ou controlador, é preciso estar criando da seguinde maneira! <br><br>

        <?php

            highlight_string('<?php

    class GU_obter_users extends GU_Model
    {

        // Seus métodos

    }

?>');

        ?> <br><br>

        Quando você coloca <code>extends GU_Model</code>, ele estará herdando todos os métodos do modelo principal, com isso é possível fazer conexão com banco de dados e carregar os ajudantes. <br><br>
        Para utilizar os métodos, basta colocar: <code>$this->obter_users->metodo();</code>.

    </p>

</div>