<?php 
include '../credencias.php';
$animal=$_GET['id'] ?? "";
$file=$_GET['file'] ?? "";


$conn = new mysqli($server, $user, $password, $db);


if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$animal = (int)$animal;
$stmt = $conn->prepare("DELETE FROM ANIMAIS WHERE idAnimal = ?");
$stmt->bind_param("i", $animal);

    if ($stmt->execute()) {
        echo "Animal removido com sucesso!";
    } else {
        echo "ERRO: " . $stmt->error;
    }

$file = basename($file);
$extensao = strtolower(pathinfo($file, PATHINFO_EXTENSION));
$permitidas = ["jpg", "jpeg", "png", "gif"];

if (!in_array($extensao, $permitidas)) {
    die("Arquivo inválido.");
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
$stmt->close();
$conn->close();
?>