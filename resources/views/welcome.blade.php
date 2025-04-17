<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Documentação API</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .method-box {
      border-left: 5px solid;
      padding: 1rem;
      margin-bottom: 1rem;
    }

    .method-GET { border-color: #0d6efd; background-color: #e7f1ff; }
    .method-POST { border-color: #198754; background-color: #e9f8f1; }
    .method-PUT { border-color: #ffc107; background-color: #fff9e6; }
    .method-DELETE { border-color: #dc3545; background-color: #fdecea; }
    
    /* Aplica cor de fundo completa com base no método */
    .method-GET .accordion-button { background-color: #e7f1ff; border-left: 4px solid #0d6efd; }
    .method-POST .accordion-button { background-color: #e9f8f1; border-left: 4px solid #198754; }
    .method-PUT .accordion-button { background-color: #fff9e6; border-left: 4px solid #ffc107; }
    .method-DELETE .accordion-button { background-color: #fdecea; border-left: 4px solid #dc3545; }

    /* Aumenta contraste ao expandir */
    .accordion-button:not(.collapsed) {
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }

    pre {
      background: #f8f9fa;
      padding: 0.75rem;
      border-radius: 6px;
      font-size: 0.9rem;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-4">
  <h2 class="mb-4">📘 API - Operações sobre usuários</h2>

  <div class="accordion" id="apiAccordion">

     <!-- POST /user/login -->
     <div class="accordion-item method-GET">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#loginUser">
          <strong>POST</strong> /user/login — Fazer login
        </button>
      </h2>
      <div id="loginUser" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
        <div class="accordion-body">
          <p><strong>Entrada:</strong></p>
          <pre>{
              "email": "test@example.com",
              "password": "password"
            }</pre>

                      <p><strong>Saída:</strong></p>
                      <pre>{
              "token": "eyJ0eXAiOiJKV1QiLCJh..."
            }</pre>
        </div>
      </div>
    </div>

    <!-- POST /user -->
    <div class="accordion-item method-POST">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#createUser">
          <strong>POST</strong> /user — Criar usuário
        </button>
      </h2>
      <div id="createUser" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
        <div class="accordion-body">
          <p><strong>Entrada:</strong></p>
          <pre>{
  "name": "João Silva",
  "email": "joao@email.com",
  "password": "12345678"
}</pre>

          <p><strong>Saída:</strong></p>
          <pre>{
  "message": "Usuário criado com sucesso",
  "user": {
    "id": 1,
    "name": "João Silva",
    "email": "joao@email.com",
    "created_at": "2025-04-16T12:00:00Z"
  }
}</pre>
        </div>
      </div>
    </div>

    <!-- GET /user/{id} -->
    <div class="accordion-item method-GET">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#getUser">
          <strong>GET</strong> /user/{id} — Obter usuário
        </button>
      </h2>
      <div id="getUser" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
        <div class="accordion-body">
          <p><strong>Saída:</strong></p>
          <pre>{
            "id": 1,
            "name": "João Silva",
            "email": "joao@email.com",
            "created_at": "2025-04-16T12:00:00Z"
          }</pre>
        </div>
      </div>
    </div>

    <!-- PUT /user/{id} -->
    <div class="accordion-item method-PUT">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#updateUser">
          <strong>PUT</strong> /user/{id} — Atualizar usuário
        </button>
      </h2>
      <div id="updateUser" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
        <div class="accordion-body">
          <p><strong>Entrada:</strong></p>
          <pre>{
            "name": "João Atualizado",
            "email": "joao@email.com"
            "password": "novasenha99@"  // Opcional
          }</pre>
          <p><strong>Saída:</strong></p>
          <pre>{
            "message": "Usuário atualizado com sucesso",
            "user": {
              "id": 1,
              "name": "João Atualizado",
              "email": "joao@email.com"
            }
          }</pre>
        </div>
      </div>
    </div>

    <!-- DELETE /user/{id} -->
    <div class="accordion-item method-DELETE">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#deleteUser">
          <strong>DELETE</strong> /user/{id} — Deletar usuário
        </button>
      </h2>
      <div id="deleteUser" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
        <div class="accordion-body">
          <p><strong>Saída:</strong></p>
          <pre>{
            "message": "Usuário deletado com sucesso"
          }</pre>
        </div>
      </div>
    </div>

   

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
