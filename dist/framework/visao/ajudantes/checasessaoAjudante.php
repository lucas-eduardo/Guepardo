<div class="col-md-9 ajudantes-content conteudo-lateral" ng-if="aju.checasessao"><h2 class="ajudantes-title">Ajudante Checa Sessão</h2><p class="primeirospassos-text">O ajudante checa sessão serve para fazer a verificação se a sessão ainda existe, para utilizado basta instanciar o ajudante: <code>$this->load->ajudantes( array("checasessao") );</code> <?php

            highlight_string('<?php

    class indexController extends Controller
    {

        public function inicializacao()
        {

            // Instancia o ajudante
            $this->load->ajudantes( array("checasessao") );
            
            // Verifica a sessão
            checasessao( $this->url->getParametro("ajax"), CAMINHO."/login" );

        }

    }

?>'); ?><br><br>A função espera 2 parametros, a primeira recebe se a requisição é em ajax, com valores true ou false, e o segundo recebe o caminho caso esteja sem a sessão.</p></div>