<?php
include "../../sql/conn.php";

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM responsavel_obra WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$results) {
    echo "Responsável pela Obra não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Portal de Responsáveis pela Obra</title>
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Responsáveis pela Obra</h1>
        <h3>Atualizar Responsável pela Obra</h3>
        <form id="updateResponsavelObraForm" action="../../controladores/responsavel_obra/controle_responsavel_obra.php" method="POST">
            <label for="responsavelObraNome">Nome:</label>
            <input type="text" id="responsavelObraNome" name="nome" value="<?= htmlspecialchars($results['nome']); ?>" required>

            <label for="responsavelObraEndereco">Endereço:</label>
            <input type="text" id="responsavelObraEndereco" name="endereco" value="<?= htmlspecialchars($results['endereco']); ?>" required>

            <label for="responsavelObraTelefone">Telefone:</label>
            <input type="text" id="responsavelObraTelefone" name="telefone" value="<?= htmlspecialchars($results['telefone']); ?>" required>

            <label for="responsavelObraEmail">Email:</label>
            <input type="email" id="responsavelObraEmail" name="email" value="<?= htmlspecialchars($results['email']); ?>" required>

            <input type="hidden" name="id_processo" value="1">
            <input type="hidden" name="id" value="<?= htmlspecialchars($results['id']); ?>">

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>

</html>
