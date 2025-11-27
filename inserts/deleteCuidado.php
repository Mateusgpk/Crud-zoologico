<?php 
include '../credencias.php';

$cuidado = $_GET['id'];
$conn= new mysqli($server, $user, $password, $db);
if ($conn->connect_error){
    die("Erro:".$conn->connect_error);
};
$sql="DELETE FROM Cuidado
WHERE idCuidado=$cuidado;";
if($conn->query($sql)===TRUE){
    echo "Cuidado deletado";
}else{
    echo "Erro ao deletar: $conn->error";
}

?>