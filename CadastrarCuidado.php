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
    <?php include 'Navbar.php'?>
<div class="divForm">
    <h1 class="text">Cadastrar Cuidado</h1>
<form id="Form">
  <div class="mb-3" >
    <label for="NomeCuidado" class="form-label">Nome do Cuidado</label>
    <input type="text" class="form-control" name="Cuidado">
  </div>
    <div class="mb-3" >
    <label for="DescricaoCuidado" class="form-label">Descrição</label>
    <input type="text" class="form-control" id="nomeAnimal" name="descricaoCuidado">
  </div>
    <div class="mb-3" >
    <label for="Frequencia" class="form-label">Frequência:</label>
    <select name="frequencia" id="" class="form-control">
        <option value="Selecionar">Selecionar</option>
        <option value="Diario">Diario</option>
        <option value="Semanal">Semanal</option>
        <option value="Mensal">Mensal</option>
        <option value="Semestral">Semestral</option>
        <option value="Anual">Anual</option>        
    </select>
</div>
   <div id="msg"></div> 
  <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
</div>
<div hidden id="des">inserts/insertcuidado.php</div>
<script src="javascript.js"></script>
    <?php include 'js.php'?>
</body>
</html>