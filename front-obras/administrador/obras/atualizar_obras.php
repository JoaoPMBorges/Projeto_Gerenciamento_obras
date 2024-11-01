<?php
include "../../sql/conn.php";

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM obras WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$results) {
    echo "Obra não encontrada!";
    exit;
}
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

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
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
        <h1>Administração</h1>
        <h3>Atualizar Obra</h3>
        <form id="updateObraForm" action="../../controladores/obras/ControleObras.php" method="POST">
            <label for="obraName">Nome da Obra:</label>
            <input type="text" id="obraName" name="nome" value="<?= htmlspecialchars($results['nome']); ?>" required>

            <label for="obraEndereco">Endereço:</label>
            <input type="text" id="obraEndereco" name="endereco" value="<?= htmlspecialchars($results['endereco']); ?>" required>

            <label for="obraStartDate">Data de Início:</label>
            <input type="date" id="obraStartDate" name="data_inicio" value="<?= $results['data_inicio']; ?>" required>

            <label for="obraEndDate">Data de Conclusão:</label>
            <input type="date" id="obraEndDate" name="data_conclusao" value="<?= $results['data_conclusao']; ?>" required>

            <label for="obraResponsavel">ID do Responsável:</label>
            <input type="number" id="obraResponsavel" name="responsavel_obra_id" value="<?= $results['responsavel_obra_id']; ?>" required>

            <input type="hidden" name="id_processo" value="1">
            <input type="hidden" name="id" value="<?= htmlspecialchars($results['id']); ?>">

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>

</html>
