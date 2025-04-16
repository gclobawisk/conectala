# 📘 API RESTful - Usuários

Esta é uma API RESTful desenvolvida em Laravel que permite o gerenciamento de usuários com autenticação via JWT.

## 🚀 Tecnologias

- PHP 8.2+
- Laravel 11
- MySQL
- JWT Auth (`tymon/jwt-auth`)
- Bootstrap (para visualização do Swagger-like)

---

## 🔐 Autenticação

Utilizamos JWT para autenticação. Para acessar as rotas protegidas, é necessário:

1. Fazer login e obter o token:
   - Endpoint: `POST /user/login`
   - Parâmetros:
     ```json
     {
       "email": "test@example.com",
       "password": "password"
     }
     ```
   - Retorno:
     ```json
     {
       "access_token": "seu_token_jwt",
       "token_type": "bearer",
       "expires_in": 3600
     }
     ```

2. Incluir o token no cabeçalho `Authorization` das requisições:
   ```
   Authorization: Bearer seu_token_jwt
   ```

---

## ⚙️ Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/gclobawisk/conectala
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

3. Copie o arquivo `.env.example` para `.env` e configure as variáveis:
   ```bash
   cp .env.example .env
   ```

4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

5. Configure o banco de dados no `.env`:
   ```
   DB_DATABASE=nome_do_banco
   DB_USERNAME=usuario
   DB_PASSWORD=senha
   ```

6. Rode as migrações:
   ```bash
   php artisan migrate
   ```

7. Gere a chave JWT:
   ```bash
   php artisan jwt:secret
   ```

8. Inicie o servidor:
   ```bash
   php artisan serve
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

## ✅ Testes

Para rodar os testes (caso configurados):

```bash
php artisan test
```

---

## 📚 Documentação

```
http://localhost:8000
```

---

## 📝 Licença

Este projeto está licenciado sob a Licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
