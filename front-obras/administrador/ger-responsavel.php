<?php
include "../sql/conn.php";

$stmt = $conn->prepare("SELECT * FROM responsavel_obra");
$stmt->execute();

$results = $stmt->fetchALL(PDO::FETCH_ASSOC);

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
    </style>
</head>

<body>
    <div class="container">
        <h1>Administração</h1>

        <!-- Lista de Responsáveis pela Obra -->
        <div id="responsavelObraSection">
            <h2>Lista de Responsáveis pela Obra</h2>
            <ul id="responsavelObraList"></ul>
            <h3>Adicionar Responsável pela Obra</h3>
            <form id="addResponsavelObraForm" action="../controladores/responsavel_obra/controle_responsavel_obra.php" method="POST">
                <input type="hidden" name="id_processo" value="0">
                <label for="responsavelObraNome">Nome:</label>
                <input type="text" id="responsavelObraNome" name="nome" required>

                <label for="responsavelObraEndereco">Endereço:</label>
                <input type="text" id="responsavelObraEndereco" name="endereco" required>

                <label for="responsavelObraTelefone">Telefone:</label>
                <input type="text" id="responsavelObraTelefone" name="telefone" required>

                <label for="responsavelObraEmail">Email:</label>
                <input type="email" id="responsavelObraEmail" name="email" required>

                <button type="submit">Adicionar</button>
            </form>


        </div>

        <!-- Tabela de Responsáveis pela Obra -->
        <div id="responsavelObraTable">
            <h2>Responsáveis pela Obra</h2>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= $row['nome']; ?></td>
                        <td><?= $row['endereco']; ?></td>
                        <td><?= $row['telefone']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <a href="responsavel_obra/atualizar_responsavel_obra.php?id=<?= $row['id']; ?>" style="color: black;">Atualizar</a>
                            |
                            <a href="../controladores/responsavel_obra/controle_responsavel_obra.php?id=<?= $row['id']; ?>&id_processo=2" style="color: black;">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>