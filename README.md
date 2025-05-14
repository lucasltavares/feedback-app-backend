
# 📝 Feedback API - Laravel 12

Sistema de API RESTful desenvolvido em **Laravel 12** para gerenciamento de feedbacks de clientes, voltado para pequenos e médios negócios. Os clientes podem deixar feedbacks por meio de um formulário, e os negócios podem visualizar e analisar esses dados de forma organizada.

---

## 🚀 Tecnologias Utilizadas

- Laravel 12
- PHP 8.3+
- Postgresql
- Docker & Docker Compose
- Swagger (L5-Swagger) para documentação da API
- Personal token Auth (Laravel sanctum)
- Social Login Oauth

---

## 📁 Estrutura do Projeto

- `app/Models` → Modelos Eloquent (`Feedback`, `Business`, `Customer`)
- `app/Http/Controllers` → Lógica dos endpoints
- `routes/api.php` → Rotas da API
- `database/migrations` → Estrutura das tabelas
- `storage/api-docs` → Arquivo gerado da documentação Swagger

---

## ⚙️ Requisitos

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- Make (opcional, para facilitar comandos)

---

## 📦 Subindo a API com Docker

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/feedback-api.git
cd feedback-api
```

### 2. Copie o `.env` de exemplo

```bash
cp .env.example .env
```

### 3. Suba os containers com Docker Compose

```bash
docker-compose up -d
```

> Se necessário, ajuste o banco de dados no `.env` (usuário, senha, host: `db`).

---

## 🔐 Autenticação

Este projeto presume que cada `Business` está autenticado e pode acessar apenas seus próprios `Feedbacks`.

Use autenticação via **Sanctum**, registre-se na rota /api/auth/register e se autentique através da rota /api/auth/login

---

## 🧪 Endpoints da API

A documentação completa está disponível via Swagger.

### 🧾 Gerar a documentação Swagger:

```bash
docker exec -it feedback-api-app php artisan l5-swagger:generate
```

### 🌐 Acessar a documentação:

Abra no navegador:

```
http://localhost/api/documentation
```

---

## 📌 Exemplo de Rotas

| Método | Rota                        | Descrição                         |
|--------|-----------------------------|-----------------------------------|
| GET    | /api/feedbacks              | Lista todos os feedbacks          |
| GET    | /api/feedbacks/{id}         | Mostra um feedback específico     |
| POST   | /api/feedbacks              | Cria um novo feedback             |
| DELETE | /api/feedbacks/{id}         | Remove um feedback (se permitido) |

---

## ✅ Testes

Você pode rodar os testes com o comando:

```bash
docker exec -it feedback-api-app php artisan test
```

---

## 📂 Ambiente de Desenvolvimento Local

Se preferir rodar localmente sem Docker:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## 🧑‍💻 Contribuição

Sinta-se livre para abrir *issues* e *pull requests*. Sugestões de melhorias são sempre bem-vindas!

---

## 📝 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

## 💡 Sobre o Projeto

O objetivo desta API é oferecer uma base sólida para digitalização da coleta de feedbacks em comércios físicos, oferecendo insights e dados acionáveis para o empreendedor tomar decisões melhores.
