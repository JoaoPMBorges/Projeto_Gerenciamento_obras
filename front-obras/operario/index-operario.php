<?php
session_start(); // Inicia a sessão (se já não estiver iniciada)
include "../sql/conn.php";

// Verifica se o operário está logado (exemplo com sessão)
if (!isset($_SESSION['operario_id'])) {
    // Redireciona para a página de login ou faz alguma outra ação
    header("Location: login-operario.php");
    exit;
}

// ID do operário logado obtido da sessão
$id_operario_logado = $_SESSION['operario_id'];

// Consulta para obter a lista de materiais
$stmt = $conn->prepare("SELECT * FROM materiais");
$stmt->execute();
$materiais = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obter a obra associada ao operário logado
$stmt = $conn->prepare("SELECT obras.*, responsavel_obra.nome AS nome_responsavel, GROUP_CONCAT(operario.nome SEPARATOR ', ') AS operarios 
                        FROM obras 
                        INNER JOIN responsavel_obra ON obras.responsavel_obra_id = responsavel_obra.id 
                        LEFT JOIN operario ON obras.id = operario.obra_id 
                        WHERE operario.id = :id_operario
                        GROUP BY obras.id");
$stmt->bindParam(':id_operario', $id_operario_logado, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Materiais</title>
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
        <h1>Lista de Materiais</h1>

        <!-- Formulário para enviar o pedido -->
        <form action="../controladores/pedidos/controle_pedidos.php" method="post">
            <!-- Campo oculto do id_processo -->
            <input type="hidden" name="id_processo" value="0">

            <!-- Campo do ID da obra -->
            
            <input type="hidden" name="obra_id" value="<?php echo $results[0]['id']; ?>">

            <!-- Campo do ID do operário -->
            
            <input type="hidden" name="operario_id" value="<?php echo $id_operario_logado; ?>">

            <!-- Campo do nome do responsável pela obra -->
            <label for="responsavel_nome">Nome do Responsável:</label>
            <input type="text" id="responsavel_nome" name="responsavel_nome" value="<?php echo $results[0]['nome_responsavel']; ?>" readonly>

            <!-- Lista de operários -->
            <?php if (!empty($results[0]['operarios'])) : ?>
                <label for="operarios">Operários nesta obra:</label>
                <input type="text" id="operarios" name="operarios" value="<?php echo $results[0]['operarios']; ?>" readonly>
            <?php endif; ?>

            <!-- Lista de materiais -->
            <ul class="material-list">
                <?php
                foreach ($materiais as $material) {
                    echo "<li>";
                    echo "<span class='material-name'>" . $material['nome'] . "</span>";
                    echo "<input type='hidden' name='materiais[" . $material['id'] . "][nome]' value='" . $material['nome'] . "'>";
                    echo "<input type='number' name='materiais[" . $material['id'] . "][quantidade]' value='0' min='0'>";
                    echo "</li>";
                }
                ?>
            </ul>

            <!-- Botão de enviar pedido -->
            <button type="submit">Enviar Pedido</button>
        </form>
    </div>
</body>

</html>
