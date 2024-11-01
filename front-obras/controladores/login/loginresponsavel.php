<?php
session_start(); 
include "../../sql/conn.php";

$user = $_POST["usuario"];
$senha = $_POST["senha"];

$stmt = $conn->prepare("SELECT * FROM responsavel_obra WHERE nome = :user AND senha = :senha");
$stmt->bindParam(':user', $user, PDO::PARAM_STR);
$stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $_SESSION['responsavel_id'] = $row['id']; 
    header("Location: ../../responsavel_obras/index_responsavel_obras.php?responsavel_obra_id=" . $row['id']); 
    exit;
} else {
    echo "Usuário ou senha incorretos";
}
?>
