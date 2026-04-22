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
    $stmt = $conn->prepare("
            INSERT INTO Cuidado (nomeCuidado, descCuidado, frequencia)
            VALUES (?, ?, ?)
        ");

    $stmt->bind_param("sss", 
        $cuidado, 
        $descCuidado, 
        $frequencia
    );
    $tex= "inserido";
    }else
    {
        $id = (int)$id;
        $stmt = $conn->prepare("
            UPDATE Cuidado 
            SET nomeCuidado=?, descCuidado=?, frequencia=?
            WHERE idCuidado=?
        ");

        $stmt->bind_param("sssi", 
            $cuidado, 
            $descCuidado, 
            $frequencia,
            $id
        );
        $tex= "atualizado";
    }
    if ($stmt->execute()) {
        echo "Cuidado $tex com sucesso!";
    } else {
        echo "ERRO: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>