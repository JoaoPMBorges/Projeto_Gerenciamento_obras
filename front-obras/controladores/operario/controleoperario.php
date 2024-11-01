<?php
include "../../sql/conn.php";
include "../../sql/deletar.php";
include "../../sql/inserir.php";
include "../../sql/atualizar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_processo = $_POST["id_processo"];

    if ($id_processo == 0) {
        // Inserção de novo operário
        if (isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['cpf'], $_POST['obra_id'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $cpf = $_POST['cpf'];
            $obra_id = $_POST['obra_id'];
            InserirOperario($conn, $nome, $email, $senha, $cpf, $obra_id);
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    } elseif ($id_processo == 1) {
        // Atualização de operário existente
        if (isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['cpf'], $_POST['obra_id'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $cpf = $_POST['cpf'];
            $obra_id = $_POST['obra_id'];
            AtualizarOperario($conn, $id, $nome, $email, $senha, $cpf, $obra_id);
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_processo"]) && $_GET["id_processo"] == 2) {
    // Deletar operário via GET
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        DeletarOperario($conn, $id);
    } else {
        echo "ID é necessário para deletar.";
    }
}
?>
