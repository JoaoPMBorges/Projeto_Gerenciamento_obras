<?php
include "../../sql/conn.php";
include "../../sql/deletar.php";
include "../../sql/inserir.php";
include "../../sql/atualizar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_processo = $_POST["id_processo"] ?? null;

    if ($id_processo == 0) {
        // Inserção de novo pedido_empresa
        if (isset($_POST['nome'], $_POST['quantidade'], $_POST['operario_id'], $_POST['obra_id'], $_POST['marcas'])) {
            $nome = $_POST['nome'];
            $quantidade = $_POST['quantidade'];
            $operario_id = $_POST['operario_id'];
            $obra_id = $_POST['obra_id'];
            $marcas = $_POST['marcas'];
            InserirPedidoEmpresa($conn, $nome, $quantidade, $operario_id, $obra_id, $marcas);
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    } elseif ($id_processo == 1) {
        // Atualização de pedido_empresa existente
        if (isset($_POST['id'], $_POST['nome'], $_POST['quantidade'], $_POST['operario_id'], $_POST['obra_id'], $_POST['marcas'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $quantidade = $_POST['quantidade'];
            $operario_id = $_POST['operario_id'];
            $obra_id = $_POST['obra_id'];
            $marcas = $_POST['marcas'];
            AtualizarPedidoEmpresa($conn, $id, $nome, $quantidade, $operario_id, $obra_id, $marcas);
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    } elseif ($id_processo == 3) {
        // Atualização de preços
        if (isset($_POST['prices'])) {
            $prices = $_POST['prices'];

            foreach ($prices as $id => $preco) {
                AtualizarPrecoPedidoEmpresa($conn, $id, $preco);
            }

            header("Location: ../../administrador/ger-pedidos_empresa.php");
            exit();
        } else {
            echo "Preços não fornecidos.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_processo"]) && $_GET["id_processo"] == 2) {
    // Deletar pedido_empresa via GET
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        DeletarPedidoEmpresa($conn, $id);
    } else {
        echo "ID é necessário para deletar.";
    }
}
?>
