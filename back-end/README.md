>This is a challenge by Coodesh

# Projeto Laravel

Este é um projeto Laravel desenvolvido utilizando PHP 8.3.1. O Laravel é um framework PHP moderno e elegante que facilita o desenvolvimento de aplicativos web robustos e escaláveis.

## Requisitos

Antes de começar, certifique-se de que o seu ambiente atende aos seguintes requisitos:

- PHP 8.3.1
- Composer
- Banco de dados MySQL

## Instalação

Siga estas etapas para configurar e instalar o projeto:

1. Clone o repositório:

    ```bash
    git clone https://github.com/matheush-a/coodesh-full-stack.git
    ```
   
 2. Entre no diretório back-end
 
    ```bash
    cd back-end
    ```
    
3. Instale as dependências
 
    ```bash
    composer install
    ```
    
4. Configure o arquivo .env

5. Crie a chave da aplicação

    ```bash
    php artisan key:generate
    ```
    
5. Execute as migrations

    ```bash
    php artisan migrate
    ```

7. Para executar os testes unitários

    ```bash
    php artisan test
    ```
    
8. Para executar o servidor da aplicação

    ```bash
    php artisan serve
    ```
    
Ao executar o servidor da aplicação você deve estar apto(a) a acessar a API através do endereço http://localhost:8000/ ou através de seu IP local preferido, sugestão: http://127.0.0.1:8000/

As resições podem ser testadas através do seguinte link: https://www.postman.com/orange-desert-796995/workspace/onfly/collection/7548375-a4271bb7-72b0-43eb-9422-dc3ee622e450?action=share&creator=7548375
