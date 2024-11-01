<?php
include "../sql/conn.php";

// Consulta para selecionar todas as obras com o nome do responsável
$stmt = $conn->prepare("SELECT obras.*, responsavel_obra.nome AS nome_responsavel FROM obras INNER JOIN responsavel_obra ON obras.responsavel_obra_id = responsavel_obra.id");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Gerenciamento de Obras</title>
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
        <h1>Gerenciamento de Obras</h1>

        <!-- Formulário para adicionar obra -->
        <div id="obraSection">
            <h2>Adicionar Nova Obra</h2>
            <form id="addObraForm" action="../controladores/obras/ControleObras.php" method="POST">
                <input type="hidden" id="id_processo" name="id_processo" value="0">

                <label for="obraName">Nome da Obra:</label>
                <input type="text" id="obraName" name="nome" required>

                <label for="obraEndereco">Endereço:</label>
                <input type="text" id="obraEndereco" name="endereco" required>

                <label for="obraStartDate">Data de Início:</label>
                <input type="date" id="obraStartDate" name="data_inicio" required>

                <label for="obraEndDate">Data de Conclusão:</label>
                <input type="date" id="obraEndDate" name="data_conclusao" required>

                <label for="obraResponsavel">Responsável pela Obra:</label>
                <select id="obraResponsavel" name="responsavel_obra_id" required>
                    <?php
                    // Consulta para obter os responsáveis
                    $stmt_responsaveis = $conn->prepare("SELECT id, nome FROM responsavel_obra");
                    $stmt_responsaveis->execute();
                    $responsaveis = $stmt_responsaveis->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($responsaveis as $responsavel) {
                        echo '<option value="' . htmlspecialchars($responsavel['id']) . '">' . htmlspecialchars($responsavel['nome']) . '</option>';
                    }
                    ?>
                </select>

                <button type="submit">Adicionar Obra</button>
            </form>
        </div>

        <!-- Tabela de Obras -->
        <div id="obraTable">
            <h2>Lista de Obras</h2>
            <table>
                <tr>
                    <th>Nome da Obra</th>
                    <th>Endereço</th>
                    <th>Data de Início</th>
                    <th>Data de Conclusão</th>
                    <th>Responsável</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nome']); ?></td>
                        <td><?= htmlspecialchars($row['endereco']); ?></td>
                        <td><?= htmlspecialchars($row['data_inicio']); ?></td>
                        <td><?= htmlspecialchars($row['data_conclusao']); ?></td>
                        <td><?= htmlspecialchars($row['nome_responsavel']); ?></td> 
                        <td>
                            <a href="obras/atualizar_obras.php?id=<?= $row['id']; ?>" style="color: black;">Atualizar</a>
                            |
                            <a href="../controladores/obras/ControleObras.php?id=<?= $row['id']; ?>&id_processo=2" style="color: black;">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>
