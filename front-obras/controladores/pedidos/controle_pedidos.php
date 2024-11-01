<?php
include "../../sql/conn.php";
include "../../sql/deletar.php";
include "../../sql/inserir.php";
include "../../sql/atualizar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_processo = $_POST["id_processo"];
    $responsavel_obra_id = $_POST["responsavel_obra_id"];

    if ($id_processo == 0) {
        // Inserção de novo pedido
        if (isset($_POST['materiais'], $_POST['operario_id'], $_POST['obra_id'])) {
            $materiais = $_POST['materiais'];
            $operario_id = $_POST['operario_id'];
            $obra_id = $_POST['obra_id'];

            // Adicionando logs para depuração
            error_log("Iniciando inserção de pedidos");
            error_log(print_r($_POST, true));

            foreach ($materiais as $material_id => $material) {
                $nome = $material['nome'];
                $quantidade = $material['quantidade'];

                if ($quantidade > 0) {
                    error_log("Inserindo material: $nome, Quantidade: $quantidade");
                    InserirPedido($conn, $nome, $quantidade, $operario_id, $obra_id, $responsavel_obra_id);
                }
            }
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    } elseif ($id_processo == 1) {
        // Atualização de pedido existente
        if (isset($_POST['id'], $_POST['nome'], $_POST['quantidade'], $_POST['operario_id'], $_POST['obra_id'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $quantidade = $_POST['quantidade'];
            $operario_id = $_POST['operario_id'];
            $obra_id = $_POST['obra_id'];
            AtualizarPedido($conn, $id, $nome, $quantidade, $operario_id, $obra_id, $responsavel_obra_id);
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_processo"]) && $_GET["id_processo"] == 2) {
    // Deletar pedido via GET
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $responsavel_obra_id = $_GET["responsavel_obra_id"];
        DeletarPedido($conn, $id, $responsavel_obra_id);
    } else {
        echo "ID é necessário para deletar.";
    }
}
?>
