<?php
	
	/*
	* Diretivas do framework
	*/

	// Se true, exibe informações de erro de transações do BD
	define('ERR_DB',true);

	// Se true, exibe informações de erro de conexão do BD
	define('ERR_CON',true);

	// Se true, grava logs de erro
	define('ERR_LOGS',true);

	// Define o timezone
	define("TIMEZONE", 'America/Sao_Paulo');

	// Caminho dos controladores
	define('CONTROLADORES', 'controladores/');

	// Caminho dos modelos
	define('MODELOS', 'modelos/');

	// Caminho das visões
	define('VISAO', 'visao/');

	// Caminho do ajudantes
	define('AJUDANTES','ajudantes/');

	// Permite passar automaticamente os valores da url para a visão
	define('AUTOURLPAR_VISAO',true);

	// Define o nome da sessão
	define('SESSAOAPP', '' );



	//---------------------------------------------------------------------------------------



	/*
	* Diretivas da aplicação
	*/
	define('CAMINHO','http://localhost/Guepardo-master');

	$caminho = str_replace('\\', '/', APP_PATCH);

	define('DIRETORIOAPP', $caminho);

?>