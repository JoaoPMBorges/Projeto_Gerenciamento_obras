<?php
include "conn.php";

function Deletaradministrador($conn, $id) {
    try {
        $stmt = $conn->prepare("DELETE FROM administrador WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../../administrador/ger-adm.php");
    } catch (PDOException $e) {
        echo "Por questões de segurança não é possível deletar.";
    }
}

function DeletarOperario($conn, $id) {
    try {
        $stmt = $conn->prepare("DELETE FROM operario WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../../administrador/ger-operario.php");
    } catch (PDOException $e) {
        echo "Por questões de segurança não é possível deletar.";
    }
}

function DeletarResponsavelObra($conn, $id) {
    try {
        // Verifica se existem registros dependentes
        $stmt = $conn->prepare("SELECT COUNT(*) FROM obras WHERE responsavel_obra_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            throw new Exception("Dependentes existentes");
        }

        $stmt = $conn->prepare("DELETE FROM responsavel_obra WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../../administrador/ger-responsavel.php");
    } catch (Exception $e) {
        echo "Por questões de segurança não é possível deletar.";
    }
}

function DeletarMateriais($conn, $id) {
    try {
        $stmt = $conn->prepare("DELETE FROM materiais WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../../administrador/ger-materiais.php");
    } catch (PDOException $e) {
        echo "Por questões de segurança não é possível deletar.";
    }
}

function DeletarEmpresaMateriais($conn, $id) {
    try {
        $stmt = $conn->prepare("DELETE FROM empresa_materiais WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../../administrador/ger-empresa_materiais.php");
    } catch (PDOException $e) {
        echo "Por questões de segurança não é possível deletar.";
    }
}

function DeletarObra($conn, $id) {
    try {
        $stmt = $conn->prepare("DELETE FROM obras WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../../administrador/ger-obras.php");
    } catch (PDOException $e) {
        echo "Por questões de segurança não é possível deletar.";
    }
}

function DeletarPedido($conn, $id, $responsavel_obra_id) {
    try {
        $stmt = $conn->prepare("DELETE FROM pedidos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../../responsavel_obras/index_responsavel_obras.php?responsavel_obra_id=$responsavel_obra_id");
        exit();
    } catch (PDOException $e) {
        echo "Por questões de segurança não é possível deletar.";
    }
}

// Função para deletar pedidos_empresa
function DeletarPedidoEmpresa($conn, $id) {
    try {
        $stmt = $conn->prepare("DELETE FROM pedidos_empresa WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../../administrador/ger-pedidos_empresa.php");
    } catch (PDOException $e) {
        echo "Por questões de segurança não é possível deletar.";
    }
}
?>
