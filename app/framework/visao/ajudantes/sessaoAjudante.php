<div class="col-md-9 ajudantes-content conteudo-lateral" ng-if="aju.sessao">

    <h2 class="ajudantes-title">Ajudante Sessão</h2>

    <p class="primeirospassos-text">

        Para utilizado basta instanciar o ajudante: <code>$this->load->ajudantes( array("sessao") );</code>

        <?php

            highlight_string('<?php

    class indexController extends Controller
    {

        public function indexAcao()
        {

            // Inicia dados de sessão
            $this->load->ajudantes( array("sessao") );
            
            // Coloca permissão recursiva
            iniciaSessao( 120 );

            // Criação da sessão
            criaSessao( "usuario", "teste" );

            // Altera a sessão
            alteraSessao( "usuario", "novo valor" );

            // Retorna sessão
            selecionaSessao( "usuario" );

            // Exclui sessão
            excluiSessao( "usuario" );

            // Verifica a existencia da sessão
            verificaSessao( "usuario" );

        }

    }

?>');

        ?>

        <br><br>

        O <code>iniciaSessao()</code> espera ser passado o numero de segundos, caso não for passada deixa como padrão 3 horas.

        <br><br>

        O <code>criaSessao()</code> espera 2 parametros, o nome da sessão e o valor da mesma.

        <br><br>

        O <code>alteraSessao()</code> espera 2 parametros, o nome da sessão e o valor da mesma.

        <br><br>

        O <code>selecionaSessao()</code> espera ser passado o nome da sessão.

        <br><br>

        O <code>excluiSessao()</code> espera ser passado o nome da sessão.

        <br><br>

        O <code>verificaSessao()</code> espera ser passado o nome da sessão.

    </p>

</div>