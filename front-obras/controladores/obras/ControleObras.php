<?php
include "../../sql/conn.php";
include "../../sql/deletar.php";
include "../../sql/inserir.php";
include "../../sql/atualizar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_processo = $_POST["id_processo"];

    if ($id_processo == 0) {
        // Inserção de nova obra
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $data_inicio = $_POST['data_inicio'];
        $data_conclusao = $_POST['data_conclusao'];
        $responsavel_obra_id = $_POST['responsavel_obra_id'];

        InserirObra($conn, $nome, $endereco, $data_inicio, $data_conclusao, $responsavel_obra_id);
    } elseif ($id_processo == 1) {
        // Atualização de obra existente
        if (isset($_POST['id'], $_POST['nome'], $_POST['endereco'], $_POST['data_inicio'], $_POST['data_conclusao'], $_POST['responsavel_obra_id'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $data_inicio = $_POST['data_inicio'];
            $data_conclusao = $_POST['data_conclusao'];
            $responsavel_obra_id = $_POST['responsavel_obra_id'];

            AtualizarObra($conn, $id, $nome, $endereco, $data_inicio, $data_conclusao, $responsavel_obra_id);
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_processo"]) && $_GET["id_processo"] == 2) {
    // Deletar obra via GET
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        DeletarObra($conn, $id);
    } else {
        echo "ID é necessário para deletar.";
    }
}
?>
