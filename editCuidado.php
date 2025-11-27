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
include 'credencias.php';
include 'Navbar.php';
$Cuidado=$_GET['id'];
$conn = new mysqli($server, $user, $password, $db);
if ($conn->connect_error){
    die($conn->connect_error);
};
$sql="SELECT * FROM Cuidado
WHERE idCuidado=$Cuidado; 
";
$result=$conn->query($sql);

if ($result->num_rows == 0) {
    echo "<h3 class='text-center mt-5'>Cuidado não encontrado!</h3>";
    exit;
}
$CuidadoData = $result->fetch_assoc();
?>  

    <div class="divForm" onsubmit="return Redirecionar()">
    <h1 class="text">Atualizar Cuidado</h1>
<form id="Form">
  <div class="mb-3" >
    <label for="NomeCuidado" class="form-label">Nome do Cuidado</label>
    <input type="text" class="form-control" name="Cuidado" value="<?= $CuidadoData['nomeCuidado'] ?>">
  </div>
    <div class="mb-3" >
    <label for="DescricaoCuidado" class="form-label" >Descrição</label>
    <input type="text" class="form-control" name="descricaoCuidado" value="<?= $CuidadoData['descCuidado'] ?>">
  </div>
    <div class="mb-3" >
    <label for="Frequencia" class="form-label">Frequência:</label>
    <select name="frequencia" id="" class="form-control">
        <option value="<?= $CuidadoData['frequencia'] ?>"><?= $CuidadoData['frequencia'] ?></option>
        <option value="Diario">Diario</option>
        <option value="Semanal">Semanal</option>
        <option value="Mensal">Mensal</option>
        <option value="Semestral">Semestral</option>
        <option value="Anual">Anual</option>        
    </select>
</div>
   <div id="msg"></div> 
  <button type="submit" class="btn btn-primary" onclick="Redirecionar()">Salvar</button>
  <input type="hidden" name="id" value="<?= $Cuidado ?>">
</form>
</div>
<div hidden id="des">inserts/insertcuidado.php</div>
<script src="javascript.js">
</script>
<script>
    function Redirecionar(){

            setTimeout(() => {
                window.location.href = "VerCuidado.php";
            }, 1000);  
        return true;
    }
</script>
    <?php include 'js.php'?>
</body>
</html>

