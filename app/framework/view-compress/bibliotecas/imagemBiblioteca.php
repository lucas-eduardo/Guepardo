<div class="col-md-9 bibliotecas-content conteudo-lateral" ng-if="bli.imagem"><h2 class="bibliotecas-title">Biblioteca Imagem</h2><p class="primeirospassos-text">Para carregar a biblioteca, basta chamar: <code>$this->load->biblioteca('imagem')</code>.<br><br>Para inicar a utlização siga os passos seguintes.<br><br> <?php

            highlight_string('<?php

    class indexModelo extends GU_Model
    {


        // Método que gera a chave
        public function cadastraImagem( $base_64 )
        {

            // Instancia a biblioteca imagem
            $this->load->biblioteca("imagem");

            $caminho = str_replace("\\", "/", APP_PATCH."conteudo/produtos/");

            $up_img = $this->imagem
            ->montaCaminho( $caminho )
            ->montaImagem( "teste.jpg", false )
            ->b64toImage( $base_64 );

            $up_img2 = $this->imagem
            ->montaCaminho( $caminho )
            ->montaImagem( "teste.jpg", false )
            ->thumbImagem( "400", "340" );

            if( $up_img && $up_img2 ){
                
                return true;

            }else{

                return false;

            }

        }

    }

?>'); ?><br><br>A biblioteca possui 10 métodos:</p><ul><li>montaCaminho()</li><li>montaImagem()</li><li>defineprefixoThumb()</li><li>proporcaoImagem()</li><li>redimensionaImagem()</li><li>thumbImagem()</li><li>emoldurarImagem()</li><li>b64toImage()</li><li>imagemparab64()</li></ul>O método <code>montaCaminho()</code> espera ser passado o caminho onde a imagem será salva.<br><br>O método <code>montaImagem()</code> espera 2 parametros, o primeiro é o nome da imagem o segundo é se a imagem será criada.<br><br>O método <code>defineprefixoThumb()</code> espera ser passado o prefixo da imagem thumb, casó não seja utilizado esse método, o valor padrão será <code>thumb_</code>.<br><br>O método <code>proporcaoImagem()</code> espera 2 parametros, o primeiro é o comprimento e o segundo é a altura.<br><br>O método <code>redimensionaImagem()</code> espera 3 parametros, o primeiro é a largura, o segundo é a altura e o terceiro é se vai querer com proporção ou não, caso queira, basta passada a string <code>p</code>.<br><br>O método <code>thumbImagem()</code> espera 3 parametros, o primeiro é a largura, o segundo é a altura e o terceiro é se vai querer com proporção ou não, caso queira, basta passada a string <code>p</code>.<br><br>O método <code>emoldurarImagem()</code> espera 3 parametros, o primeiro é a largura, o segundo é a altura e o terceiro passado uma array com os valores do RGB.<br><br>O método <code>b64toImage()</code> espera ser passado o base64 da imagem.<br><br>O método <code>imagemparab64()</code> espera ser passado a imagem.<p></p></div>