<?php
include "../sql/conn.php";

$responsavel_obra_id = $_GET['responsavel_obra_id'] ?? 2; // Example ID, replace with actual value

$stmt = $conn->prepare("
    SELECT p.*, o.nome AS obra_nome, op.nome AS operario_nome
    FROM pedidos p
    JOIN obras o ON p.obra_id = o.id
    JOIN operario op ON p.operario_id = op.id
    WHERE o.responsavel_obra_id = :responsavel_obra_id
");
$stmt->bindParam(':responsavel_obra_id', $responsavel_obra_id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("
    SELECT pe.*, o.nome AS obra_nome, op.nome AS operario_nome
    FROM pedidos_empresa pe
    JOIN obras o ON pe.obra_id = o.id
    JOIN operario op ON pe.operario_id = op.id
    WHERE o.responsavel_obra_id = :responsavel_obra_id
");
$stmt2->bindParam(':responsavel_obra_id', $responsavel_obra_id, PDO::PARAM_INT);
$stmt2->execute();

$results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Portal de Administração - Pedidos</title>
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

        h1, h2, h3 {
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

        input[type="text"], input[type="number"], button {
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

        th, td {
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
        <h1>Administração - Pedidos</h1>

        <!-- Lista de Pedidos -->
        <div id="pedidosSection">
            <h2>Lista de Pedidos</h2>
            <ul id="pedidosList"></ul>
            <h3>Adicionar Pedido</h3>
            <form id="addPedidoForm" action="../controladores/pedidos_empresa/controle_pedidos_empresas.php" method="POST">
                <label for="pedidoNome">Nome:</label>
                <input type="text" id="pedidoNome" name="nome" required>

                <label for="pedidoQuantidade">Quantidade:</label>
                <input type="number" id="pedidoQuantidade" name="quantidade" required>

                <label for="pedidoOperarioID">ID do Operário:</label>
                <input type="number" id="pedidoOperarioID" name="operario_id" required>

                <label for="pedidoObraID">ID da Obra:</label>
                <input type="number" id="pedidoObraID" name="obra_id" required>

                <label for="pedidoMarcas">Marcas:</label>
                <input type="text" id="pedidoMarcas" name="marcas" required>

                <button type="submit">Adicionar</button>
            </form>
        </div>

        <!-- Tabela de Pedidos -->
        <div id="pedidosTable">
            <h2>Pedidos</h2>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Operário</th>
                    <th>Obra</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= $row['nome']; ?></td>
                        <td><?= $row['quantidade']; ?></td>
                        <td><?= $row['operario_nome']; ?></td>
                        <td><?= $row['obra_nome']; ?></td>
                        <td>
                            <a href="../controladores/pedidos/atualizar_pedidos.php?id=<?= $row['id']; ?>&responsavel_obra_id=<?= $responsavel_obra_id; ?>">Atualizar</a>
                            |
                            <a href="../controladores/pedidos/controle_pedidos.php?id=<?= $row['id']; ?>&id_processo=2&responsavel_obra_id=<?= $responsavel_obra_id; ?>" style="color: black;">Deletar</a>
                            |
                            <button style="font-size: 12px; padding: 5px 10px;" onclick="preencherFormulario('<?= $row['nome']; ?>', '<?= $row['quantidade']; ?>', '<?= $row['operario_id']; ?>', '<?= $row['obra_id']; ?>')">Selecionar</button>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Tabela de Pedidos Empresa -->
       <!-- <div id="pedidosEmpresaTable">
            <h2>Pedidos Empresa</h2>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Operário</th>
                    <th>Obra</th>
                    <th>Marcas</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($results2 as $row) : ?>
                    <tr>
                        <td><?= $row['nome']; ?></td>
                        <td><?= $row['quantidade']; ?></td>
                        <td><?= $row['operario_nome']; ?></td>
                        <td><?= $row['obra_nome']; ?></td>
                        <td><?= $row['marcas']; ?></td>
                        <td>
                            <button onclick="preencherFormulario('<?= $row['nome']; ?>', '<?= $row['quantidade']; ?>', '<?= $row['operario_id']; ?>', '<?= $row['obra_id']; ?>', '<?= $row['marcas']; ?>')">Selecionar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table> -->
        </div>
    </div>

    <script>
        function preencherFormulario(nome, quantidade, operario_id, obra_id, marcas) {
            document.getElementById('pedidoNome').value = nome;
            document.getElementById('pedidoQuantidade').value = quantidade;
            document.getElementById('pedidoOperarioID').value = operario_id;
            document.getElementById('pedidoObraID').value = obra_id;
            document.getElementById('pedidoMarcas').value = marcas || '';
        }
    </script>
</body>

</html>
