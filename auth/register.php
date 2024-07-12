<?php
session_start();

require '../includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol_id = $_POST['rol_id'];

    // Insertar usuario en la tabla `usuarios`
    $usuario_id = registrarUsuario($nombre, $email, $password, $rol_id);

    // Si el rol seleccionado es administrador (rol_id = 1), insertar en la tabla `administradores`
    if ($rol_id == 1) {
        registrarAdministrador($usuario_id, $nombre);
    }

    // Si el rol seleccionado es paciente (rol_id = 3), insertar en la tabla `pacientes`
    elseif ($rol_id == 3) {
        registrarPaciente($usuario_id, $nombre);
    }

    header('Location: login.php');
    exit();
}

function registrarUsuario($nombre, $email, $password, $rol_id) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO usuarios (nombre, email, password, rol_id) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sssi', $nombre, $email, $password, $rol_id);
    $stmt->execute();
    $usuario_id = $stmt->insert_id;

    $stmt->close();
    $conexion->close();

    return $usuario_id;
}

function registrarAdministrador($usuario_id, $nombre) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO administradores (usuario_id, nombre) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('is', $usuario_id, $nombre);
    $stmt->execute();

    $stmt->close();
    $conexion->close();
}

function registrarPaciente($usuario_id, $nombre) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Asumiendo que el campo `historial_medico` se puede ingresar más adelante o se le puede dar un valor predeterminado.
    $historial_medico = ''; // Esto puede ser modificado según sea necesario.
    $sql = "INSERT INTO pacientes (usuario_id, nombre, historial_medico) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('iss', $usuario_id, $nombre, $historial_medico);
    $stmt->execute();

    $stmt->close();
    $conexion->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">
    <!-- Estilos -->
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <section class="form-register">
        <h4>Registro de Usuario</h4>
        <form method="post" action="register.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="rol_id">Rol:</label>
                <select class="form-control" id="rol_id" name="rol_id" required>
                    <option value="1">Admin</option>
                    <option value="2">Médico</option>
                    <option value="3">Paciente</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
        <a href="../auth/login.php">Iniciar sesion_id</a>
    </section>
</body>
</html>


