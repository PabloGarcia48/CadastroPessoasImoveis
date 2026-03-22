<?php
require_once ROOT . "/app/config/database.php";
require_once ROOT . "/app/controllers/PersonController.php";

$controller = new PersonController($pdo);

if (isset($_GET["cpf"]) && $_GET["cpf"] != "") {

    $people = $controller->searchByCPF($_GET["cpf"]);
} else {

    $people = $controller->index();
}

if (isset($_POST["update"])) {
    $controller->update();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller->store();
}

if (isset($_GET["delete"])) {
    $controller->delete();
}

$editPerson = null;

if (isset($_GET["edit"])) {
    $editPerson = $controller->edit();
}

if (isset($_POST["update"])) {
    $controller->update();
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">


<div class="container">

    <div style="margin-bottom:20px;">
        <a href="/">👤 Pessoas</a> |
        <a href="/properties.php">🏠 Imóveis</a>
    </div>
    <hr>

    <h2><?= $editPerson ? "Editar Pessoa" : "Cadastrar Pessoa" ?></h2>

    <form method="POST">

        <input class="form-control" type="hidden" name="id" value="<?= $editPerson["id"] ?? "" ?>">

        <div class="form-floating mb-3">
            <input class="form-control" id="name" type="text" name="name" placeholder="Nome" required
                value="<?= $editPerson["name"] ?? "" ?>"><br>
            <label for="name">Nome</label>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" id="cpf" type="text" name="cpf" placeholder="CPF" required
                value="<?= $editPerson["cpf"] ?? "" ?>"><br>
            <label for="cpf">CPF</label>
        </div>

        <input class="form-control" type="date" name="birth_date" required
            value="<?= $editPerson["birth_date"] ?? "" ?>"><br>

        <div class="form-floating">
            <select class="form-select" id="floatingSelect" name="gender">
                <option selected>---</option>
                <option value="M" <?= (isset($editPerson) && $editPerson["gender"] == "M") ? "selected" : "" ?>>Masculino</option>
                <option value="F" <?= (isset($editPerson) && $editPerson["gender"] == "F") ? "selected" : "" ?>>Feminino</option>
            </select>
            <label for="floatingSelect">Gênero</label>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" id="phone" type="text" name="phone" placeholder="Telefone"
                value="<?= $editPerson["phone"] ?? "" ?>"><br>
            <label for="phone">Telefone</label>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" id="email" type="email" name="email" placeholder="Email"
                value="<?= $editPerson["email"] ?? "" ?>"><br>
            <label for="email">Email</label>
        </div>

        <?php if ($editPerson): ?>
            <button class="btn btn-primary" type="submit" name="update">Atualizar</button>
        <?php else: ?>
            <button class="btn btn-primary" type="submit">Salvar</button>
        <?php endif; ?>
    </form>

    <hr>

    <form method="GET" class="row mb-3">

        <div class="col">
            <input
                class="form-control"
                name="cpf"
                placeholder="Pesquisar por CPF"
                value="<?= $_GET["cpf"] ?? "" ?>">
        </div>

        <div class="col-auto">
            <button class="btn btn-primary">Buscar</button>
        </div>

        <div class="col-auto">
            <a href="/" class="btn btn-secondary">Limpar</a>
        </div>

    </form>

    <hr>

    <h3>Lista de Pessoa</h3>

    <table class="table table-striped">

        <tr>
            <th>ID:</th>
            <th>Nome:</th>
            <th>Telefone:</th>
            <th>CPF:</th>
            <th>email:</th>
            <th>Gênero</th>
            <th>Data Nascimento</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($people as $person): ?>

            <tr>

                <td><?= $person["id"] ?></td>
                <td><?= $person["name"] ?></td>
                <td><?= $person["phone"] ?></td>
                <td><?= $person["cpf"] ?></td>
                <td><?= $person["email"] ?></td>
                <td><?= $person["gender"] ?></td>
                <td><?= $person["birth_date"] ?></td>

                <td>

                    <a href="?edit=<?= $person["id"] ?>">Editar</a>

                    <a href="?delete=<?= $person["id"] ?>" onclick="return confirm('Excluir imóvel?')">
                        Excluir
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</div>