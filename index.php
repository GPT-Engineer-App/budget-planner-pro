<?php
session_start();
include('db.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $query = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['email'] = $email;
        header('Location: home.php');
    } else {
        $error = "Email ou senha incorretos!";
    }
}

if (isset($_POST['register'])) {
    $nomeCompleto = $_POST['nomeCompleto'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $query = "INSERT INTO usuario (nomeCompleto, email, senha) VALUES ('$nomeCompleto', '$email', '$senha')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['email'] = $email;
        header('Location: home.php');
    } else {
        $error = "Erro ao cadastrar!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="login">Login</button>
        </form>
        <h2>Cadastro</h2>
        <form method="POST">
            <input type="text" name="nomeCompleto" placeholder="Nome Completo" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="register">Cadastrar</button>
        </form>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    </div>
</body>
</html>