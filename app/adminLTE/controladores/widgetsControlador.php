<?php

	/**
	* 
	*/
	class widgetsControlador extends Controller
	{
		
		public function indexAcao()
		{
			
			$this->load->modelo('widgets');

        	$parametros['titulo'] = "Widgets";
        	$parametros['subtitulo'] = "Página de pré-visualização";
        	$parametros['brad'] = $this->widgets->brad();

            $this->load->view('indexVisao.phtml', $parametros);

		}

	}

?>