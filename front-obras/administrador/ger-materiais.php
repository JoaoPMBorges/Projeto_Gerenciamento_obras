<?php
include "../sql/conn.php";

$stmt = $conn->prepare("SELECT * FROM materiais");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Portal de Administração</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
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
        input[type="number"],
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

        .actions {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Administração</h1>

        <!-- Formulário para adicionar material -->
        <div id="materialSection">
            <h2>Adicionar Material</h2>
            <form id="addMaterialForm" action="../controladores/materiais/controle_materiais.php" method="POST">
                <label for="materialName">Nome:</label>
                <input type="text" id="materialName" name="nome" required>

                <!-- 
                <label for="materialQuantity">Quantidade:</label>
                <input type="number" id="materialQuantity" name="quantidade" required>

                <label for="materialPrice">Preço:</label>
                <input type="number" id="materialPrice" name="preco" required>

                <label for="materialSupplier">Fornecedor:</label>
                <input type="text" id="materialSupplier" name="fornecedor" required> 
                -->

                <input type="hidden" name="id_processo" value="0">

                <button type="submit">Adicionar</button>
            </form>
        </div>

        <!-- Tabela de Materiais -->
        <div id="materialTable">
            <h2>Materiais</h2>
            <table>
                <tr>
                    <th>Nome</th>
                    <!-- <th>Quantidade</th> -->
                    <th class="actions">Ações</th>
                </tr>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= $row['nome']; ?></td>
                        <!-- <td><?= $row['quantidade']; ?></td> -->
                        <td class="actions">
                            <a href="materiais/atualizar_material.php?id=<?= $row['id']; ?>" style="color: black;">Atualizar</a>
                            |
                            <a href="../controladores/materiais/controle_materiais.php?id=<?= $row['id']; ?>&id_processo=2" style="color: black;">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>
