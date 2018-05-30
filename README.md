# Projeto Consulta de CPF em Blacklist

Projeto desenvolvido como parte do processo seletivo para o time de Backend da MaxMilhas.

## Iniciando

Estas instruções vão te orientar a criar um servidor virtual do projeto com Docker e consumir a API via URL ou formulário.


### Pré-requisitos

* Ter o [Docker](https://www.docker.com) instalado;
* Ter o [Nginx](https://www.nginx.org) instalado;

### Instalação

Clone o projeto:

```
git clone https://github.com/sarahcjs/projeto-blacklist.git 
```

Instale as dependências:

```
cd /caminho/para/o/server
docker run -d -p 3000:80 --name webserver nginx
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

* [PHP 7.2.6](https://php.net)
* [Docker](https://www.docker.com/) - Ferramenta de containerização que permite criar servidores virtuais personalizados
* [SQLite](https://www.sqlite.org) - Framework de Frontend
* [Bootstrap 3](https://getbootstrap.com/docs/3.3/) - Framework de Frontend


## Autora

* **Sarah Carolina J. Silva** - [sarahcjs](https://github.com/sarahcjs)
