# sistema-de-login

Sitema de login utilizando PHP e Mysql

## Conexão com o banco de dados

 <?php
$hostname = "localhost";
$bancodedados = "forms_integration";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);


if ($mysqli->connect_error) {
    echo "Falha na conexão: (" . $mysqli->connect_error . ")" . $mysqli->connect_error;
} else
    echo "Conectado ao Banco de dados";
