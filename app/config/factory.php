<?php

require_once __DIR__ . "/database.php";

function randomElement(array $items)
{
    return $items[array_rand($items)];
}

function generateCPF(int $index): string
{
    $base = str_pad((string) ($index + 1), 11, "0", STR_PAD_LEFT);

    return preg_replace(
        "/(\d{3})(\d{3})(\d{3})(\d{2})/",
        "$1.$2.$3-$4",
        $base
    );
}

function generatePhone(int $index): string
{
    $number = "119" . str_pad((string) (70000000 + $index), 8, "0", STR_PAD_LEFT);

    return preg_replace(
        "/(\d{2})(\d{5})(\d{4})/",
        "($1) $2-$3",
        $number
    );
}

function generateBirthDate(int $index): string
{
    $year = 1975 + ($index % 26);
    $month = str_pad((string) (($index % 12) + 1), 2, "0", STR_PAD_LEFT);
    $day = str_pad((string) (($index % 28) + 1), 2, "0", STR_PAD_LEFT);

    return "$year-$month-$day";
}

$firstNames = [
    "Ana",
    "Bruno",
    "Carlos",
    "Daniela",
    "Eduardo",
    "Fernanda",
    "Gabriel",
    "Helena",
    "Igor",
    "Juliana",
    "Kaique",
    "Larissa",
    "Marcos",
    "Natália",
    "Otávio",
    "Patrícia",
    "Rafael",
    "Sabrina",
    "Thiago",
    "Vanessa"
];

$lastNames = [
    "Silva",
    "Souza",
    "Oliveira",
    "Santos",
    "Pereira",
    "Costa",
    "Almeida",
    "Rodrigues",
    "Gomes",
    "Martins"
];

$streets = [
    "Rua das Acácias",
    "Rua Primavera",
    "Rua dos Jasmins",
    "Avenida Brasil",
    "Avenida Central",
    "Rua das Flores",
    "Rua São Jorge",
    "Rua das Laranjeiras",
    "Rua do Comércio",
    "Avenida Independência",
    "Rua Tiradentes",
    "Rua Bela Vista"
];

$neighborhoods = [
    "Centro",
    "Jardim América",
    "Bela Vista",
    "São José",
    "Vila Nova",
    "Industrial",
    "Boa Esperança",
    "Santa Rita"
];

$complements = [
    "Casa fundos",
    "Sobrado",
    "Próximo à praça",
    "Lado par",
    "Esquina",
    "Portão azul",
    "Sem complemento"
];

$genders = ["M", "F", "ND"];

$personInsert = $pdo->prepare(
    "INSERT INTO people (name, birth_date, cpf, gender, phone, email)
     VALUES (:name, :birth_date, :cpf, :gender, :phone, :email)"
);

$propertyInsert = $pdo->prepare(
    "INSERT INTO properties (street, number, neighborhood, complement, person_id)
     VALUES (:street, :number, :neighborhood, :complement, :person_id)"
);

try {
    $pdo->beginTransaction();

    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("DELETE FROM properties");
    $pdo->exec("DELETE FROM people");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    $peopleIds = [];

    for ($i = 0; $i < 20; $i++) {
        $name = $firstNames[$i] . " " . randomElement($lastNames);

        $personInsert->execute([
            "name" => $name,
            "birth_date" => generateBirthDate($i),
            "cpf" => generateCPF($i),
            "gender" => $genders[$i % count($genders)],
            "phone" => generatePhone($i),
            "email" => "pessoa" . ($i + 1) . "@example.com"
        ]);

        $peopleIds[] = (int) $pdo->lastInsertId();
    }

    for ($i = 0; $i < 40; $i++) {
        $propertyInsert->execute([
            "street" => randomElement($streets),
            "number" => (string) rand(10, 9999),
            "neighborhood" => randomElement($neighborhoods),
            "complement" => randomElement($complements),
            "person_id" => randomElement($peopleIds)
        ]);
    }

    $pdo->commit();

    echo "Factory executada com sucesso: 20 pessoas e 40 imóveis inseridos." . PHP_EOL;
} catch (Throwable $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    echo "Erro ao executar factory: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
