<?php
include "../sql/conn.php";

$stmt = $conn->prepare("SELECT * FROM empresa_materiais");
$stmt->execute();

$results = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

    <title>Portal de Empresas de Materiais</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 1010px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3 {
            color: #333;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        button {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Empresas de Materiais</h1>

        <!-- Lista de Empresas de Materiais -->
        <div id="empresaMateriaisSection">
            <h2>Lista de Empresas</h2>
            <ul id="empresaMateriaisList"></ul>
            <h3>Adicionar Empresa</h3>
            <form id="addEmpresaMateriaisForm" action="../controladores/empresa_materiais/controleEmpresaMateriais.php" method="POST">
                <label for="empresaNome">Nome:</label>
                <input type="text" id="empresaNome" name="nome" required>

                <label for="empresaNomeFantasia">Nome Fantasia:</label>
                <input type="text" id="empresaNomeFantasia" name="nome_fantasia" required>

                <label for="empresaCNPJ">CNPJ:</label>
                <input type="text" id="empresaCNPJ" name="cnpj" required>

                <label for="empresaEndereco">Endereço:</label>
                <input type="text" id="empresaEndereco" name="endereco" required>

                <label for="empresaTelefone">Telefone:</label>
                <input type="text" id="empresaTelefone" name="telefone" required>

                <label for="empresaEmail">Email:</label>
                <input type="email" id="empresaEmail" name="email" required>

                <input type="hidden" name="id_processo" value="0">

                <button type="submit">Adicionar</button>
            </form>


        </div>

        <div id="availabilitySection">
            <h2>Empresas de Materiais</h2>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= $row['nome']; ?></td>
                        <td><?= $row['nome_fantasia']; ?></td>
                        <td><?= $row['cnpj']; ?></td>
                        <td><?= $row['endereco']; ?></td>
                        <td><?= $row['telefone']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <a href="empresa_materiais/atualizarEmpresaMateriais.php?id=<?= $row['id']; ?>" style="color: black;">Atualizar</a>
                            |
                            <a href="../controladores/empresa_materiais/controleEmpresaMateriais.php?id=<?= $row['id']; ?>&id_processo=2" style="color: black;">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>