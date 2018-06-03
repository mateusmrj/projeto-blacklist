# Projeto Consulta de CPF em Blacklist

Projeto desenvolvido como parte do processo seletivo para o time de Backend da MaxMilhas.

## Iniciando

Estas instruções vão te orientar a criar um servidor virtual do projeto com Docker e consumir a API via URL ou formulário.


### Pré-requisitos

* Ter o [Docker](https://www.docker.com) instalado;
* Ter o [Git](https://git-scm.com) instalado;

## Estrutura do Projeto

```
.
projeto-blacklist
|-- blacklist
    +-- consulta.php
    +-- incluir.php
    +-- remover.php
    +-- status.php
|-- config
    +-- Conexao.php
|-- controller
    +-- ServerController.php
|-- db
    +-- db.sqlite3
|-- docker
    +-- Dockerfile
|-- model
    +-- BlacklistModel.php
    +-- LogsModel.php
|-- public
    |-- css
        +-- bootstrap.min.css
        +-- bootstrap.min.css.map
        +-- style.css
    +-- index.html
    |-- js
        +-- bootstrap.min.js
        +-- jquery-3.3.1.min.js
        +-- jquery.mask.js
        +-- scripts.js
+-- .gitignore
```

### Instalação

####No terminal, siga os passos abaixo:

Clone o projeto:

```
git clone https://github.com/sarahcjs/projeto-blacklist.git <nome desejado>
```

Crie uma imagem com o Dockerfile disponibilizado na pasta /docker:

```
cd /caminho/para/o/projeto/
docker build -t <nome da imagem> docker
```

Crie e execute o container, indicando qual pasta local deverá ser compatilhada:

```
docker run --name blacklist -itd -p 3000:80 -v /caminho/para/o/projeto/:/var/www/app <nome da imagem>
```

No navegador busque pelo CPF desejado via URL:

```
127.0.0.1:3000/consulta?cpf=12345678900
```

Ou via formulário disponível em:

```
127.0.0.1:3000/
```

## Construído com

* [PHP 7.0](https://php.net)
* [Nginx](https://www.nginx.org)
* [Docker](https://www.docker.com/) - Ferramenta de containerização que permite criar servidores virtuais personalizados
* [SQLite](https://www.sqlite.org) - Banco de dados embutido
* [Bootstrap 3](https://getbootstrap.com/docs/3.3/) - Framework de Frontend


## Autora

* **Sarah Carolina J. Silva** - [sarahcjs](https://github.com/sarahcjs)
