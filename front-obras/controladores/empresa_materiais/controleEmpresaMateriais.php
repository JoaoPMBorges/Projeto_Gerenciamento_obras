<?php
include "../../sql/conn.php";
include "../../sql/deletar.php";
include "../../sql/inserir.php";
include "../../sql/atualizar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_processo = $_POST["id_processo"];

    if ($id_processo == 0) {
        // Inserção de nova empresa de materiais
        $nome = $_POST['nome'];
        $nome_fantasia = $_POST['nome_fantasia'];
        $cnpj = $_POST['cnpj'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        InserirEmpresaMaterial($conn, $nome, $nome_fantasia, $cnpj, $endereco, $telefone, $email);
    } elseif ($id_processo == 1) {
        // Atualização de empresa de materiais existente
        if (isset($_POST['id'], $_POST['nome'], $_POST['nome_fantasia'], $_POST['cnpj'], $_POST['endereco'], $_POST['telefone'], $_POST['email'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $nome_fantasia = $_POST['nome_fantasia'];
            $cnpj = $_POST['cnpj'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            AtualizarEmpresaMateriais($conn, $id, $nome, $nome_fantasia, $cnpj, $endereco, $telefone, $email);
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_processo"]) && $_GET["id_processo"] == 2) {
    // Deletar empresa de materiais via GET
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        DeletarEmpresaMateriais($conn, $id);
    } else {
        echo "ID é necessário para deletar.";
    }
}
?>
