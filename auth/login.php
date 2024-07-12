<?php
session_start();
include_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['rol_id'];
        $_SESSION['user_name'] = $user['nombre'];

        switch ($user['rol_id']) {
            case 1:
                header("Location: ../admin/index.php");
                break;
            case 2:
                header("Location: ../medico/index.php");
                break;
            case 3:
                header("Location: ../paciente/index.php");
                break;
        }
    } else {
        echo "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio de Sesión</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">
    <!-- Estilos -->
    <link rel="stylesheet" href="/..public/css/styles.css">
</head>
<body>
    <section class="form-register">
        <h4>Inicio de sesion</h4>
        <form method="post" action="login.php">
            <input class="controls" type="text" name="email" id="nombres" placeholder="Email">
            <input class="controls" type="text" name="password" id="password" placeholder="Contraseña">
            <input class="botons" type="submit" value="Ingresar">
            <p><a href="../auth/register.php">Crear una cuenta</a></p>
        </form>
    </section>
</body>
</html>


