<?php
include "../sql/conn.php";

$stmt = $conn->prepare("SELECT * FROM administrador");
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

        <!-- Lista de Administradores -->
        <div id="adminSection">
            <h2>Lista de Administradores</h2>
            <ul id="adminList"></ul>
            <h3>Adicionar Administrador</h3>
            <form id="addAdminForm" action="../controladores/administradores/controleadministrador.php" method="POST">
                <label for="adminName">Nome:</label>
                <input type="text" id="adminName" name="nome" required>

                <label for="adminEmail">Email:</label>
                <input type="email" id="adminEmail" name="email" required>

                <label for="adminSenha">Senha:</label>
                <input type="password" id="adminSenha" name="senha" required>

                <label for="adminCPF">CPF:</label>
                <input type="text" id="adminCPF" name="cpf" required>

                <input type="hidden" name="id_processo" value="0">

                <button type="submit">Adicionar</button>
            </form>

        </div>


        <div id="availabilitySection">
            <h2>Administradores</h2>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($results as $row) : ?>

                    <tr>
                        <td><?= $row['nome']; ?></td>
                        <td><?= $row['cpf']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <a href="adm/atualizarAdm.php?id=<?= $row['id']; ?>" style="color: black;">Update</a>
                            |
                            <a href="../controladores/administradores/controleadministrador.php?id=<?= $row['id']; ?>&id_processo=2" style="color: black;">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {


            let availabilityData = [{
                    product: "Cimento",
                    quantity: 100,
                    price: 50
                },
                {
                    product: "Tijolos",
                    quantity: 5000,
                    price: 0.1
                },
                {
                    product: "Areia",
                    quantity: 200,
                    price: 30
                },
                {
                    product: "Ferro",
                    quantity: 300,
                    price: 80
                },
                {
                    product: "Telhas",
                    quantity: 1000,
                    price: 2
                },
                {
                    product: "Madeira",
                    quantity: 400,
                    price: 25
                }
            ];


            function displayAvailability(data) {
                const tbody = document.getElementById("availabilityList");
                tbody.innerHTML = "";
                data.forEach(item => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${item.product}</td>
                        <td>${item.quantity}</td>
                        <td>${item.price}</td>
                    `;
                    tbody.appendChild(row);
                });
            }


            displayAvailability(availabilityData);
        });
    </script>
</body>

</html>