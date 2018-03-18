var guepardo = angular.module( "Guepardo", ['ui.bootstrap'] );

guepardo.controller('Guepardo', function($scope, $timeout){

	$scope.pp = {

		"introducao": true,
		"definindoconfig": false,
		"criandoapp": false

	};

	$scope.pd = {

		"dadoscontrolador": true,
		"parametrosurl": false,
		"caminhovisao": false

	};

	$scope.bd = {

		"introducao": true,
		"config": false,
		"insert": true,
		"insertgroup": false,
		"read": false,
		"consult": false,
		"update": false,
		"updategroup": false,
		"delete": false,
		"iniciatransacao": false,
		"enviatransacao": false,
		"desfaztransacao": false,
		"setjoin": false,
		"setfetchall": false,
		"setfetch": false,
		"setselect": false,
		"outros": false

	};

	$scope.urlca = {

		"caminho": true,
		"url": false

	};

	$scope.bli = {

		"carregando": true,
		"automatico": false,
		"chave": false,
		"redirecionador": false,
		"autenticacao": false

	};

	$scope.aju = {

		"carregando": true,
		"automatico": false

	};

	// Função que faz o scroll na tela.
	angular.element(document).ready(function () {

		$timeout(function(){

			var target_offset = $("#"+controlador.id).offset();
			var target_top = target_offset.top;
			$("html, body").animate({ scrollTop: target_top-50 }, 1000);

		}, 1000);

	});



	//----------------------------------------------------------



	// Função que altera a tab
	$scope.altera = function( identificacao, variavel ){

		angular.forEach(eval( "$scope." + variavel ), function(value, key) {
			
			if( key == identificacao ){

				eval( "$scope."+ variavel +"." + key + " = true" );

			}else{

				eval( "$scope."+ variavel +"." + key + " = false" );

			}

		});

	}

});