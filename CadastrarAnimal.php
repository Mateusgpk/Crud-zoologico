
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body style="padding-top: 70px;">

<?php
include 'Navbar.php';
include 'credencias.php';

$conn = new mysqli($server, $user, $password, $db);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

// consulta
$sql = "SELECT id, nome FROM pais";
$result = $conn->query($sql);


?>
<div class="divForm" >
<form id="Form">
  <div class="mb-3" >
    <label for="NomeAnimal" class="form-label">Nome do animal</label>
    <input type="text" class="form-control" id="nomeAnimal" name="nomeAnimal">
  </div>
  <div class="mb-3">
    <label for="descAnimal" class="form-label">Descrição do Animal</label>
    <input type="text" class="form-control" id="descAnimal" name="descAnimal">
  </div>
    <div class="mb-3">
    <label for="DataNascimento" class="form-label">Data de Nascimento</label>
    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
  </div>
    <div class="mb-3">
    <label for="especie" class="form-label">Espécie</label>
    <input type="text" class="form-control" id="especie" name="especie">
  </div>
    <div class="mb-3">
    <label for="habit" class="form-label">Habitat</label>
    <input type="text" class="form-control" id="habitat" name="habitat">
  </div>
    <div class="mb-3">
    <label for="pais" class="form-label">País de origem</label>
    <select name="pais" id="pais" class="form-control">
      <option value="">Selecionar</option>
      <?php 
         
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['nome']}</option>";
        }
    }
    ?>
    </select>
  </div>
    <div class="mb-3">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" class="form-control" accept="image/*" name="foto">
  </div>

   <div id="msg"></div> 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
<script src="javascript.js">
</script>
<?php include 'js.php'?>
</body>
</html>
    
