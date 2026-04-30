# 🚀 API Laravel Users

Uma API RESTful moderna e robusta para gerenciamento de autenticação de usuários, desenvolvida com **Laravel 13** e **Laravel Sanctum**. Projeto criado para aprimorar habilidades em desenvolvimento backend com Laravel, pronto para ser consumido por aplicações frontend.

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Active-brightgreen?style=for-the-badge)

</div>

---

## 📋 Sumário

- [Sobre o Projeto](#sobre-o-projeto)
- [Tecnologias](#🛠-tecnologias)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Executando a API](#executando-a-api)
- [Endpoints](#endpoints)
- [Exemplos de Uso](#exemplos-de-uso)
- [Autenticação](#autenticação)
- [Testes](#testes)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Contribuindo](#contribuindo)
- [Licença](#licença)

---

## 💡 Sobre o Projeto

API REST desenvolvida com o objetivo de praticar e consolidar conhecimentos em:

- ✅ Desenvolvimento de APIs RESTful com Laravel
- ✅ Autenticação segura com JWT/Tokens (Laravel Sanctum)
- ✅ Validação de dados com Form Requests
- ✅ Estrutura MVC e padrões de design
- ✅ Boas práticas de segurança e performance
- ✅ Documentação e testes automatizados

Preparada para ser consumida por aplicações frontend modernas (React, Vue, Angular, etc).

---

## 🛠 Tecnologias

| Tecnologia | Versão | Descrição |
|-----------|--------|-----------|
| **Laravel** | ^13.0 | Framework PHP moderno |
| **PHP** | ^8.3 | Linguagem de programação |
| **Laravel Sanctum** | ^4.0 | Autenticação API com tokens |
| **Pest** | ^4.6 | Framework de testes moderno |
| **Composer** | Latest | Gerenciador de dependências PHP |

### Dependências de Desenvolvimento

- **Faker** - Geração de dados fake para testes
- **PHPUnit** - Framework de testes
- **Pint** - PHP Linter moderno
- **Collision** - Manipulador de exceções aprimorado
- **Pail** - Visualizador de logs em tempo real

---

## 📦 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP 8.3+** ([Download](https://www.php.net/downloads))
- **Composer** ([Download](https://getcomposer.org/download/))
- **Git** ([Download](https://git-scm.com/downloads))
- **SQLite** ou **MySQL/MariaDB** (opcional, para banco de dados)

### Verificar Instalação

```bash
php -v
composer -v
git -v
```

---

## 🚀 Instalação

### 1. Clonar o Repositório

```bash
git clone https://github.com/Gesshokuuyu/api-laravel-users.git
cd api-laravel-users/api-project
```

### 2. Instalar Dependências

```bash
composer install
```

### 3. Criar Arquivo .env

```bash
cp .env.example .env
```

### 4. Gerar Chave de Aplicação

```bash
php artisan key:generate
```

### 5. Criar Banco de Dados e Executar Migrations

```bash
php artisan migrate
```

### 6. (Opcional) Executar Seeders

```bash
php artisan db:seed
```

---

## ⚙️ Configuração

### Variáveis de Ambiente (.env)

```env
APP_NAME=
APP_ENV=
APP_DEBUG=
APP_KEY=base64:... # Gerado automaticamente com php artisan key:generate
APP_URL=

# Database
DB_CONNECTION=
# DB_CONNECTION=
# DB_HOST=
# DB_PORT=
# DB_DATABASE=
# DB_USERNAME=
# DB_PASSWORD=

# Sanctum (Autenticação)
SANCTUM_STATEFUL_DOMAINS=localhost:3000,localhost:8000
```

### Configuração do CORS (opcional)

Edite `config/cors.php` para permitir requisições do seu frontend:

```php
'allowed_origins' => ['http://localhost:3000'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

---

## 🎯 Executando a API

### Iniciar o Servidor de Desenvolvimento

```bash
php artisan serve
```

A API estará disponível em: **http://localhost:8000**

### Com Porta Customizada

```bash
php artisan serve --port=8001
```

---

## 🔌 Endpoints

### 📝 Autenticação

#### Registrar Novo Usuário

```http
POST /api/auth/register
Content-Type: application/json

{
  "name": "João Silva",
  "email": "joao@example.com",
  "password": "senha123456",
  "password_confirmation": "senha123456"
}
```

**Resposta (201 Created):**
```json
{
  "success": true,
  "message": "Usuário registrado com sucesso",
  "data": {
    "user": {
      "id": 1,
      "name": "João Silva",
      "email": "joao@example.com"
    },
    "token": "2|AbCdEfGhIjKlMnOpQrStUvWxYz..."
  }
}
```

---

#### Fazer Login

```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "joao@example.com",
  "password": "senha123456"
}
```

**Resposta (200 OK):**
```json
{
  "success": true,
  "message": "Login realizado com sucesso",
  "data": {
    "user": {
      "id": 1,
      "name": "João Silva",
      "email": "joao@example.com"
    },
    "token": "2|AbCdEfGhIjKlMnOpQrStUvWxYz..."
  }
}
```

---

#### Fazer Logout

```http
POST /api/auth/logout
Authorization: Bearer {token}
```

**Resposta (200 OK):**
```json
{
  "success": true,
  "message": "Logout realizado com sucesso"
}
```

---

#### Obter Usuário Autenticado

```http
GET /api/user
Authorization: Bearer {token}
```

**Resposta (200 OK):**
```json
{
  "id": 1,
  "name": "João Silva",
  "email": "joao@example.com",
  "created_at": "2026-04-28T10:30:00.000000Z",
  "updated_at": "2026-04-28T10:30:00.000000Z"
}
```

---

## 🔐 Autenticação

A API utiliza **Laravel Sanctum** para autenticação baseada em tokens (SPA & Mobile-friendly).

### Como Usar o Token

1. **Registre ou faça login** para obter o token
2. **Inclua o token** em todas as requisições protegidas no header:

```http
Authorization: Bearer {seu_token_aqui}
```

### Exemplo com JavaScript/Fetch

```javascript
const token = '2|AbCdEfGhIjKlMnOpQrStUvWxYz...';

fetch('http://localhost:8000/api/user', {
  method: 'GET',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Erro:', error));
```

### Exemplo com Axios

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    'Authorization': `Bearer ${localStorage.getItem('token')}`,
    'Content-Type': 'application/json'
  }
});

api.get('/user').then(res => console.log(res.data));
```

---

## 🧪 Testes

### Executar Todos os Testes

```bash
./vendor/bin/pest
```

### Executar Testes Específicos

```bash
./vendor/bin/pest tests/Feature/AuthTest.php
```

### Executar com Coverage

```bash
./vendor/bin/pest --coverage
```

### Visualizar Logs em Tempo Real

```bash
php artisan pail
```

---

## 📂 Estrutura do Projeto

```
api-project/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php      # Lógica de autenticação
│   │   │   └── UserController.php      # Gerenciamento de usuários
│   │   ├── Requests/
│   │   │   ├── LoginRequest.php        # Validação de login
│   │   │   ├── RegisterRequest.php     # Validação de registro
│   │   │   └── LogoutRequest.php       # Validação de logout
│   │   └── Middleware/
│   ├── Models/
│   │   └── User.php                    # Modelo de usuário
│   └── Providers/
│       └── AppServiceProvider.php      # Provedores de serviço
├── bootstrap/
│   └── app.php                         # Bootstrap da aplicação
├── config/                             # Arquivos de configuração
├── database/
│   ├── factories/                      # Factories para testes
│   ├── migrations/                     # Migrations do banco
│   └── seeders/                        # Seeders de dados
├── public/
│   └── index.php                       # Ponto de entrada
├── resources/                          # Recursos (CSS, JS, Views)
├── routes/
│   ├── api.php                         # Rotas da API
│   ├── web.php                         # Rotas web
│   └── console.php                     # Rotas console
├── storage/                            # Armazenamento de logs, cache
├── tests/                              # Testes automatizados
├── vendor/                             # Dependências do Composer
├── .env.example                        # Exemplo de variáveis de ambiente
├── composer.json                       # Dependências do projeto
├── phpunit.xml                         # Configuração de testes
└── artisan                             # CLI do Laravel
```

---

## 🤝 Contribuindo

Contribuições são bem-vindas! Para melhorias maiores, abra uma issue primeiro para discutir o que você gostaria de mudar.

### Passos para Contribuir

1. Faça um **Fork** do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um **Pull Request**

---

## 📝 Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

---

## 🙋 Suporte

Tiver dúvidas? Abra uma [Issue](https://github.com/Gesshokuuyu/api-laravel-users/issues) ou entre em contato!

---

<div align="center">

[⬆ Voltar ao Topo](#-api-laravel-users)

</div>
