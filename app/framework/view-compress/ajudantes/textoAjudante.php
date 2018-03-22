<div class="col-md-9 ajudantes-content conteudo-lateral" ng-if="aju.texto"><h2 class="ajudantes-title">Ajudante Texto</h2><p class="primeirospassos-text">Para utilizado basta instanciar o ajudante: <code>$this->load->ajudantes( array("texto") );</code> <?php

            highlight_string('<?php

    class indexController extends Controller
    {

        public function indexAcao()
        {

            // Inicia dados de sessão
            $this->load->ajudantes( array("texto") );
            
            // Remove o acento
            retiraAcento( "Olá" );

            // Remover o @
            removeEspeciais( "Olá @ teste" );

            // Criação de slug
            criaSlug( "testando teste", "-", ".pdf" );

        }

    }

?>'); ?><br><br>O <code>retiraAcento()</code> espera ser passado um texto.<br><br>O <code>removeEspeciais()</code> espera ser passado um texto.<br><br>O <code>criaSlug()</code> espera 3 parametros, o texto, a separação dos espaços e se vai ter extensão ou não.</p></div>