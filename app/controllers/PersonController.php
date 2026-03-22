<?php

require_once __DIR__ . "/../models/Person.php";

class PersonController
{
    private $person;

    public function __construct($pdo)
    {
        $this->person = new Person($pdo);
    }

    public function store()
    {
        $data = [
            "name" => $_POST["name"],
            "birth_date" => $_POST["birth_date"],
            "cpf" => $_POST["cpf"],
            "gender" => $_POST["gender"],
            "phone" => $_POST["phone"],
            "email" => $_POST["email"]
        ];

        $this->person->create($data);

        header("Location: index.php");
    }

    public function index()
    {
        return $this->person->getAll();
    }

    public function delete()
    {
        $id = $_GET["delete"];
        $this->person->delete($id);

        header("Location: index.php");
    }

    public function edit()
    {
        $id = $_GET["edit"] ?? null;
        return $this->person->find($id);
    }

    public function update()
    {
        $id = $_POST["id"];

        $data = [
            "name" => $_POST["name"],
            "birth_date" => $_POST["birth_date"],
            "cpf" => $_POST["cpf"],
            "gender" => $_POST["gender"],
            "phone" => $_POST["phone"],
            "email" => $_POST["email"]
        ];

        $this->person->update($id, $data);

        header("Location: index.php");
    }

    public function searchByCPF($cpf)
    {
        return $this->person->searchByCPF($cpf);
    }
}
