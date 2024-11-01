<?php
include "conn.php";

function InserirAdministrador($conn, $nome, $email, $senha, $cpf) {
    $stmt = $conn->prepare("INSERT INTO administrador (nome, email, senha, cpf) VALUES (:nome, :email, :senha, :cpf)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();
    header("location: ../../administrador/ger-adm.php");
}

function InserirOperario($conn, $nome, $email, $senha, $cpf, $obra_id) {
    $stmt = $conn->prepare("INSERT INTO operario (nome, email, senha, cpf, obra_id) VALUES (:nome, :email, :senha, :cpf, :obra_id)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':obra_id', $obra_id);
    $stmt->execute();
    header("location: ../../administrador/ger-operario.php");
}

function InserirResponsavel($conn, $nome, $endereco, $telefone, $email) {
    $stmt = $conn->prepare("INSERT INTO responsavel_obra (nome, endereco, telefone, email) VALUES (:nome, :endereco, :telefone, :email)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    header("location: ../../administrador/ger-responsavel.php");
}

function InserirObra($conn, $nome, $endereco, $data_inicio, $data_conclusao, $responsavel_obra_id) {
    $stmt = $conn->prepare("INSERT INTO obras (nome, endereco, data_inicio, data_conclusao, responsavel_obra_id) VALUES (:nome, :endereco, :data_inicio, :data_conclusao, :responsavel_obra_id)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':data_inicio', $data_inicio);
    $stmt->bindParam(':data_conclusao', $data_conclusao);
    $stmt->bindParam(':responsavel_obra_id', $responsavel_obra_id);
    $stmt->execute();
    header("Location: ../../administrador/ger-obras.php");
    exit(); 
}

function InserirMaterial($conn, $nome, $quantidade) {
    $stmt = $conn->prepare("INSERT INTO materiais (nome, quantidade) VALUES (:nome, :quantidade)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->execute();
    header("location: ../../administrador/ger-materiais.php");
}

function InserirPedido($conn, $nome, $quantidade, $operario_id, $obra_id) {
    $stmt = $conn->prepare("INSERT INTO pedidos (nome, quantidade, operario_id, obra_id) VALUES (:nome, :quantidade, :operario_id, :obra_id)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':operario_id', $operario_id);
    $stmt->bindParam(':obra_id', $obra_id);
    $stmt->execute();
    header("location: ../../operario/index-operario.php");
}

function InserirEmpresaMaterial($conn, $nome, $nome_fantasia, $cnpj, $endereco, $telefone, $email) {
    try {
        $stmt = $conn->prepare("INSERT INTO empresa_materiais (nome, nome_fantasia, cnpj, endereco, telefone, email) VALUES (:nome, :nome_fantasia, :cnpj, :endereco, :telefone, :email)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':nome_fantasia', $nome_fantasia);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        header("location: ../../administrador/ger-empresa_materiais.php");
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// Função para inserir pedidos_empresa
function InserirPedidoEmpresa($conn, $nome, $quantidade, $operario_id, $obra_id, $marcas) {
    try {
        $stmt = $conn->prepare("INSERT INTO pedidos_empresa (nome, quantidade, operario_id, obra_id, marcas) VALUES (:nome, :quantidade, :operario_id, :obra_id, :marcas)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':operario_id', $operario_id);
        $stmt->bindParam(':obra_id', $obra_id);
        $stmt->bindParam(':marcas', $marcas);
        $stmt->execute();
        header("location: ../../responsavel_obras/index_responsavel_obras.php");
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
