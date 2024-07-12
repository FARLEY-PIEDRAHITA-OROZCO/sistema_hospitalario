<?php
function obtenerUsuarios() {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM usuarios";
    $resultado = $conexion->query($sql);

    $usuarios = [];
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            $usuarios[] = $row;
        }
    }

    $conexion->close();

    return $usuarios;
}

function obtenerUsuarioPorId($id) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    $stmt->close();
    $conexion->close();

    return $usuario;
}

function actualizarUsuario($id, $nombre, $email, $rol_id) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol_id = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ssii', $nombre, $email, $rol_id, $id);
    $stmt->execute();

    $stmt->close();
    $conexion->close();
}

function eliminarUsuario($id) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Eliminar citas asociadas al usuario
    $sql_eliminar_citas = "DELETE FROM citas WHERE paciente_id = ?";
    $stmt_citas = $conexion->prepare($sql_eliminar_citas);
    $stmt_citas->bind_param('i', $id);
    $stmt_citas->execute();
    $stmt_citas->close();

    // Luego eliminar al usuario
    $sql_eliminar_usuario = "DELETE FROM usuarios WHERE id = ?";
    $stmt_usuario = $conexion->prepare($sql_eliminar_usuario);
    $stmt_usuario->bind_param('i', $id);
    $stmt_usuario->execute();
    $stmt_usuario->close();

    $conexion->close();
}

function obtenerTodasLasCitas() {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT citas.id, usuarios.nombre AS paciente, citas.fecha, tipos_citas.nombre AS tipo_cita 
            FROM citas 
            JOIN usuarios ON citas.paciente_id = usuarios.id 
            JOIN tipos_citas ON citas.tipo_cita_id = tipos_citas.id";
    $resultado = $conexion->query($sql);

    $citas = [];
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $citas[] = $row;
        }
    }

    $conexion->close();

    return $citas;
}


function obtenerCitasPorPaciente($paciente_id) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT citas.*, tipos_citas.nombre AS tipo_cita_nombre
            FROM citas
            JOIN tipos_citas ON citas.tipo_cita_id = tipos_citas.id
            WHERE citas.paciente_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $paciente_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $citas = [];
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            $citas[] = $row;
        }
    }

    $stmt->close();
    $conexion->close();

    return $citas;
}


function agendarCita($paciente_id, $fecha, $tipo_cita_id, $medico_id) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO citas (paciente_id, fecha, tipo_cita_id, medico_id) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('isii', $paciente_id, $fecha, $tipo_cita_id, $medico_id);
    $stmt->execute();

    $stmt->close();
    $conexion->close();
}

// En funciones.php

function obtenerCitaPorId($id) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM citas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $cita = $resultado->fetch_assoc();

    $stmt->close();
    $conexion->close();

    return $cita;
}


function obtenerTiposCitas() {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM tipos_citas";
    $resultado = $conexion->query($sql);

    $tipos_citas = [];
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            $tipos_citas[] = $row;
        }
    }

    $conexion->close();

    return $tipos_citas;
}

function obtenerHistorialMedico($paciente_id) {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Obtener los datos del paciente
    $sqlPaciente = "SELECT * FROM usuarios WHERE id = ?";
    $stmtPaciente = $conexion->prepare($sqlPaciente);
    $stmtPaciente->bind_param('i', $paciente_id);
    $stmtPaciente->execute();
    $resultadoPaciente = $stmtPaciente->get_result();
    $paciente = $resultadoPaciente->fetch_assoc();

    $stmtPaciente->close();

    // Obtener el historial de citas del paciente
    $sqlCitas = "SELECT citas.id, citas.fecha, tipos_citas.nombre AS tipo_cita 
                 FROM citas 
                 JOIN tipos_citas ON citas.tipo_cita_id = tipos_citas.id 
                 WHERE citas.paciente_id = ?";
    $stmtCitas = $conexion->prepare($sqlCitas);
    $stmtCitas->bind_param('i', $paciente_id);
    $stmtCitas->execute();
    $resultadoCitas = $stmtCitas->get_result();
    $citas = [];
    if ($resultadoCitas->num_rows > 0) {
        while ($row = $resultadoCitas->fetch_assoc()) {
            $citas[] = $row;
        }
    }

    $stmtCitas->close();
    $conexion->close();

    return ['paciente' => $paciente, 'citas' => $citas];
}

function obtenerMedicosDisponibles() {
    $conexion = new mysqli('localhost', 'root', '', 'sistema_usuarios');

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM usuarios WHERE rol_id = 2";
    $resultado = $conexion->query($sql);

    $medicos = [];
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            $medicos[] = $row;
        }
    }

    $conexion->close();

    return $medicos;
}

?>
