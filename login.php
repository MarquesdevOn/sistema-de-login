<?php

include("conexao.php");

$erro = [];

//se exister o POST email realiza o login
// strlen = tamanho

if (isset($_POST['email']) && strlen($_POST['email']) > 0) {

    //sessao tipo de informação

    if (!isset($_SESSION))
        session_start();

    $_SESSION['email'] = $mysqli->escape_string($_POST['email']);
    $_SESSION['senha'] = md5(md5($_POST['senha']));

    $sql_code = "SELECT senha, codigo FROM usuario WHERE email = '$_SESSION[email]' ";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();
    $total = $sql_query->num_rows;

    //validacao

    if ($total == 0) {
        $erro[] = "Este email não pertence à nenhum usuário.";
    } else {
        if ($dado['senha'] == $_SESSION['senha']) {
            $_SESSION['usuario'] = $dado['codigo'];
        } else {
            $erro[] = "Senha incorreta.";
        }
    }

    if (count($erro) == 0) {
        echo "<script>alert('Login efetuado com sucesso'); location.href='sucesso.php';</script>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--Mostrar o erro-->

    <?php
    if (count($erro) > 0) {
        foreach ($erro as $msg) {

            echo "<p>$msg</p>";
        }
    } ?>

    <form action="" method="post">
        <p><input value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" name="email" placeholder="E-mail: " type="text"></p>
        <p><input value="" name="senha" placeholder="Digite a senha: " type="password"></p>
        <p><a href="">Esqueceu sua senha</a></p>
        <p><input type="submit" value="Entrar"></p>

    </form>
</body>

</html>