# �️ Sistema de Vendas - API REST

Uma API RESTful moderna e robusta para gerenciamento completo de um sistema de vendas online, desenvolvida com **Laravel 13** e **Laravel Sanctum**. Projeto criado para aprimorar habilidades em desenvolvimento backend com Laravel, implementando autenticação, gerenciamento de produtos, carrinho de compras, pedidos e muito mais.

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Em%20Desenvolvimento-blue?style=for-the-badge)

</div>

---

## 📋 Índice

- [Sobre o Projeto](#-sobre-o-projeto)
- [Funcionalidades](#-funcionalidades)
- [Tecnologias](#-tecnologias)
- [Pré-requisitos](#-pré-requisitos)
- [Instalação](#-instalação)
- [Configuração](#-configuração)
- [Executando a API](#-executando-a-api)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Endpoints Principais](#-endpoints-principais)
- [Autenticação](#-autenticação)
- [Testes](#-testes)
- [Licença](#-licença)

---

## 💡 Sobre o Projeto

API REST desenvolvida com o objetivo de praticar e consolidar conhecimentos em desenvolvimento de sistemas complexos com Laravel. O projeto simula um e-commerce completo com funcionalidades de vendas, gestão de inventário e carrinho de compras.

**Propósito**: Estudo e aprendizado prático em:
- ✅ Desenvolvimento de APIs RESTful escaláveis
- ✅ Autenticação segura com JWT/Tokens (Laravel Sanctum)
- ✅ Modelagem de dados complexos
- ✅ Validação robusta com Form Requests
- ✅ Relacionamentos Eloquent (1:1, 1:N, N:N)
- ✅ Policies e autorização granular
- ✅ Testes automatizados com Pest
- ✅ Boas práticas de segurança e performance

---

## 🎯 Funcionalidades

### Módulo de Usuários
- 👤 Registro e login de usuários
- 🔐 Autenticação com Sanctum
- 📝 Perfil de usuário e edição de dados
- 🛡️ Controle de permissões e roles

### Módulo de Produtos
- 📦 Criação e gerenciamento de produtos
- 🏷️ Categorização e filtros
- 📊 Controle de estoque e variações
- ⭐ Sistema de avaliações

### Módulo de Carrinho de Compras
- 🛒 Adicionar/remover itens do carrinho
- 💾 Persistência de carrinho por usuário
- 🔄 Atualização de quantidade e preços

### Módulo de Pedidos
- 📋 Criação e rastreamento de pedidos
- 📍 Gerenciamento de endereços de entrega
- 🚚 Integração com transportadoras
- 📊 Histórico e auditoria de pedidos

### Módulo de Vendedores
- 👨‍💼 Gerenciamento de múltiplos vendedores
- 📈 Controle de vendas por vendedor
- 💰 Gestão de coupons e descontos

---

## 🛠️ Tecnologias

| Tecnologia | Versão | Descrição |
|-----------|--------|-----------|
| **Laravel** | ^13.0 | Framework PHP moderno |
| **PHP** | ^8.3 | Linguagem de programação |
| **MySQL** | 8.0+ | Banco de dados relacional |
| **Laravel Sanctum** | ^4.0 | Autenticação API com tokens |
| **Pest** | ^4.6 | Framework de testes moderno |
| **Composer** | Latest | Gerenciador de dependências PHP |

### Dependências Principais

- **Faker** - Geração de dados fake para testes e seeders
- **Laravel Tinker** - REPL interativo para debugging
- **Pint** - PHP Linter e formatador
- **Collision** - Manipulador de exceções aprimorado
- **Pail** - Visualizador de logs em tempo real

---

## 📦 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP 8.3+** ([Download](https://www.php.net/downloads))
- **Composer** ([Download](https://getcomposer.org/download/))
- **Git** ([Download](https://git-scm.com/downloads))
- **MySQL 8.0+** ([Download](https://www.mysql.com/downloads/)) ou **MariaDB**

### Verificar Instalação

```bash
php -v
composer -v
git -v
mysql -V
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

Copie o arquivo `.env.example` e configure as variáveis necessárias:

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

O CORS já vem pré-configurado em `config/cors.php`. Para desenvolvimento local com frontend em outra porta:

```php
// config/cors.php
'allowed_origins' => ['localhost:3000', 'localhost:5173'], // Vite, React, Vue, etc
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

---

## 📡 Endpoints Principais

### 🔑 Autenticação

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `POST` | `/api/auth/register` | Registrar novo usuário |
| `POST` | `/api/auth/login` | Fazer login |
| `POST` | `/api/auth/logout` | Fazer logout |

### 📦 Produtos

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/items` | Listar produtos |
| `GET` | `/api/items/{id}` | Detalhes do produto |
| `POST` | `/api/items` | Criar produto (Admin) |
| `PUT` | `/api/items/{id}` | Atualizar produto (Admin) |
| `DELETE` | `/api/items/{id}` | Deletar produto (Admin) |

### 🛒 Carrinho de Compras

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/shopping-cart` | Obter carrinho do usuário |
| `POST` | `/api/shopping-cart/items` | Adicionar item ao carrinho |
| `PUT` | `/api/shopping-cart/items/{id}` | Atualizar quantidade |
| `DELETE` | `/api/shopping-cart/items/{id}` | Remover item do carrinho |

### 📋 Pedidos

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/orders` | Listar pedidos do usuário |
| `POST` | `/api/orders` | Criar novo pedido |
| `GET` | `/api/orders/{id}` | Detalhes do pedido |
| `GET` | `/api/orders/{id}/items` | Itens do pedido |

### 👨‍💼 Vendedores

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/sellers` | Listar vendedores |
| `GET` | `/api/sellers/{id}` | Detalhes do vendedor |

### 📍 Endereços

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/addresses` | Listar endereços do usuário |
| `POST` | `/api/addresses` | Criar novo endereço |
| `PUT` | `/api/addresses/{id}` | Atualizar endereço |
| `DELETE` | `/api/addresses/{id}` | Deletar endereço |

---

### Exemplo de Requisição: Listar Produtos

```http
GET /api/items?page=1&per_page=15
Authorization: Bearer {token}
```

**Resposta (200 OK):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Notebook Dell XPS 13",
      "description": "Notebook de alta performance",
      "price": 5999.99,
      "stock": 15,
      "seller_id": 1,
      "created_at": "2026-04-28T10:30:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "total": 42,
    "per_page": 15
  }
}
```

---

### Exemplo de Requisição: Adicionar ao Carrinho

```http
POST /api/shopping-cart/items
Authorization: Bearer {token}
Content-Type: application/json

{
  "item_id": 1,
  "quantity": 2
}
```

**Resposta (201 Created):**
```json
{
  "success": true,
  "message": "Produto adicionado ao carrinho",
  "data": {
    "id": 15,
    "shopping_cart_id": 3,
    "item_id": 1,
    "quantity": 2,
    "unit_price": 5999.99
  }
}
```

---

### Exemplo de Requisição: Criar Pedido

```http
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

{
  "address_id": 5,
  "shipping_company_id": 2
}
```

**Resposta (201 Created):**
```json
{
  "success": true,
  "message": "Pedido criado com sucesso",
  "data": {
    "id": 123,
    "user_id": 1,
    "status": "pending",
    "total_value": 11999.98,
    "created_at": "2026-04-28T10:30:00.000000Z"
  }
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
