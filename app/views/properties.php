<?php

require_once ROOT . "/app/config/database.php";
require_once ROOT . "/app/controllers/PropertyController.php";

$controller = new PropertyController($pdo);

if (isset($_GET["street"]) && $_GET["street"] != "") {

    $properties = $controller->searchByStreet($_GET["street"]);
} else {

    $properties = $controller->index();
}

if (isset($_GET["delete"])) {
    $controller->delete();
}

$editProperty = null;

if (isset($_GET["edit"])) {
    $editProperty = $controller->edit();
}

if (isset($_POST["update"])) {
    $controller->update();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller->store();
}

// $properties = $controller->index();
$people = $controller->people();

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">

<div class="container mt-4">

    <div style="margin-bottom:20px;">
        <a href="/">👤 Pessoas</a> |
        <a href="/properties.php">🏠 Imóveis</a>
    </div>
    <hr>

    <h2>Cadastro de Imóveis</h2>

    <form method="POST">



        <input type="hidden" name="id" value="<?= $editProperty["id"] ?? "" ?>">

        <div class="form-floating mb-3">
            <input class="form-control" name="street" id="street" placeholder="Logradouro" value="<?= $editProperty["street"] ?? "" ?>" required>
            <label for="street">Logradouro</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" name="number" id="number" placeholder="Número" value="<?= $editProperty["number"] ?? "" ?>" required>
            <label for="number">Número</label>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" name="neighborhood" id="neighborhood" placeholder="Bairro" value="<?= $editProperty["neighborhood"] ?? "" ?>" required>
            <label for="neighborhood">Bairro</label>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" name="complement" id="complement" placeholder="Complemento" value="<?= $editProperty["complement"] ?? "" ?>">
            <label for="complement">Complemento</label>
        </div>

        <select name="person_id" required>

            <option value="">Selecione o proprietário</option>

            <?php foreach ($people as $person): ?>

                <option
                    value="<?= $person["id"] ?>"
                    <?= isset($editProperty) && $editProperty["person_id"] == $person["id"] ? "selected" : "" ?>>

                    <?= $person["name"] ?>

                </option>

            <?php endforeach; ?>

        </select>

        <button class="btn btn-primary" type="submit" name="<?= $editProperty ? "update" : "create" ?>">

            <?= $editProperty ? "Atualizar" : "Cadastrar" ?>

        </button>

    </form>

    <hr>

    <form method="GET" class="row mb-3">

        <div class="col">
            <div class="form-floating mb-3">
                <input
                    class="form-control"
                    name="street"
                    id="searchStreet"
                    placeholder="Pesquisar por Logradouro"
                    value="<?= $_GET["street"] ?? "" ?>">
                <label for="searchStreet">Pesquisar por Logradouro</label>
            </div>
        </div>

        <div class="col-auto">
            <button class="btn btn-primary">Buscar</button>
        </div>

        <div class="col-auto">
            <a href="/properties.php" class="btn btn-secondary">Limpar</a>
        </div>

    </form>

    <hr>

    <h3>Lista de Imóveis</h3>

    <table class="table table-striped">

        <tr>
            <th>Inscrição Municipal</th>
            <th>Logradouro</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Complemento</th>
            <th>Proprietário</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($properties as $property): ?>

            <tr>

                <td><?= $property["id"] ?></td>
                <td><?= $property["street"] ?></td>
                <td><?= $property["number"] ?></td>
                <td><?= $property["neighborhood"] ?></td>
                <td><?= $property["complement"] ?></td>
                <td><?= $property["owner"] ?></td>

                <td>

                    <a href="?edit=<?= $property["id"] ?>">Editar</a>

                    <a href="?delete=<?= $property["id"] ?>" onclick="return confirm('Excluir imóvel?')">
                        Excluir
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</div>