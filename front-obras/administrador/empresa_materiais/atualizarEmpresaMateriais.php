<?php
include "../../sql/conn.php";

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM empresa_materiais WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$results) {
    echo "Empresa de materiais não encontrada!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

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
        <h1>Empresas de Materiais</h1>
        <h3>Atualizar Empresa de Materiais</h3>
        <form id="updateEmpresaMateriaisForm" action="../../controladores/empresa_materiais/controleEmpresaMateriais.php" method="POST">
            <label for="empresaNome">Nome:</label>
            <input type="text" id="empresaNome" name="nome" value="<?= htmlspecialchars($results['nome']); ?>" required>

            <label for="empresaNomeFantasia">Nome Fantasia:</label>
            <input type="text" id="empresaNomeFantasia" name="nome_fantasia" value="<?= htmlspecialchars($results['nome_fantasia']); ?>" required>

            <label for="empresaCNPJ">CNPJ:</label>
            <input type="text" id="empresaCNPJ" name="cnpj" value="<?= htmlspecialchars($results['cnpj']); ?>" required>

            <label for="empresaEndereco">Endereço:</label>
            <input type="text" id="empresaEndereco" name="endereco" value="<?= htmlspecialchars($results['endereco']); ?>" required>

            <label for="empresaTelefone">Telefone:</label>
            <input type="text" id="empresaTelefone" name="telefone" value="<?= htmlspecialchars($results['telefone']); ?>" required>

            <label for="empresaEmail">Email:</label>
            <input type="email" id="empresaEmail" name="email" value="<?= htmlspecialchars($results['email']); ?>" required>

            <input type="hidden" name="id_processo" value="1">
            <input type="hidden" name="id" value="<?= htmlspecialchars($results['id']); ?>">

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>

</html>
