<?php

class Property
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {

        $stmt = $this->pdo->query("
            SELECT properties.*, people.name AS owner
            FROM properties
            JOIN people ON properties.person_id = people.id
            ORDER BY properties.id DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {

        $stmt = $this->pdo->prepare("
            INSERT INTO properties 
            (street, number, neighborhood, complement, person_id)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data["street"],
            $data["number"],
            $data["neighborhood"],
            $data["complement"],
            $data["person_id"]
        ]);
    }

    public function delete($id)
    {

        $stmt = $this->pdo->prepare("DELETE FROM properties WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function find($id)
    {

        $stmt = $this->pdo->prepare("SELECT * FROM properties WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {

        $stmt = $this->pdo->prepare("
            UPDATE properties
            SET street=?, number=?, neighborhood=?, complement=?, person_id=?
            WHERE id=?
        ");

        return $stmt->execute([
            $data["street"],
            $data["number"],
            $data["neighborhood"],
            $data["complement"],
            $data["person_id"],
            $id
        ]);
    }

    public function searchByStreet($street)
    {
        $stmt = $this->pdo->prepare(
            "SELECT properties.*, people.name AS owner
            FROM properties
            JOIN people ON properties.person_id = people.id
            WHERE street LIKE ?
            ORDER BY properties.id DESC"
        );

        $stmt->execute(["%$street%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
