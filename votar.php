<?php
include 'core/db.php';

session_start();
$user_id = $_POST['user_id'];
$_SESSION['user_id'] = $user_id;

// Obtener pizzas de otros participantes
$sql = "SELECT pizzas.id, pizzas.name, users.name AS user_name, pizzas.description AS description FROM pizzas
        JOIN users ON pizzas.user_id = users.id
        WHERE pizzas.user_id != ?
        ORDER BY rand()";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$pizzas = [];
while ($row = $result->fetch_assoc()) {
    $pizzas[] = $row;
}

// Definir categorías
$categories = [
    'originality' => 'Nombre más Original',
    'taste' => 'Calidad y Sabor',
    'presentation' => 'Presentación'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votación de Pizzas Misteriosas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <style>
        body {
            background-color: #fffaf0;
            color: #483833;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #483833 !important;
        }
        .navbar-brand, .nav-link {
            color: #F0E9E5 !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ffa500 !important;
        }
        h1, h2 {
            color: #483833;
            text-align: center;
            margin-bottom: 30px;
        }
        .category-section {
            margin-bottom: 50px;
        }
        .cards-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .pizza-card {
            background-color: #F8F5F2;
            border: 1px solid #D4CAC4;
            border-radius: 8px;
            padding: 15px;
            cursor: grab;
            display: flex;
            align-items: center;
        }
        .pizza-card:hover {
            background-color: #eae3da;
        }
        .pizza-card:active {
            cursor: grabbing;
        }
        .pizza-rank {
            font-size: 24px;
            font-weight: bold;
            margin-right: 15px;
            color: #6F5249;
            width: 40px;
            text-align: center;
        }
        .pizza-title {
            font-size: 18px;
            font-weight: bold;
        }
        .pizza-author {
            font-size: 14px;
            color: #6F5249;
        }
        .btn-primary {
            background-color: #6F5249;
            border-color: #6F5249;
            padding: 10px 30px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #53443C;
            border-color: #53443C;
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
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                                           <a class="nav-link" href="resultados.php" target="_blank">Resultados</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Votación de Pizzas Misteriosas</h1>
        <form action="guardar_votos.php" method="post" id="votingForm">
            <?php foreach ($categories as $key => $label): ?>
                <div class="category-section">
                    <h2><?php echo $label; ?></h2>
                    <div class="cards-container" id="category-<?php echo $key; ?>">
                        <?php foreach ($pizzas as $pizza): ?>
                            <div class="pizza-card" data-id="<?php echo $pizza['id']; ?>">
                                <div class="pizza-rank">1</div>
                                <div>
                                    <div class="pizza-title"><?php echo htmlspecialchars($pizza['name']); ?></div>
                                    <!--<div class="pizza-author"><?php echo htmlspecialchars($pizza['description']); ?></div>-->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Enviar Votos</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categories = <?php echo json_encode(array_keys($categories)); ?>;

            categories.forEach(category => {
                const el = document.getElementById('category-' + category);
                new Sortable(el, {
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    onSort: function (/**Event*/evt) {
                        updateRanks(category);
                    },
                });
                updateRanks(category);
            });

            function updateRanks(category) {
                const container = document.getElementById('category-' + category);
                const cards = container.querySelectorAll('.pizza-card');
                cards.forEach((card, index) => {
                    const rank = card.querySelector('.pizza-rank');
                    rank.textContent = index + 1;
                    // Opcional: Cambiar el estilo o agregar íconos según la posición
                    switch (index) {
                        case 0:
                            rank.innerHTML = '🥇'; // Primer lugar
                            break;
                        case 1:
                            rank.innerHTML = '🥈'; // Segundo lugar
                            break;
                        case 2:
                            rank.innerHTML = '🥉'; // Tercer lugar
                            break;
                        default:
                            rank.textContent = index + 1;
                    }
                });
            }

            const form = document.getElementById('votingForm');

            form.addEventListener('submit', function(e) {
                // Limpiar inputs ocultos anteriores
                const oldInputs = form.querySelectorAll('input[type="hidden"][name^="originality"], input[type="hidden"][name^="taste"], input[type="hidden"][name^="presentation"]');
                oldInputs.forEach(input => input.remove());

                categories.forEach(category => {
                    const container = document.getElementById('category-' + category);
                    const cards = container.querySelectorAll('.pizza-card');
                    cards.forEach((card, index) => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = category + '[' + card.getAttribute('data-id') + ']';
                        input.value = index + 1; // La posición según el orden
                        form.appendChild(input);
                    });
                });
            });
        });
    </script>
    <style>
        /* Estilos adicionales para arrastrar y soltar */
        .sortable-ghost {
            opacity: 0.5;
        }
        .sortable-chosen {
            background-color: #D4CAC4 !important;
        }
    </style>
</body>
</html>
