<?php
session_start(); // Inicia a sessão (se já não estiver iniciada)
include "../../sql/conn.php";

$user = $_POST["usuario"];
$senha = $_POST["senha"];

$stmt = $conn->prepare("SELECT * FROM operario WHERE nome = :user AND senha = :senha");
$stmt->bindParam(':user', $user, PDO::PARAM_STR);
$stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $_SESSION['operario_id'] = $row['id']; // Define o ID do operário na sessão
    header("Location: ../../operario/index-operario.php?id=" . $row['id']); // Redireciona com o ID do operário
    exit;
} else {
    echo "Usuário ou senha incorretos";
}
?>
