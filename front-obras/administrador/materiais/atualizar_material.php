<?php
include "../../sql/conn.php";

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM materiais WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$results) {
    echo "Material não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Portal de Materiais</title>
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
        input[type="email"],
        input[type="password"],
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
        <h1>Materiais</h1>
        <h3>Atualizar Material</h3>
        <form id="updateMaterialForm" action="../../controladores/materiais/controle_materiais.php" method="POST">
            <label for="materialName">Nome:</label>
            <input type="text" id="materialName" name="nome" value="<?= htmlspecialchars($results['nome']); ?>" required>

           <!-- <label for="materialQuantity">Quantidade:</label>
            <input type="number" id="materialQuantity" name="quantidade" value="<?= $results['quantidade']; ?>" required>

            <label for="materialPrice">Preço:</label>
            <input type="number" id="materialPrice" name="preco" value="<?= $results['preco']; ?>" required>

            <label for="materialSupplier">Fornecedor:</label>
            <input type="text" id="materialSupplier" name="fornecedor" value="<?= htmlspecialchars($results['fornecedor']); ?>" required> -->

            <input type="hidden" name="id_processo" value="1">
            <input type="hidden" name="id" value="<?= htmlspecialchars($results['id']); ?>">

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>

</html>
