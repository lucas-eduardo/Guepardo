<div class="col-md-9 bibliotecas-content conteudo-lateral" ng-if="bli.migalhas"><h2 class="bibliotecas-title">Biblioteca Migalhas ( breadcrumbs )</h2><p class="primeirospassos-text">É uma biblioteca criada para a criação de breadcrumbs.<br><br>Para carregar a biblioteca, basta chamar: <code>$this->load->biblioteca('migalhas')</code>.<br><br>Para inicar a utlização siga os passos seguintes.<br><br> <?php

            highlight_string('<?php

    class indexModelo extends GU_Model
    {


        // Método que gera a chave
        public function brad( $pagina = null )
        {

            // Instancia a biblioteca migalhas
            $this->load->biblioteca("migalhas");

            switch ( $pagina ) {

                case "adm":
                    
                    $this->migalhas
                    ->defineSessao( array( "Resumo", "index", "<i class=\'fa fa-dashboard\'></i>" ), true )
                    ->defineSessao( array( "Administradores", "", "" ), false );

                    break;

                default:
                    
                    $this->migalhas
                    ->defineSessao( array( "Resumo", "", "" ), true );

                    break;

            }

            return $this->migalhas
            ->definetipoelemento("ol")
            ->defineclasselementoatual("active")
            ->menu("breadcrumb", "");

        }

    }

?>'); ?><br><br>A biblioteca possui 4 métodos:</p><ul><li>definetipoelemento()</li><li>defineclasselementoatual()</li><li>defineSessao()</li><li>menu()</li></ul>O método <code>definetipoelemento()</code> espera ser passado a tag que irá englobar o breadcrumbs inteiro.<br><br>O método <code>defineclasselementoatual()</code> espera ser passado o nome da class do ultimo elemento do breadcrumbs.<br><br>O método <code>defineSessao()</code> espera ser passado 2 parametros, o primeiro é um array com 3 posições: Título, controlador/ação e o icone, o segundo é apenas true ou false. Se for true significa que o breadcrumbs inicia no elemento X se for false, inicia como HOME e controlador index. O método <code>menu()</code> espera ser passado 2 parametros, o primeiro é o nome da class do elemento que engloba o breadcrumbs e o segundo é o nome do id caso tenha.<br><br>Caso você não queira definir o elemento que engloba o breadcrumbs ( <code>definetipoelemento()</code> ), ele virá com um valor padrão que é a tag <code>ol</code>.<br><br>Caso você não queira definir a classe do ultimo elemento do breadcrumbs ( <code>defineclasselementoatual()</code> ), ele virá com um valor padrão que é a class <code>active</code>.<br><br>Caso você não queira passar os parametros do método <code>menu()</code>, ele deixará a class padrão <code>breadcrumb</code> e o id vazio.<p></p></div>