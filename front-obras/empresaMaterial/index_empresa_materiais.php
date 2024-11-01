<?php
include "../sql/conn.php";

$responsavel_obra_id = $_GET['responsavel_obra_id'] ?? 2; // Example ID, replace with actual value

// Consulta para obter os pedidos da tabela pedidos_empresa
$stmt = $conn->prepare("
    SELECT pe.*, o.nome AS obra_nome, op.nome AS operario_nome
    FROM pedidos_empresa pe
    JOIN obras o ON pe.obra_id = o.id
    JOIN operario op ON pe.operario_id = op.id
    WHERE o.responsavel_obra_id = :responsavel_obra_id
");
$stmt->bindParam(':responsavel_obra_id', $responsavel_obra_id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Administração - Pedidos</h1>
        <div id="pedidosTable">
            <h2>Pedidos Empresa</h2>
            <form id="setPricesForm" action="../controladores/pedidos_empresa/controle_pedidos_empresas.php" method="POST">
                <input type="hidden" name="id_processo" value="3">
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Operário</th>
                        <th>Obra</th>
                        <th>Marca</th>
                        <th>Preço</th>
                    </tr>
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nome']); ?></td>
                            <td><?= htmlspecialchars($row['quantidade']); ?></td>
                            <td><?= htmlspecialchars($row['operario_nome']); ?></td>
                            <td><?= htmlspecialchars($row['obra_nome']); ?></td>
                            <td><?= htmlspecialchars($row['marcas']); ?></td>
                            <td>
                                <input type="number" name="prices[<?= $row['id']; ?>]" value="<?= htmlspecialchars($row['preco']); ?>" step="0.01" min="0">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <button type="submit">Enviar Preços</button>
            </form>
        </div>
    </div>
</body>

</html>
