<?php

require_once __DIR__ . "/../models/Property.php";
require_once __DIR__ . "/../models/Person.php";

class PropertyController {

    private $property;
    private $person;

    public function __construct($pdo) {
        $this->property = new Property($pdo);
        $this->person = new Person($pdo);
    }

    public function index() {
        return $this->property->getAll();
    }

    public function people() {
        return $this->person->getAll();
    }

    public function store() {

        $this->property->create($_POST);

        header("Location: properties.php");
        exit;
    }

    public function delete() {

        $id = $_GET["delete"];

        $this->property->delete($id);

        header("Location: properties.php");
        exit;
    }

    public function edit() {

        $id = $_GET["edit"];

        return $this->property->find($id);
    }

    public function update() {

        $id = $_POST["id"];

        $this->property->update($id, $_POST);

        header("Location: properties.php");
        exit;
    }

        public function searchByStreet($street)
    {
        return $this->property->searchByStreet($street);
    }

}