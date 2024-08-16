# Projeto Laravel Sanctum

## Tecnologias Utilizadas

- **Laravel 10**
- **PHP 8.1+**
- **Composer 2.0+**
- **MySQL 5.7+ ou MariaDB 10.3+**
- **Node.js 16.x e npm 7.x**
- **Vite** (para a compilação de assets)

## Configuração Inicial

1. **Clone o repositório e faça as configurações iniciais:**
   ```bash
   git clone ...
   cd seu-repositorio

   composer install

   npm install

   cp .env.example .env

   php artisan key:generate

## Configure o arquivo .env com as informações do seu banco de dados e outras variáveis de ambiente necessárias:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha

## Execute as migrações para criar as tabelas no banco de dados:
    php artisan migrate

## Compile os assets da aplicação usando o Vite:
    npm run build

## Inicie o servidor de desenvolvimento:
    php artisan serve

## Se precisar, execute o Vite para assistir as mudanças nos assets:
    npm run dev
