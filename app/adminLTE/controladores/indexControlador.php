<?php

    class indexControlador extends Controller
    {

        public function indexAcao()
        {

        	$this->load->modelo('index');

        	$parametros['titulo'] = "Dashboard";
        	$parametros['subtitulo'] = "Painel de controle";
        	$parametros['brad'] = $this->index->brad();

            $this->load->view('indexVisao.phtml', $parametros);

        }

    }

?>