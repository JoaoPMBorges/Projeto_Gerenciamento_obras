<?php
include "../../sql/conn.php";
include "../../sql/deletar.php";
include "../../sql/inserir.php";
include "../../sql/atualizar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_processo = $_POST["id_processo"];

    if ($id_processo == 0) {
        // Inserção de novo material
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];
        $fornecedor = $_POST['fornecedor'];
        InserirMaterial($conn, $nome, $quantidade);
    } elseif ($id_processo == 1) {
        // Atualização de material existente
        $id = $_POST['id'] ?? null;
        $nome = $_POST['nome'] ?? null;
        $quantidade = $_POST['quantidade'] ?? null;
        $preco = $_POST['preco'] ?? null;
        $fornecedor = $_POST['fornecedor'] ?? null;
    
        // Verifica se pelo menos o ID foi enviado
        if ($id !== null) {
            AtualizarMateriais($conn, $id, $nome, $quantidade, $preco, $fornecedor);
        } else {
            echo "ID é obrigatório para atualização.";
        }
    }
    
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_processo"]) && $_GET["id_processo"] == 2) {
    // Deletar material via GET
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        DeletarMateriais($conn, $id);
    } else {
        echo "ID é necessário para deletar.";
    }
}
?>
