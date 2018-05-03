<div class="col-md-9 bibliotecas-content conteudo-lateral" ng-if="bli.phpmailer">

    <h2 class="bibliotecas-title">Biblioteca PHP Mailer</h2>

    <p class="primeirospassos-text">

        É uma biblioteca criada para envios de e-mails.

        <br><br>

        Para carregar a biblioteca, basta chamar: <code>$this->load->biblioteca('phpmailer')</code>.

        <br><br>

        Para inicar a utlização siga os passos seguintes.

        <br><br>

        <?php

            highlight_string('<?php

    class indexModelo extends GU_Model
    {


        // Método que gera a chave
        public function enviaEmail()
        {

            // Instancia a biblioteca phpmailer
            $this->load->biblioteca("phpmailer");

            // Define que a mensagem será SMTP
            $this->phpmailer->IsSMTP();

            $this->phpmailer->SMTPDebug = false;

            // Autenticação
            $this->phpmailer->SMTPAuth = true;

            // secure transfer enabled REQUIRED for Gmail
            $this->phpmailer->SMTPSecure = "ssl";

            // Endereço do servidor SMTP
            $this->phpmailer->Host = "smtp.gmail.com";

            // Porta do servidor SMTP
            $this->phpmailer->Port = 465;

            // Usuário do servidor SMTP
            $this->phpmailer->Username = "contato@guepardo.com";

            // Senha da caixa postal utilizado
            $this->phpmailer->Password = "123456";

            $this->phpmailer->From = "contato@guepardo.com";

            $this->phpmailer->FromName = "Guepardo";

            // Array dos e-mails ao qual será enviado
            $destinatarios = ["teste@gmail.com", "teste@hotmail.com"];

            foreach ( $destinatarios as $destinatario ) { // Roda um loop para os destinatarios
                
                // Adiciona o destinatario
                $this->phpmailer->AddAddress( $destinatario );

            }

            // Define que o e-mail será enviado como HTML
            $this->phpmailer->IsHTML(true);

            // Charset da mensagem (opcional)
            $this->phpmailer->CharSet = "UTF-8";

            // Assunto da mensagem
            $this->phpmailer->Subject  = "Documentação Guepardo";

            // Mensagens
            $this->phpmailer->Body = "<h1>Testando mensagem</h1>";
            $this->phpmailer->AltBody = "<h1>Testando mensagem</h1>";

            // Envio da Mensagem
            $enviado = $this->phpmailer->Send();

            // Limpa os destinatários e os anexos
            $this->phpmailer->ClearAllRecipients();
            $this->phpmailer->ClearAttachments();

            // Retorna um valor booleano do status de envio
            return $enviado;

        }

    }

?>');

        ?>

        <br><br>

        Para entender sobre os parametros, acesso: <a target="_blank" href="https://github.com/PHPMailer/PHPMailer">GITHUB PHP MAILER</a>.

    </p>

</div>