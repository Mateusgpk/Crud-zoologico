<?php 
include '../credencias.php';

$cuidado = $_GET['id'] ?? "";
$conn= new mysqli($server, $user, $password, $db);
if ($conn->connect_error){
    die("Erro:".$conn->connect_error);
};
$stmt = $conn->prepare("DELETE FROM Cuidado WHERE idCuidado = ?");
$stmt->bind_param("i", $cuidado);

if($stmt->execute()){
    echo "Cuidado deletado";
}else{
    echo "Erro ao deletar: $stmt->error";
}
$stmt->close();
$conn->close();
?>