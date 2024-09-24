# API | Up Trips - Viagens e Turismo 🏝️
___
Neste projeto, será abordado o desenvolvimento da API para ser utilizada no Projeto Up Trips o projeto completo pode ser encontrado [neste link](https://github.com/PedroClemonini/projeto_uptrips).

Esta API será desenvolvida em PHP 8.2 utilizando o Framework Laravel, servidor em Ngnix e Banco de Dados em Postgress.

##  Passos para subir o container Docker 🐳:

### 1. Instalando o Docker para sistemas Linux (Exemplos feitos em Debian)
Adicione o repositório docker em sua lista de repositórios mais
[Mais informações](https://docs.docker.com/engine/install/)
```bash
$ sudo apt-get update
$ sudo apt-get install ca-certificates curl
$ sudo install -m 0755 -d /etc/apt/keyrings
$ sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
$ sudo chmod a+r /etc/apt/keyrings/docker.asc

# Add the repository to Apt sources:
$ echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
$ sudo apt-get update
```
Instale os pacotes
```bash
$ sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

### 2. Crie o (.env) do laravel
```bash
$ cd laravel-app
$ cp .env.example .env
```
### 3. Subindo o container 📦

```bash
$ cd uptrips_api
$ docker compose build
$ docker compose up -d
```

### 4. Instalando dependências
```bash
$ docker compose exec -T app composer install
```

### 5. Realizar as migrations do banco
```bash
$ docker compose exec -T app php artisan migrate
```


