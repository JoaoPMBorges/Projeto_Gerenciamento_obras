<?php
session_start();
include "../../sql/conn.php";

$user = $_POST["usuario"];
$senha = $_POST["senha"];

$stmt = $conn->prepare("SELECT * FROM empresa_materiais WHERE nome = :user AND senha = :senha");
$stmt->bindParam(':user', $user, PDO::PARAM_STR);
$stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $_SESSION['empresa_id'] = $row['id']; 
    header("Location: ../../empresaMaterial/index_empresa_materiais.php?empresa_id=" . $row['id']); 
    exit;
} else {
    echo "Usuário ou senha incorretos";
}
?>
