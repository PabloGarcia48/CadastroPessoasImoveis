# 🏠 Sistema de Cadastro Imobiliário

Este projeto é um sistema web simples para **cadastro e gerenciamento de pessoas e imóveis**, desenvolvido em **PHP** com **MySQL** no backend e **HTML**, **CSS**, **JavaScript** e **Bootstrap** no frontend.

O sistema permite cadastrar pessoas (com CPF) e associar imóveis a essas pessoas, simulando um cadastro imobiliário básico.

---

## 🚀 Tecnologias Utilizadas

* PHP (backend)
* MySQL (banco de dados)
* HTML / CSS / JavaScript
* Bootstrap (estilização)
* PDO para conexão com banco
* Servidor embutido do PHP

---

## 📋 Funcionalidades

### 👤 Pessoas

* Cadastrar pessoa
* Editar pessoa
* Excluir pessoa
* Listar pessoas
* Buscar pessoa por CPF

### 🏠 Imóveis

* Cadastrar imóvel
* Editar imóvel
* Excluir imóvel
* Listar imóveis
* Filtrar imóveis por **logradouro**
* Relacionamento entre **imóvel e proprietário**

---

## 🗄 Banco de Dados

O sistema utiliza **MySQL**.

As tabelas são criadas automaticamente através do arquivo:

```
setup.php
```

---

## ⚙️ Como executar o projeto

### 1️⃣ Clonar o repositório

```bash
git clone https://github.com/PabloGarcia48/CadastroPessoasImoveis.git
```

Entre na pasta do projeto:

```bash
cd nome-do-projeto
```

---

### 2️⃣ Criar o banco de dados

No MySQL crie um banco de dados:

```sql
CREATE DATABASE cadastro_imobiliario;
```

---

### 3️⃣ Configurar a conexão com o banco

Abra o arquivo:

```
config/database.php
```

Configure os dados de acesso ao MySQL se necessário:

```php
$host = "127.0.0.1";
$db   = "cadastro_imobiliario";
$user = "root";
$pass = "";
```

---

### 4️⃣ Criar as tabelas

Execute o arquivo:

```
setup.php
```

Você pode abrir no navegador:

```
http://localhost:8000/setup.php
```

Ou executar manualmente.

---

### 5️⃣ Iniciar o servidor PHP

Na raiz do projeto execute:

```bash
php -S localhost:8000 -t public
```

---

### 6️⃣ Acessar o sistema

Abra no navegador:

```
http://localhost:8000
```

---

### 7️⃣ Popular banco de dados (opcional)

Pare o servidor, execute o arquivo:

```
factory.php
```

---

## 📂 Estrutura do Projeto

```
app
 ├── config
 ├      ├── database.php
        ├── factory.php
        ├── setup.php
 ├── controllers
 ├── models
 └── views

public
 ├── index.php
 └── properties.php
```

O projeto segue uma estrutura **MVC simplificada**:

* **Models** → acesso ao banco de dados
* **Controllers** → lógica da aplicação
* **Views** → interface com o usuário

---

## 👨‍💻 Autor

Pablo Garcia
