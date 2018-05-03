<div class="col-md-9 ajudantes-content conteudo-lateral" ng-if="aju.cookies">

    <h2 class="ajudantes-title">Ajudante Cookies</h2>

    <p class="primeirospassos-text">

        O ajudante cookies serve para facilitar a criação e a exclusão de cookies, para utilizado basta instanciar o ajudante: <code>$this->load->ajudantes( array("cookies") );</code>

        <?php

            highlight_string('<?php

    class indexController extends Controller
    {

        public function indexAcao()
        {

            // Instancia o ajudante
            $this->load->ajudantes( array("cookies") );
            
            // Cria Cookie
            criacookie( "framework", "Guepardo", 2592000 );

            // Apaga Cookie
            apagacookie( "framework" );

        }

    }

?>');

        ?>

        <br><br>

        O <code>criacookie()</code> espera 2 parametros obrigatorios e 1 não obrigatorio. O primeiro é o nome do cookie que será criado, o segundo é o valor do seu cookie e por ultimo sendo opcional, a valor de expiração em segundos. Caso o valor de expiração não seja passo, por padrão será 30 dias.

        <br><br>

        O <code>apagacookie()</code> espera ser passado apenas o nome do cookie que você deseja apagar.

    </p>

</div>