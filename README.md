
# 📘 API RESTful - Usuários

Esta é uma API RESTful desenvolvida em Laravel que permite o gerenciamento de usuários com autenticação via JWT.

---

## 🚀 Tecnologias

- PHP 8.2+
- Laravel 11
- MySQL
- JWT Auth (`tymon/jwt-auth`)
- Bootstrap (para visualização do Swagger-like)
- Docker

---

## 🔐 Autenticação

Utilizamos JWT para autenticação. Para acessar as rotas protegidas, é necessário:

### 1. Fazer login e obter o token

- **Endpoint:** `POST /user/login`
- **Parâmetros:**
  ```json
  {
    "email": "test@example.com",
    "password": "password"
  }
  ```
- **Retorno:**
  ```json
  {
    "access_token": "seu_token_jwt",
    "token_type": "bearer",
    "expires_in": 3600
  }
  ```

### 2. Incluir o token no cabeçalho das requisições

```
Authorization: Bearer seu_token_jwt
```

---

## ⚙️ Instalação Manual

```bash
git clone https://github.com/gclobawisk/conectala
cd conectala
composer install
cp .env.example .env
php artisan key:generate
```

Edite as variáveis de banco no arquivo `.env`:

```env
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

Execute as migrations, seeders e gere o JWT secret:

```bash
php artisan migrate
php artisan db:seed
php artisan jwt:secret
php artisan serve
```

---

## 🐳 Utilizando Docker

1. Suba os containers:

```bash
docker-compose up -d --build
```

2. Acesse o container da aplicação:

```bash
docker exec -it conectala-app bash
```

3. Execute os comandos dentro do container:

```bash
php artisan migrate
php artisan db:seed
php artisan jwt:secret
```

---

## 📌 Rotas da API

| Método | Endpoint         | Descrição                                                 |
|--------|------------------|-----------------------------------------------------------|
| POST   | `/user`          | Criar novo usuário                                        |
| GET    | `/user/{id}`     | Obter usuário por ID                                      |
| PUT    | `/user/{id}`     | Atualizar dados do usuário (opcional: senha)             |
| DELETE | `/user/{id}`     | Remover usuário                                           |
| POST   | `/user/login`    | Autenticação e obtenção de token JWT                     |
| GET    | `/user/logout`   | Encerrar sessão (token)                                   |

---

## 🧪 Exemplo de entrada (POST `/user`)

### Requisição:

```json
{
  "name": "João Silva",
  "email": "joao@email.com",
  "password": "Senha@123"
}
```

### Resposta:

```json
{
  "id": 1,
  "name": "João Silva",
  "email": "joao@email.com",
  "created_at": "2025-04-16T12:00:00Z"
}
```

---

## 📋 Exemplo de Requisição Protegida

```bash
curl -H "Authorization: Bearer seu_token_jwt" http://localhost:8000/api/user/1
```

---

## 📚 Documentação

Acesse via navegador:

```
http://localhost:8000
```

---

## 📝 Licença

Este projeto está licenciado sob a Licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
