<?php 
include '../credencias.php';
$animal=$_GET['id'];
$file=$_GET['file'] ?? "";


$conn = new mysqli($server, $user, $password, $db);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$sql= "DELETE FROM ANIMAIS
WHERE idAnimal=$animal";

    if ($conn->query($sql) === TRUE) {
        echo "Animal removido com sucesso!";
    } else {
        echo "ERRO: " . $conn->error;
    }

$caminho=  "../uploads/".$file;   
if (file_exists($caminho)) {
    if (unlink($caminho)) {
        echo "O arquivo '$caminho' foi excluído com sucesso.";
    } else {
        echo "Erro ao excluir o arquivo '$caminho'.";
    }
} else {
    echo "O arquivo '$caminho' não existe.";
}
?>