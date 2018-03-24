<div class="col-md-9 ajudantes-content conteudo-lateral" ng-if="aju.pasta"><h2 class="ajudantes-title">Ajudante Pasta</h2><p class="primeirospassos-text">Para utilizado basta instanciar o ajudante: <code>$this->load->ajudantes( array("pasta") );</code> <?php

            highlight_string('<?php

    class indexController extends Controller
    {

        public function indexAcao()
        {

            // Instancia o ajudante
            $this->load->ajudantes( array("pasta") );
            
            // Coloca permissão recursiva
            chmoddir( CAMINHO, 0777 );

            // Remoção recursiva
            removedir( CAMINHO );

        }

    }

?>'); ?><br><br>O <code>chmoddir()</code> espera 2 parametros, o primeiro é o caminho e o segundo é o tipo de permissão.<br><br>O <code>removedir()</code> espera 1 parametros, o caminho.</p></div>