<?php 
include "../credencias.php";

if ($_SERVER['REQUEST_METHOD'] === "POST"){

    $id             = $_POST["id"] ?? "";
    $cuidado        = $_POST["Cuidado"];
    $descCuidado    = $_POST["descricaoCuidado"];
    $frequencia     = $_POST["frequencia"]; 
    

    $conn = new mysqli($server, $user, $password, $db);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    if ($id===""){
    $sql = "INSERT INTO Cuidado (nomeCuidado, descCuidado, frequencia)
            VALUES ('$cuidado', '$descCuidado', '$frequencia')";
    }else
    {
    $sql = "UPDATE Cuidado 
        SET nomeAnimal='$nomeanimal', descAnimal= '$descAnimal', dataNascimento= '$dataNascimento', especie= '$especie', habitat ='$habitat', paisOrigem='$pais', foto='$fotoup'
        WHERE idAnimal='$id';
        ";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Cuidado inserido com sucesso!";
    } else {
        echo "ERRO: " . $conn->error;
    }
}
?>