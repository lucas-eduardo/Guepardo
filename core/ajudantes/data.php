<?php

	// Função que formata da data
	function convertedata( $data, $tipo )
	{

		$data = date("Y-m-d H:i:s");

		$ano= substr($data, 6);
	    $mes= substr($data, 3,-5);
	    $dia= substr($data, 0,-8);

	    switch ($tipo) {

	    	case 'br':
	    		
	    			return $dia."/".$mes."/".$ano;

	    		break;

	    	case 'us':
	    		
	    			return $ano."-".$mes."-".$dia;

	    		break;

	    }

	}

?>