<!DOCTYPE html>
<html lang="en">
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

$conn = new mysqli($server,$user,$password,$db);

if ($conn->connect_error){
    die("ERRO:".$conn->connect_error );
};

$sql="SELECT * FROM Cuidado";
$result= $conn->query($sql);
?>
<table class="table tabela table-dark table-hover"  >
    <thead>
    <tr><td colspan="6" style="text-align: center;"><h3>CUIDADOS</h3></td></tr>
    <tr>
        <td>Número</td>
        <td>Nome do Cuidado</td>
        <td>Descrição</td>
        <td>Frequencia</td>
        <td></td>
        <td></td>
    </tr>
    </thead>
<?php 
if ($result->num_rows>0){
while($row=$result->fetch_assoc()){
echo"
  <tr>
    <td>{$row['idCuidado']}</td>
    <td>{$row['nomeCuidado']}</td>
    <td>{$row['descCuidado']}</td>
    <td>{$row['frequencia']}</td>
    <td><a href=\"EditCuidado.php?id={$row['idCuidado']}\" class=\"btn btn-primary \">Editar</a></td>
    <td><a href=\"DeleteCuidado.php?id={$row['idCuidado']}\" class=\"btn btn btn-danger \">Deletar</a></td>
  </tr>
";
}
}?>
<a href=""></a>
</table>

<?php include 'js.php'?>
</body>
</html>