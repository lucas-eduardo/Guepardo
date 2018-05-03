<?php

	include_once('../config.php');

    // Define o caminho do sistema/framework    
    $system = "../core";

    if( PRODUCAO ){ // Se for produção...
		
		// Define a aplicação padrão    	
    	$application = "../dist/adminLTE";

	}else{ // Se não...

		// Define a aplicação padrão
		$application = "../app/adminLTE";

	}

    //Define os caminhos
    define( "BASE_PATH", __DIR__ );
    define( "DIRECTORY", basename( dirname( $_SERVER['PHP_SELF'] ) ) );

    // Inclue todo o framework
    require_once("../core/system/config.php");

?>