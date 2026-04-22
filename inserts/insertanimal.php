<?php 
include "../credencias.php";

if ($_SERVER['REQUEST_METHOD'] === "POST"){

    $id             = $_POST["id"] ?? "";
    $nomeanimal     = $_POST["nomeAnimal"];
    $descAnimal     = $_POST["descAnimal"];
    $dataNascimento = $_POST["dataNascimento"];
    $especie        = $_POST["especie"];
    $habitat        = $_POST["habitat"];
    $pais           = $_POST["pais"];

    $conn = new mysqli($server, $user, $password, $db);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    if ($id===""){
    $foto= $_FILES["foto"];
    $extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
    $permitidas = ["jpg", "jpeg", "png", "gif"];

    if (!in_array($extensao, $permitidas)) {
        die("Formato de imagem inválido.");
    }
    $nomeFinal = time() . "_" . $foto['name'];
    move_uploaded_file($foto['tmp_name'], "../uploads/" . $nomeFinal);

        $stmt = $conn->prepare("
            INSERT INTO Animais 
            (nomeAnimal, descAnimal, dataNascimento, especie, habitat, paisOrigem, foto)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param("sssssss", 
            $nomeanimal, 
            $descAnimal, 
            $dataNascimento, 
            $especie, 
            $habitat, 
            $pais, 
            $nomeFinal
        );
    $tex= "inserido";
    }else
    {
    $fotoup= $_POST["foto"];
    $id = (int)$id;
    $stmt = $conn->prepare("
        UPDATE Animais 
        SET nomeAnimal=?, descAnimal=?, dataNascimento=?, especie=?, habitat=?, paisOrigem=?, foto=?
        WHERE idAnimal=?
    ");

    $stmt->bind_param("sssssssi", 
        $nomeanimal, 
        $descAnimal, 
        $dataNascimento, 
        $especie, 
        $habitat, 
        $pais, 
        $fotoup,
        $id
    );
    $tex= "atualizado";
    }
    if ($stmt->execute()) {
        echo "Animal $tex com sucesso!";
    } else {
        echo "ERRO: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>