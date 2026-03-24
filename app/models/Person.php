<?php

class Person
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($data)
    {
        $sql = "INSERT INTO people (name, birth_date, cpf, gender, phone, email)
                VALUES (:name, :birth_date, :cpf, :gender, :phone, :email)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM people ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM people WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM people WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE people SET 
                name = :name,
                birth_date = :birth_date,
                cpf = :cpf,
                gender = :gender,
                phone = :phone,
                email = :email
            WHERE id = :id";

        $data["id"] = $id;

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function searchByCPF($cpf)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM people WHERE cpf LIKE ? ORDER BY id DESC"
        );

        $stmt->execute(["%$cpf%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
