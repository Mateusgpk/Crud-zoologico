<?php



include 'credencias.php';



// Conecta ao servidor (não ao banco)
$conn = new mysqli($server, $user, $password);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}


// Verifica se o banco existe
$sql = "CREATE DATABASE IF NOT EXISTS $db";
if ($conn->query($sql) === TRUE) {
    echo "Banco '$db' verificado/criado com sucesso.<br>";
} else {
    die("Erro ao criar banco: " . $conn->error);
}

// Conecta no banco para criar tabelas
$conn->select_db($db);

$sql_tabela = "create table if not exists pais (
id INT AUTO_INCREMENT PRIMARY KEY,
nome varchar(100) unique
);
";

if ($conn->query($sql_tabela) === TRUE) {
    echo "Tabela 'pais' criada/verificada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
};


$sql= "INSERT INTO pais (nome) VALUES
('Brasil'),
('Argentina'),
('Estados Unidos'),
('Canadá'),
('Japão'),
('Alemanha'),
('França'),
('Austrália'),
('África do Sul'),
('Portugal');";

if ($conn->query($sql)=== TRUE){
    echo "Inserts feitos";
}else{
    echo "Erro ao criar tabela: " . $conn->error;
}


// Cria tabelas (só exemplo)
$sql_tabela = "
create table if not exists Animais(
idAnimal INT AUTO_INCREMENT PRIMARY KEY,
nomeAnimal varchar(100),
descAnimal varchar(400),
dataNascimento date,
especie varchar(100),
habitat varchar(100),
paisOrigem int,
foto varchar(255),
foreign key (paisOrigem) references pais(id)
);";
 
if ($conn->query($sql_tabela) === TRUE) {
    echo "Tabela 'animal' criada/verificada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
}

echo "<hr><strong>Instalação concluída.</strong>";

