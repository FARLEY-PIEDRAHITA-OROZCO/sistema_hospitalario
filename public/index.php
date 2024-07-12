<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Sistema de Agendamiento de Citas Médicas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/custom.css">
</head>
<body>
    <!-- Header -->
    <header class="text-center py-5">
        <div class="container">
            <h1>Bienvenido al Sistema de Agendamiento de Citas Médicas</h1>
            <p class="lead">Simplifica la gestión de citas y mejora la comunicación entre pacientes y médicos.</p>
            <a href="../auth/register.php" class="btn btn-primary btn-lg mt-3">Regístrate Ahora</a>
        </div>
    </header>

    <!-- Beneficios -->
    <section id="benefits" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Beneficios para Pacientes y Médicos</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Para Pacientes</h3>
                    <ul>
                        <li>Agendar citas fácilmente</li>
                        <li>Recordatorios automáticos de citas</li>
                        <li>Acceso a historial médico</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Para Médicos</h3>
                    <ul>
                        <li>Gestión eficiente de citas</li>
                        <li>Comunicación directa con pacientes</li>
                        <li>Acceso a historial médico de pacientes</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Llamado a la acción -->
    <section id="register" class="bg-light py-5">
        <div class="container text-center">
            <h2>Empieza Hoy</h2>
            <p class="lead">Regístrate como paciente o médico y comienza a disfrutar de los beneficios de nuestro sistema.</p>
            <a href="/auth/register.php" class="btn btn-success btn-lg mx-2">Registrarse como Paciente</a>
            <a href="/auth/register.php" class="btn btn-info btn-lg mx-2">Registrarse como Médico</a>
        </div>
    </section>

    <!-- Testimonios -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Testimonios de Usuarios</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <p class="card-text">"Este sistema ha simplificado enormemente la gestión de mis citas médicas. ¡Muy recomendado!"</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">- Paciente Juan Pérez</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <p class="card-text">"Ahora puedo gestionar mis citas y comunicarme con mis pacientes de manera eficiente."</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">- Dr. Ana López</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <p class="card-text">"Excelente plataforma, muy fácil de usar y muy eficiente."</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">- Administrador Carlos García</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-3">
        <p>&copy; 2024 Sistema de Agendamiento de Citas Médicas. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
