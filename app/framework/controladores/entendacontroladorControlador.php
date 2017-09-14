<?php

    class entendacontroladorControlador extends Controller{

        public function indexAcao(){

            $parametros['url']= $this->url;

			$parametros['controlador']= $this->router->controlador;
		
			$parametros['acao']= $this->router->acao;

            $this->load->visao('indexVisao.phtml', $parametros);

        }

    }

?>