<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">   
</head>
<body>


<?php
include 'Navbar.php';
include 'credencias.php';
$conn = new mysqli($server, $user,$password, $db);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
$sql = "SELECT idAnimal, nomeAnimal, especie, habitat, descAnimal, foto FROM Animais";
$result = $conn->query($sql);
?>

<div class="container mt-5 pt-4">
    <h1 class="text-center mb-4">Animais do Zoológico</h1>

    <div class="row g-4">

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $foto = $row['foto'] ?? "https://via.placeholder.com/300x200.png?text=Sem+Foto";

                echo "
                <div class='col-md-4'>
                    <div class='card shadow-sm h-100'>
                        <img src='uploads/$foto' class='card-img-top' style='height:200px; object-fit:cover;'>
                        
                        <div class='card-body'>
                            <h5 class='card-title'>{$row['nomeAnimal']}</h5>
                            <p class='card-text'>
                                <strong>Espécie:</strong> {$row['especie']}<br>
                                <strong>Habitat:</strong> {$row['habitat']}
                            </p>
                        </div>

                        <div class='card-footer bg-white'>
                            <a href='verAnimal.php?id={$row['idAnimal']}' class='btn btn-primary w-100'>
                                Ver detalhes
                            </a>
                        </div>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<p class='text-center'>Nenhum animal encontrado.</p>";
        }
        ?>

    </div>
</div>


<?php include 'js.php'?>
</body>
</html>

