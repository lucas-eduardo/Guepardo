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
Caso o link para acessar fique: http://localhost/Guepardo-master, não será necessário alterar mais nada para o funcionamento, caso o link for outro, basta abrir o arquivo ``` Guepardo-master/app/framework/config/config.php``` e você terá que alterar o link do define **CAMINHO** para o seu link de acesso.
Após isso ele irá abrir uma documentação do framework.

---

## Criando Controlador ( Controller )

Ao criar um controlador o mesmo deve se extender da classe do controlador principal, o **Controller**.
Vamos criar um controlador chamado ``` primeirocontroladorControlador.php ```, o mesmo tem que ser salvo no seguinte caminho: **aplicacao/app/site/controladores/**.

**Obs: Lembrando que o caminho é somente um exemplo, todos os controladores devem ser salvos dentro da pasta controladores.**

[CODEIGNITER]: <https://codeigniter.com/>
[COLIBRI]: <http://grupoorgany.com.br/>
