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
        <td><strong>Número</strong></td>
        <td><strong>Nome do Cuidado</strong></td>
        <td><strong>Descrição</strong></td>
        <td><strong>Frequencia</strong></td>
        <td></td>
        <td></td>
    </tr>
    </thead>
<?php 
if ($result->num_rows>0){
while($row=$result->fetch_assoc()){
echo"
  <tr class=\"cen\">
    <td>{$row['idCuidado']}</td>
    <td>{$row['nomeCuidado']}</td>
    <td>{$row['descCuidado']}</td>
    <td>{$row['frequencia']}</td>
    <td><a href=\"EditCuidado.php?id={$row['idCuidado']}\" class=\"btn btn-primary \">Editar</a></td>
    <td> <button
class=\"btn btn-danger\"onclick=\"confirmDelete({$row['idCuidado']})\"> Deletar </button></td>
</tr>
";
}
}
else{
  echo "<tr><td colspan=\"6\">Nenhum Cuidado Registrado Ainda</td></tr>";
}
?>

</table>
<div id="msg"></div>
<script>
  function confirmDelete(id) {
    if (!confirm("Tem certeza que deseja deletar este cuidado?")) return;
    const msg = document.getElementById('msg')
    msg.innerHTML=""
    fetch("inserts/deleteCuidado.php?id=" + id)
        .then(res => res.text())
        .then(data => {
            msg.innerHTML = data;
            setTimeout(() => {
                msg.innerHTML=""
            }, 1000);
        })
        .catch(err => console.error(err));
    }
</script>
<?php include 'js.php'?>
</body>
</html>