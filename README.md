# 🧰 Sistema de Gestão de Prestadores — CakePHP 2

Este projeto é um sistema completo para gerenciamento de prestadores de serviço, permitindo cadastro, edição, exclusão, importação via CSV e visualização organizada com paginação. Possui área administrativa com login seguro, listagem de prestadores, upload de foto, associação de serviços e valores, além de ferramentas auxiliares como modal de importação e exibição profissional.

---

# 🚀 Instalação do Ambiente

Antes de iniciar, certifique-se de ter instalado:

- Link para o arquivo zip do CakePhp 2 https://github.com/cakephp/cakephp/releases/tag/2.10.24
- PHP 7.2 — 7.4  
  (CakePHP 2 não funciona em PHP 8)
- MySQL 5.7+
- Apache ou Nginx (opcional)
- Composer (opcional)

---

# 📂 Clonar o Projeto

git clone: https://github.com/Heber-Wl/teste-fullstack-heber.git

---

# ⚙️ Configurar o banco de dados

CREATE DATABASE nome_do_banco CHARACTER SET utf8 COLLATE utf8_general_ci;

cp app/Config/database.php.default app/Config/database.php

public $default = array(
    'datasource' => 'Database/Mysql',
    'persistent' => false,
    'host' => 'localhost',
    'login' => 'root',
    'password' => '',
    'database' => 'nome_do_banco',
    'prefix' => '',
    'encoding' => 'utf8'
);

Rodar as Migrações e Seeder
bin/cake migrations migrate
bin/cake migrations seed

app/Config/ServicoSeedShell/.php

php app/Console/cake seed ServicoSeedShell

---

# ▶️ Iniciar o Projeto

http://localhost/seu-projeto/
php -S localhost:8000 -t app/webroot

---

# 🎥 Vídeo Explicando o Desenvolvimento
https://youtu.be/Q0JykJsIi9Y

---

🛠️ Tecnologias Utilizadas
CakePHP 2
PHP 7.4
MySQL
Bootstrap 5
DataTables
jQuery
HTML5 / CSS3
