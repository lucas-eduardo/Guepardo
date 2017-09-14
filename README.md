![CSCore Logo](https://images3.alphacoders.com/276/276219.jpg)

# Framework Guepardo #

## Para a utilização do Framework é necessário:

- Servidor rodando Apache
- Php 5.6 ou superior
---
## Primeiros Passos

Primeiramente é preciso fazer o download do framework no github, após baixa-lo basta descompactar o mesmo no seu servidor, por exemplo:
Tenho o servidor local XAMPP, irei colocar a pasta Guepardo-master que foi descompactado dentro do meu htdocs.
Caso o link para acessar fique: http://localhost/Guepardo-master, não será necessário alterar mais nada para o funcionamento, caso o link for outro, basta abrir o arquivo ```sh Guepardo-master/app/framework/config/config.php``` e você terá que alterar o link do define CAMINHO para o seu link de acesso.
Após isso ele irá abrir uma documentação do framework.
---
## No seu controlador angular, você fará o seguinte:
```sh
angular.module( "MyApp", ["uiCropper"] ).controller( "MyApp_ctrl", ["$scope", function(){

    $scope.imagemcrop = "";
    $scope.minhaimagem = "";
    
    $scope.blockingObject = {block:true};
		$scope.callTestFuntion = function(){
		$scope.blockingObject.render(function(dataURL){
		console.log('via render');
		console.log(dataURL.length);
		});
	}

	$scope.blockingObject.callback=function(dataURL){
		console.log('via function');
		console.log(dataURL.length);
	}


	var handleFileSelect=function(evt) {
		var file=evt.currentTarget.files[0];
		var reader = new FileReader();
		reader.onload = function (evt) {
			$scope.$apply(function($scope){
				$scope.myImage=evt.target.result;
			});
		};
		reader.readAsDataURL(file);
	};
	angular.element(document.querySelector('#fileInput')).on('change',handleFileSelect);

}]);
```
---
Com esse código já é possível estar utilizando o JCrop, agora no HTML você fará assim:

* Adiciona um input para conseguir subir as imagens, adicionadando o id fileInput.
```sh
<input type="file" id="fileInput" accept="image/*" class="hidden" />
```
---
* Depois pode estar colocando um botão para recortar a imagem:
```sh
<button type="button" ng-click="callTestFuntion()">Cortar</button>
```
---
* Em seguida adiciona uma div com a classe cropArea e dentro dela a imagem que você subiu, no caso estaremos cortando a imagem para 120 x 120:
```sh
<div class="cropArea">

  <ui-cropper image="minhaimagem" area-type="rectangle" result-image="imagemcrop" live-view="blockingObject" result-image-size="120" area-init-size="{w:120,h:120}" aspect-ratio="1"></ui-cropper>

</div>
```
---
* Depois disso, basta colocar um img para exibir a imagem recortada:
```sh
<img class="img-responsive img-thumbnail" />
```
---
# Observação para utilizar a área de corte em proporção em relação ao cropArea:
* Dividimos o comprimento (width) pela altura (height) do cropArea, assim obtemos o valor para aplicar no atributo aspect-ratio.
- Exemplo: Você quer que a imagem seja salva em 1600x650px, o cropArea esta dividido por 2 (800x325). Basta então fazer: 1600 / 650, que o mesmo irá dar o valor de 2.46153846154, e esse será o seu aspect-ratio. Para ficar mais elegante a ferramenta de corte, ela será divido por 3, 800 / 3 e 325 / 3 = 400x162,5px, sendo colocado no atributo area-init-size.

[JCrop]: <https://github.com/CrackerakiUA/ui-cropper>
