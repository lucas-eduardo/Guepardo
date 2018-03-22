<div class="col-md-9 ajudantes-content conteudo-lateral" ng-if="aju.data"><h2 class="ajudantes-title">Ajudante Data</h2><p class="primeirospassos-text">Para utilizado basta instanciar o ajudante: <code>$this->load->ajudantes( array("data") );</code> <?php

            highlight_string('<?php

    class indexController extends Controller
    {

        public function indexAcao()
        {

            // Instancia o ajudante
            $this->load->ajudantes( array("data") );
            
            // Converte data
            $data = strtotime("2018-03-22 10:30:00");
            convertedata( $data, "br" );

        }

    }

?>'); ?><br><br>O <code>convertedata()</code> espera 2 parametros obrigatorios, o primeiro é o timestamp Unix e o segundo é o tipo de saida ( br ou us ).</p></div>