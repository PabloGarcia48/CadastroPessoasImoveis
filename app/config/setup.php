<?php

require_once __DIR__ . "/database.php";

$sql = "
CREATE TABLE IF NOT EXISTS people (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    birth_date DATE NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100)
);
";

try {
    $pdo->exec($sql);
    echo "Tabela criada com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$sql2 = "
CREATE TABLE IF NOT EXISTS properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(150) NOT NULL,
    number VARCHAR(10) NOT NULL,
    neighborhood VARCHAR(100) NOT NULL,
    complement VARCHAR(100),
    person_id INT NOT NULL,
    FOREIGN KEY (person_id) REFERENCES people(id)
);
";

$pdo->exec($sql2);