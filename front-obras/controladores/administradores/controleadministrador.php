<?php
include "../../sql/conn.php";
include "../../sql/deletar.php";
include "../../sql/inserir.php";
include "../../sql/atualizar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_processo = $_POST["id_processo"];

    if ($id_processo == 0) {
        // Inserção de novo administrador
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $cpf = $_POST['cpf'];
        InserirAdministrador($conn, $nome, $email, $senha, $cpf);
    } elseif ($id_processo == 1) {
        // Atualização de administrador existente
        if (isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['cpf'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $cpf = $_POST['cpf'];
            AtualizarAdministrador($conn, $id, $nome, $email, $senha, $cpf);
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_processo"]) && $_GET["id_processo"] == 2) {
    // Deletar administrador via GET
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        Deletaradministrador($conn, $id);
    } else {
        echo "ID é necessário para deletar.";
    }
}
?>
