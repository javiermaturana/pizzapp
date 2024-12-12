<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Meta etiquetas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Tu Pizza: Misterio y Creatividad</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fuentes de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:wght@400;700&display=swap"
          rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        .pizzas-section .card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #D4CAC4;
        }

        .pizzas-section .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .pizzas-section .card-title {
            color: #483833;
            font-family: 'Lobster', cursive;
        }

        .pizzas-section .card-text {
            color: #53443C;
        }

        @media (max-width: 768px) {
            .pizzas-section .col-md-6 {
                margin-bottom: 1.5rem;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .pizzas-section .row {
                justify-content: center;
            }
        }
    </style>
    <style>

        body {
            font-family: 'Open Sans', sans-serif;
            color: #d2c0b3;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Lobster', cursive;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.8) !important;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover, .nav-link:hover {
            color: #ffa500 !important;
        }

        .hero-section {
            background-image: url('https://pikaso.cdnpk.net/private/production/1187069361/render.jpeg?token=exp=1759449600~hmac=e345f098d7e3f018c4650c28fcaca93f489643c5acff53dbad46a7f0c4661441');
            background-size: cover;
            background-position: center;
            position: relative;
            padding: 100px 0;
            display: flex;
            align-items: center;
            min-height: 100vh;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-section .container {
            position: relative;
            z-index: 1;
        }

        .hero-section h1 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-size: 3rem;
        }

        .btn-primary {
            background-color: #F0E9E5;
            border-color: #F0E9E5;
            transition: all 0.3s ease;
            color: #000;
        }

        .btn-primary:hover {
            background-color: #6F5249;
            border-color: #6F5249;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tarjetas */
        .card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            background-color: #D4CAC4;
        }

        #voting {
            background-color: #fffaf0;
        }

        footer {
            background-color: #483833 !important;
            color: #fff;
            padding: 20px 0;
        }

        footer a {
            color: #fff !important;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #ffa500 !important;
        }

        /* Sección de la línea de tiempo */
        .timeline-section {
            background-color: #53443C;
            padding: 4rem 0;
            position: relative;
        }

        .timeline-bubbles {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
            padding: 2rem 0;
        }

        .bubble {
            width: 280px;
            height: 280px;
            border-radius: 50%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .bubble:hover {
            transform: scale(1.05);
        }

        .bubble-1 {
            background-color: #B29F95c4;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 33%);
        }

        .bubble-2 {
            background-color: #AB9087;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 33%);
        }

        .bubble-3 {
            background-color: #CCBCB7;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 33%);
        }

        .bubble-content {
            text-align: center;
            color: white;
            padding: 1rem;
            max-width: 80%;
        }

        .number {
            font-size: 2rem;
            font-weight: bold;
            font-family: 'Lobster', cursive;
            display: block;
            margin-bottom: 0.5rem;
        }

        .bubble h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .bubble p {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        /* Responsividad */
        @media (max-width: 992px) {
            .timeline-bubbles {
                flex-direction: column;
            }

            .bubble {
                width: 250px;
                height: 250px;
            }

            .hero-section h1 {
                font-size: 2.5rem;
            }
        }

        /* Colas de las burbujas */
        .bubble::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 20px 20px 0;
            border-style: solid;
            width: 0;
            height: 0;
        }

        .bubble-1::after {
            border-color: #ffa726 transparent transparent transparent;
        }

        .bubble-2::after {
            border-color: #ef5350 transparent transparent transparent;
        }

        .bubble-3::after {
            border-color: #66bb6a transparent transparent transparent;
        }

        /* Animación */
        @keyframes floatBubble {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }

        .bubble {
            animation: floatBubble 3s ease-in-out infinite;
        }

        .bubble:nth-child(2) {
            animation-delay: 0.2s;
        }

        .bubble:nth-child(3) {
            animation-delay: 0.4s;
        }

        a {
            color: inherit;
            text-decoration: inherit;
        }
    </style>
</head>
<body>
<!-- Menú de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Pizza Misteriosa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Menú conservado tal como está -->
                <li class="nav-item">
                    <a class="nav-link" href="#participar">Participantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#resultados">Resultados</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sección principal -->
<header class="hero-section text-center text-white">
    <div class="container">
        <h1 class="display-1">Crea Tu Pizza: Misterio y Creatividad</h1>
        <p class="lead">¡Desafía tu imaginación y crea la pizza más original!</p>
        <a href="registro.php" class="btn btn-lg btn-primary mt-3">¡Regístrate Ahora!</a>
    </div>
</header>

<!-- Sección de información del concurso -->
<section id="contest-info" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Reglas del Concurso</h2>
        <div class="row">
            <!-- Tarjeta 1 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-lightbulb fa-3x mb-3"></i>
                        <h3 class="card-title">Creatividad</h3>
                        <p class="card-text">Sorprende con un título único que no deje indiferente a nadie</p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-pizza-slice fa-3x mb-3"></i>
                        <h3 class="card-title">Sabor</h3>
                        <p class="card-text">Crea una explosión de sabores que deleite el paladar de todos</p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-palette fa-3x mb-3"></i>
                        <h3 class="card-title">Presentación</h3>
                        <p class="card-text">Haz que tu pizza sea una obra de arte visual tan buena como su sabor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de la línea de tiempo -->
<section id="timeline" class="timeline-section">
    <div class="container">
        <h2 class="text-center mb-5">Dale comienzo a la experiencia</h2>
        <div class="timeline-bubbles">
            <!-- Burbuja 1 -->
            <div class="bubble bubble-1">
                <div class="bubble-content">
                    <a href="google.es">
                        <h3>Descubre las Pizzas</h3>
                        <p>Explora las creaciones de otros participantes y abre apetito</p></a>
                </div>
            </div>
            <!-- Burbuja 2 -->
            <div class="bubble bubble-2">
                <div class="bubble-content">
                    <a href="personaje.php">
                        <h3>Empieza tu Votación</h3>
                        <p>Prueba las pizzas y vota por tus favoritas en cada categoría</p></a>
                </div>
            </div>
            <!-- Burbuja 3 -->
            <div class="bubble bubble-3">
                <div class="bubble-content">
                    <a href="google.es">
                        <h3>Experiencia Plus</h3>
                        <p>Utiliza el QR para compartir tus fotos y/o vídeos más divertidos de la noche</p></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'core/db.php';

// Obtener la información de las pizzas desde la base de datos
$sql = "SELECT pizzas.id, pizzas.name AS pizza_name, pizzas.description, users.name AS user_name 
        FROM pizzas 
        JOIN users ON pizzas.user_id = users.id
        ORDER BY RAND()";
$result = $conn->query($sql);
$pizzas = [];
while ($row = $result->fetch_assoc()) {
    $pizzas[] = $row;
}
?>

<section class="pizzas-section py-5" style="background-color: #fffaf0;">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #483833; font-family: 'Lobster', cursive;">Nuestras Pizzas</h2>
        <div class="row g-4">
            <?php foreach ($pizzas as $pizza): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="https://jmaturana.link/img/Pizza.png" class="card-img-top pizza-img">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-3"><?php echo htmlspecialchars($pizza['pizza_name']); ?></h3>
                            <p class="card-text">
                                <?php echo htmlspecialchars($pizza['description']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



<!-- Pie de página -->
<footer class="text-center">
    <div class="container">
        <p>&copy; 2024 Campeonato de Pizza Misteriosa. Todos los derechos reservados.</p>
        <p>
            <a href="#participar">Participantes</a> |
            <a href="#resultados">Resultados</a>
        </p>
    </div>
</footer>

<!-- Scripts de Bootstrap y FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
