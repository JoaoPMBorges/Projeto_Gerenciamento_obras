<?php
include "../../sql/conn.php";
$user = $_POST["usuario"];
$senha = $_POST["senha"];

$stmt = $conn->prepare("select * from administrador");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {
    if (($row['nome'] === $user) && ($row['senha'] === $senha)) {
        header("Location: ../../administrador/index-adm.php");
        exit;
    }
}

echo "Email ou senha incorretos";

?>