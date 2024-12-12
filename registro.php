<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pizza Misteriosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fffaf0;
            color: #483833;
        }
        .navbar {
            background-color: #483833 !important;
        }
        .navbar-brand, .nav-link {
            color: #F0E9E5 !important;
            transition: color 0.3s ease;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ffa500 !important;
        }
        h1 {
            font-family: 'Lobster', cursive;
            color: #483833;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            color: #6F5249;
        }
        .form-control {
            background-color: #F0E9E5;
            border-color: #D4CAC4;
            color: #483833;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #6F5249;
            box-shadow: 0 0 0 0.2rem rgba(111, 82, 73, 0.25);
        }
        .btn-primary {
            background-color: #6F5249;
            border-color: #6F5249;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #53443C;
            border-color: #53443C;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container {
            background-color: #D4CAC4;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Pizza Misteriosa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                                            <a class="nav-link" href="https://jmaturana.link/pizzapp/resultados.php" target="_blank">Resultados</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Registra Tu Pizza Misteriosa</h1>
        <form action="guardar_pizza.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Escribe tu nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
            </div>
            <div class="mb-3">
                <label for="pizza_nombre" class="form-label">Indica el nombre de tu pizza</label>
                <input type="text" class="form-control" id="pizza_nombre" name="pizza_nombre" placeholder="Nombre de tu pizza misteriosa" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción de tu pizza</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" placeholder="Describe tu pizza misteriosa, ingredientes secretos, etc." required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Registrar Pizza Misteriosa</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>