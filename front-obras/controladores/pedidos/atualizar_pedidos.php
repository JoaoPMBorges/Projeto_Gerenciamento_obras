<?php
include "../../sql/conn.php";

$id = $_GET["id"];
$responsavel_obra_id = $_GET["responsavel_obra_id"];

$stmt = $conn->prepare("SELECT * FROM pedidos WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$results) {
    echo "Pedido não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Portal de Administração - Atualizar Pedido</title>
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

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Administração - Atualizar Pedido</h1>
        <form id="updatePedidoForm" action="controle_pedidos.php" method="POST">
            <label for="pedidoNome">Nome:</label>
            <input type="text" id="pedidoNome" name="nome" value="<?= htmlspecialchars($results['nome']); ?>" required>

            <label for="pedidoQuantidade">Quantidade:</label>
            <input type="number" id="pedidoQuantidade" name="quantidade" value="<?= htmlspecialchars($results['quantidade']); ?>" required>

            <label for="pedidoOperarioID">ID do Operário:</label>
            <input type="number" id="pedidoOperarioID" name="operario_id" value="<?= htmlspecialchars($results['operario_id']); ?>" required>

            <label for="pedidoObraID">ID da Obra:</label>
            <input type="number" id="pedidoObraID" name="obra_id" value="<?= htmlspecialchars($results['obra_id']); ?>" required>

            <input type="hidden" name="id_processo" value="1">
            <input type="hidden" name="id" value="<?= htmlspecialchars($results['id']); ?>">
            <input type="hidden" name="responsavel_obra_id" value="<?= htmlspecialchars($responsavel_obra_id); ?>">

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>

</html>
