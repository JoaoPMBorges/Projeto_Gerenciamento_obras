<?php
include "../../sql/conn.php";
include "../../sql/deletar.php";
include "../../sql/inserir.php";
include "../../sql/atualizar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_processo"])) {
        $id_processo = $_POST["id_processo"];

        if ($id_processo == 0) {
            
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            InserirResponsavel($conn, $nome, $endereco, $telefone, $email);
        } elseif ($id_processo == 1) {
            
            if (isset($_POST['id'], $_POST['nome'], $_POST['endereco'], $_POST['telefone'], $_POST['email'])) {
                $id = $_POST['id'];
                $nome = $_POST['nome'];
                $endereco = $_POST['endereco'];
                $telefone = $_POST['telefone'];
                $email = $_POST['email'];
                AtualizarResponsavelObra($conn, $id, $nome, $endereco, $telefone, $email);
            } else {
                echo "Todos os campos são obrigatórios.";
            }
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_processo"]) && $_GET["id_processo"] == 2) {
    // Deletar responsável pela obra via GET
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        DeletarResponsavelObra($conn, $id);
    } else {
        echo "ID é necessário para deletar.";
    }
}
?>
