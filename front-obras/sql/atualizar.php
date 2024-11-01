<?php
include "conn.php";

function AtualizarAdministrador($conn, $id, $nome, $email, $senha, $cpf) {
    $stmt = $conn->prepare("UPDATE administrador SET nome = :nome, email = :email, senha = :senha, cpf = :cpf WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();

    header("location: ../../administrador/ger-adm.php");
}

function AtualizarOperario($conn, $id, $nome, $email, $senha, $cpf, $obra_id) {
    $stmt = $conn->prepare("UPDATE operario SET nome = :nome, email = :email, senha = :senha, cpf = :cpf, obra_id = :obra_id WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':obra_id', $obra_id);

    $stmt->execute();

    header("location: ../../administrador/ger-operario.php");
    exit();
}

// Função para atualizar um responsável pela obra
function AtualizarResponsavelObra($conn, $id, $nome, $endereco, $telefone, $email) {
    $stmt = $conn->prepare("UPDATE responsavel_obra SET nome = :nome, endereco = :endereco, telefone = :telefone, email = :email WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    header("location: ../../administrador/ger-responsavel.php");
}

// Função para atualizar materiais
function AtualizarMateriais($conn, $id, $nome, $quantidade, $preco, $fornecedor) {
    $stmt = $conn->prepare("UPDATE materiais SET nome = :nome, quantidade = :quantidade, preco = :preco, fornecedor = :fornecedor WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':fornecedor', $fornecedor);
    $stmt->execute();

    header("location: ../../administrador/ger-materiais.php");
}

// Função para atualizar empresa de materiais de construção
function AtualizarEmpresaMateriais($conn, $id, $nome, $nome_fantasia, $cnpj, $endereco, $telefone, $email) {
    $stmt = $conn->prepare("UPDATE empresa_materiais SET nome = :nome, nome_fantasia = :nome_fantasia, cnpj = :cnpj, endereco = :endereco, telefone = :telefone, email = :email WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':nome_fantasia', $nome_fantasia);
    $stmt->bindParam(':cnpj', $cnpj);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    header("location: ../../administrador/ger-empresa_materiais.php");
}

// Função para atualizar obra
function AtualizarObra($conn, $id, $nome, $endereco, $data_inicio, $data_conclusao, $responsavel_obra_id) {
    $stmt = $conn->prepare("UPDATE obras SET nome = :nome, endereco = :endereco, data_inicio = :data_inicio, data_conclusao = :data_conclusao, responsavel_obra_id = :responsavel_obra_id WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':data_inicio', $data_inicio);
    $stmt->bindParam(':data_conclusao', $data_conclusao);
    $stmt->bindParam(':responsavel_obra_id', $responsavel_obra_id);
    $stmt->execute();

    header("location: ../../administrador/ger-obras.php");
}

function AtualizarPedido($conn, $id, $nome, $quantidade, $operario_id, $obra_id, $responsavel_obra_id) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE pedidos SET nome = :nome, quantidade = :quantidade, operario_id = :operario_id, obra_id = :obra_id WHERE id = :id");
    
    // Bind the parameters
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':operario_id', $operario_id, PDO::PARAM_INT);
    $stmt->bindParam(':obra_id', $obra_id, PDO::PARAM_INT);
    
    $stmt->execute();
    
    header("location: ../../responsavel_obras/index_responsavel_obras.php?responsavel_obra_id=$responsavel_obra_id");
    exit();
}

function AtualizarPedidoEmpresa($conn, $id, $nome, $quantidade, $operario_id, $obra_id, $marcas) {
    $stmt = $conn->prepare("UPDATE pedidos_empresa SET nome = :nome, quantidade = :quantidade, operario_id = :operario_id, obra_id = :obra_id, marcas = :marcas WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':operario_id', $operario_id, PDO::PARAM_INT);
    $stmt->bindParam(':obra_id', $obra_id, PDO::PARAM_INT);
    $stmt->bindParam(':marcas', $marcas);
    $stmt->execute();

    header("location: ../../administrador/ger-pedidos_empresa.php");
    exit();
}

function AtualizarPrecoPedidoEmpresa($conn, $id, $preco) {
    $stmt = $conn->prepare("UPDATE pedidos_empresa SET preco = :preco WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
    $stmt->execute();
}
?>

?>
