<?php
include "../../sql/conn.php";

// Consulta para obter todas as obras disponíveis
$stmt_obras = $conn->prepare("SELECT id, nome FROM obras");
$stmt_obras->execute();
$obras = $stmt_obras->fetchAll(PDO::FETCH_ASSOC);

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM operario WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$results) {
    echo "Operário não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Portal de Operários</title>
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
        input[type="email"],
        input[type="password"],
        select,
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
        <h1>Operários</h1>
        <h3>Atualizar Operário</h3>
        <form id="updateOperarioForm" action="../../controladores/operario/controleoperario.php" method="POST">
            <label for="operarioName">Nome:</label>
            <input type="text" id="operarioName" name="nome" value="<?= htmlspecialchars($results['nome']); ?>" required>

            <label for="operarioEmail">Email:</label>
            <input type="email" id="operarioEmail" name="email" value="<?= htmlspecialchars($results['email']); ?>" required>

            <label for="operarioSenha">Senha:</label>
            <input type="password" id="operarioSenha" name="senha" required>

            <label for="operarioCPF">CPF:</label>
            <input type="text" id="operarioCPF" name="cpf" value="<?= htmlspecialchars($results['cpf']); ?>" required>

            <label for="obraId">Selecione a Obra:</label>
            <select id="obraId" name="obra_id" required>
                <option value="">Selecione...</option>
                <?php foreach ($obras as $obra) : ?>
                    <option value="<?= $obra['id']; ?>" <?= ($obra['id'] == $results['obra_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($obra['nome']); ?></option>
                <?php endforeach; ?>
            </select>

            <input type="hidden" name="id_processo" value="1">
            <input type="hidden" name="id" value="<?= htmlspecialchars($results['id']); ?>">

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>

</html>
