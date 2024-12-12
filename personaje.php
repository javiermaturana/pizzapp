<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Personaje - Campeonato de Pizza Misteriosa</title>
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
        .card {
            background-color: #D4CAC4;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .card:hover, .card.selected {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card.selected {
            border: 3px solid #6F5249;
        }
        .card-title {
            color: #6F5249;
            font-family: 'Lobster', cursive;
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
                    <a class="nav-link" href="resultados.php" target="_blank">Resultados</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Elige tu Personaje Pizzero</h1>
        
        <form action="votar.php" method="post" id="characterForm">
            <input type="hidden" name="user_id" id="selectedCharacter">
            
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4 mb-4">
                <?php
                include 'core/db.php';
                $sql = "SELECT id, name FROM users LIMIT 5";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='col'>
                        <div class='card h-100 character-card' data-id='{$row['id']}'>
                            <div class='card-body text-center'>
                                <h5 class='card-title'>{$row['name']}</h5>
                                <p class='card-text'>Maestr@ Pizzer@</p>
                            </div>
                        </div>
                    </div>
                    ";
                }
                ?>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg" disabled >Comenzar Votación</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.character-card');
            const form = document.getElementById('characterForm');
            const hiddenInput = document.getElementById('selectedCharacter');
            const startButton = document.getElementById('startVotingBtn');

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    cards.forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                    hiddenInput.value = this.dataset.id;
                    startButton.disabled = false;
                });
            });

            form.addEventListener('submit', function(e) {
                if (!hiddenInput.value) {
                    e.preventDefault();
                    alert('Por favor, selecciona un personaje antes de continuar.');
                }
            });
        });
    </script>
</body>
</html>