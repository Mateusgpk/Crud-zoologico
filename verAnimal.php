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
include 'Navbar.php' ;
include 'credencias.php';
$animal=$_GET['id'];

$conn = new mysqli($server, $user, $password, $db);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$sql= "SELECT * FROM ANIMAIS as a
JOIN pais as p ON a.paisOrigem=p.id
WHERE idAnimal=$animal";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<h3 class='text-center mt-5'>Animal não encontrado!</h3>";
    exit;
}

$animalData = $result->fetch_assoc();
?>

<div class="container mt-5 pt-5">
    <div class="card shadow-lg p-4" style="max-width: 900px; margin: auto;">

        <div class="row g-4">
            <div class="col-md-4 text-center">
                <?php 
                $imagem = $animalData['foto'] ?? ""; 
                if (!empty($imagem) && file_exists("uploads/" . $imagem)) {
                    echo "<img src='uploads/{$imagem}' class='img-fluid rounded'>";
                } else {
                    echo "<img src='img/sem_foto.png' class='img-fluid rounded'>";
                }
                ?>
            </div>

            <div class="col-md-8">
                <h2 class="fw-bold"><?= $animalData['nomeAnimal'] ?></h2>
                <hr>

                <p><strong>Espécie:</strong> <?= $animalData['especie'] ?></p>
                <p><strong>Habitat:</strong> <?= $animalData['habitat'] ?></p>
                <p><strong>Data de nascimento:</strong> <?= date("d/m/Y", strtotime($animalData['dataNascimento'])) ?></p>
                <p><strong>País de origem:</strong> <?= $animalData['nome'] ?></p>

                <hr>
                <p class="mt-3"><strong>Descrição:</strong><br><?= $animalData['descAnimal'] ?></p>

                <div class="d-flex justify-content-between mt-4">

                <div>
                    <a href="index.php" class="btn btn-secondary me-2">Voltar</a>
                    <a href="editarAnimal.php?id=<?= $animalData['idAnimal'] ?>" class="btn btn-primary">Atualizar</a>
                </div>
                <button class="btn btn-danger"
                    onclick="confirmDelete(<?= $animalData['idAnimal'] ?>, '<?= $imagem ?>')">
                    Deletar
                </button>
                
            </div>
            <div id="msg"></div>
            </div>
        </div>

    </div>
</div>



?>
<script>
function confirmDelete(id,file) {
    if (!confirm("Tem certeza que deseja deletar este animal?")) return;

    fetch("inserts/deleteAnimal.php?id=" + id + "&file=" + file)
        .then(res => res.text())
        .then(data => {
            document.getElementById('msg').innerHTML = data;

            // remover o card ou redirecionar
            setTimeout(() => {
                window.location.href = "index.php";
            }, 1000);
        })
        .catch(err => console.error(err));
    }
</script>

<?php include 'js.php'?>
</body>
</html>