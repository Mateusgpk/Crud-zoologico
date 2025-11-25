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
    $foto           = $_FILES["foto"];
    

$nomeFinal = time() . "_" . $foto['name'];

move_uploaded_file($foto['tmp_name'], "../uploads/" . $nomeFinal);

    $conn = new mysqli($server, $user, $password, $db);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    if ($id===""){
    $sql = "INSERT INTO Animais (nomeAnimal, descAnimal, dataNascimento, especie, habitat, paisOrigem, foto)
            VALUES ('$nomeanimal', '$descAnimal', '$dataNascimento', '$especie', '$habitat', '$pais', '$nomeFinal')";
    }else
    {
    $fotoup= $_POST["foto"];
    $sql = "UPDATE Animais 
        SET nomeAnimal='$nomeanimal', descAnimal= '$descAnimal', dataNascimento= '$dataNascimento', especie= '$especie', habitat ='$habitat', paisOrigem='$pais', foto='$fotoup'
        WHERE idAnimal='$id';
        ";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Animal inserido com sucesso!";
    } else {
        echo "ERRO: " . $conn->error;
    }
}
?>