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

$sql = "SELECT id, nome FROM pais";
$pais = $conn->query($sql);

$animalData = $result->fetch_assoc();
?>
<form id="Form">
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
                <h2 class="fw-bold"><input type="text" name="nomeAnimal" value="<?= $animalData['nomeAnimal'] ?>"></h2>
                <hr>

                <p><strong>Espécie:</strong> <input type="text" name="especie" value="<?= $animalData['especie'] ?>"></p>
                <p><strong>Habitat:</strong> <input type="text" name="habitat" value="<?= $animalData['habitat'] ?>"></p>
                <p><strong>Data de nascimento:</strong> <input type="date" name="dataNascimento" value="<?= $animalData['dataNascimento'] ?>"></p>
                <p><strong>País de origem:</strong> 
                <select name="pais" id="pais" class="form-control">
                <option value="<?= $animalData['id'] ?>"><?= $animalData['nome'] ?></option>
                <?php 
         
                if ($pais->num_rows > 0) {
                    while ($row = $pais->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                    }
                }
                ?>
                </select>

                <input type="hidden" name="foto" value="<?= $imagem ?>">
                <input type="hidden" name="id" value="<?= $animal ?>">
                
                <hr>
                <p class="mt-3"><strong>Descrição:</strong><br> <input type="text" name="descAnimal" value="<?= $animalData['descAnimal'] ?>"></p>
                
                <div class="d-flex justify-content-between mt-4">

                <div>
                    <a href="index.php" class="btn btn-secondary me-2">Voltar</a>
                    <button class="btn btn-primary"
                    onclick="SalvarAlteracoes()"
                    >Salvar</button>
                </div>
                </form>
                
            </div>
            <div id="msg"></div>
            </div>
        </div>

    </div>
</div>



?>
<script>
function SalvarAlteracoes() {
    if (!confirm("Deseja salvar as alterações?")) return;
    const form =document.getElementById("Form")
    const formdata = new FormData(form);

    fetch('inserts/insertanimal.php', {
        method:'POST',
        body: formdata
    })
    .then(res => res.text())
    .then(data => {
                    setTimeout(() => {
                window.location.href = "index.php";
            }, 1000);
        document.getElementById('msg').innerHTML = data;
        
        })
        .catch(err => console.error(err));
    };
</script>

<?php include 'js.php'?>
</body>
</html>