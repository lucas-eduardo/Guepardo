![CSCore Logo](https://images3.alphacoders.com/276/276219.jpg)

# Framework Guepardo #

## Sobre o Guepardo

O desenolvimento foi iniciado para auto-aprendizagem, para um melhor conhecimento com o php e saber as funcionalidades dos frameworks usando padrão MVC.
A escolha do nome ser Guepardo é por ser um dos animais mais veloz do mundo!

O framework Guepardo tem uma base forte nos frameworks [CODEIGNITER] e [COLIBRI].

Com código 100% aberto, é possível que todos possam fazer melhorias no framework, assim tornando o mesmo mais poderoso.

Atualmente o framework esta na versão 1.5.

O principal desenvolvedor foi Lucas Eduardo, que atualmente esta se formando em Ciência da Computação e possue conhecimentos em PHP, AngularJs e Jquery.

---

## Para a utilização do Framework é necessário:

- Servidor rodando Apache
- Php 5.6 ou superior
---
## Primeiros Passos

Primeiramente é preciso fazer o download do framework no github, após baixa-lo basta descompactar o mesmo no seu servidor, por exemplo:
Tenho o servidor local XAMPP, irei colocar a pasta Guepardo-master que foi descompactado dentro do meu htdocs.
Caso o link para acessar fique: http://localhost/Guepardo-master, não será necessário alterar mais nada para o funcionamento, caso o link for outro, basta abrir o arquivo ``` Guepardo-master/app/framework/config/config.php``` e você terá que alterar o link do define **```CAMINHO```** para o seu link de acesso.
Após isso ele irá abrir uma documentação do framework.

---

## Criando Controlador ( Controller )

Ao criar um controlador o mesmo deve se extender da classe do controlador principal, o **```Controller```**.
Vamos criar um controlador chamado ``` primeirocontroladorControlador.php ```, o mesmo tem que ser salvo no seguinte caminho: **```aplicacao/app/site/controladores/```**.

* **Obs: Lembrando que o caminho é somente um exemplo, todos os controladores devem ser salvos dentro da pasta controladores.**

```sh

<?php

  class primeirocontroladorControlador extends Controller{

      public function indexAcao(){

          echo "FrameWork Guepardo";

      }

  }

?> 

```

Se tudo ocorreu corretamente, basta abrir no navegador, passando o controlador, por exemplo:
```http://localhost/primeirocontrolador``` e o mesmo irá mostrar na tela: "FrameWork Guepardo".

---

## Criando Modelo ( Model )

Ao criar um modelo o mesmo deve se extender da classe do model principal, o **```GU_Model```**.
Vamos criar um modelo chamado ```primeiromodeloModelo.php```, o mesmo tem que ser salvo no seguinte caminho: **```aplicacao/app/site/modelos/primeiromodelo/```**

* **Obs: Lembrando que o caminho é somente um exemplo, todos os modelos devem ser salvos dentro da pasta modelos, subdividida com a pasta do nome do modelo.**

```sh

<?php

  class primeiromodeloModelo extends GU_Model{

      public function guepardo(){

          return echo "Guepardo - Modelo";

      }

  }

?> 

```

O modelo é carregado nos métodos dos seus controladores, para carregar o modelo no controlador basta:

```sh

<?php

  class primeirocontroladorControlador extends Controller{

      public function indexAcao(){

          // Carrega e instancia o modelo
          $this->load->modelo( 'primeiromodelo' );

          // Acessa o método que esta no modelo
          $this->primeiromodelo->guepardo();

      }

  }

?> 

```

Se tudo ocorreu corretamente, basta abrir no navegador, passando o controlador, por exemplo:
```http://localhost/primeirocontrolador``` e o mesmo irá mostrar na tela: "Guepardo - Model".

---

## Criando Visão ( View )

Ao criar uma visão, ela deve ser chamada pelo controlador para poder ser renderizada.
Para carrega a visão você deve usar o seguinte método no controlador: **```$this->load->visao('arquivo.php');```**, onde o arquivo é o nome da visão e o .php é a extensão do mesmo.

```sh

<?php

  class primeirocontroladorControlador extends Controller{

      public function indexAcao(){

          $this->load->visao('index.php');

      }

  }

?> 

```

Se tudo ocorreu corretamente, basta abrir no navegador, passando o controlador, por exemplo:
```http://localhost/primeirocontrolador``` e o mesmo irá renderizar a visão.

* **Lembrando que as visões são salvas dentro da pasta visão, exemplo: aplicacao/app/site/visao/index.php**

[CODEIGNITER]: <https://codeigniter.com/>
[COLIBRI]: <http://grupoorgany.com.br/>
