<?php
include 'core/db.php';

// Obtener todas las pizzas
$sql = "SELECT pizzas.id, pizzas.name, users.name AS user_name FROM pizzas
        JOIN users ON pizzas.user_id = users.id";
$result = $conn->query($sql);

$pizzas = [];
while ($row = $result->fetch_assoc()) {
    $pizzas[$row['id']] = [
        'name' => $row['name'],
        'user_name' => $row['user_name'],
        'scores' => [
            'originality' => 0,
            'taste' => 0,
            'presentation' => 0
        ],
        'total_score' => 0
    ];
}

// Obtener votos y calcular puntuaciones
$sql = "SELECT pizza_id, category, SUM(5 - position) AS score FROM votes
        GROUP BY pizza_id, category";
$result = $conn->query($sql);

$category_weights = [
    'originality' => 0.20,
    'taste' => 0.55,
    'presentation' => 0.25
];

while ($row = $result->fetch_assoc()) {
    $pizza_id = $row['pizza_id'];
    $category = $row['category'];
    $score = $row['score'];

    // Calcular porcentaje sobre el máximo posible (16 puntos)
    $percentage = ($score / 16) * 100;
    $weighted_score = $percentage * $category_weights[$category];

    $pizzas[$pizza_id]['scores'][$category] = $weighted_score;
    $pizzas[$pizza_id]['total_score'] += $weighted_score;
}

// Ordenar pizzas por puntuación total
usort($pizzas, function($a, $b) {
    return $b['total_score'] <=> $a['total_score'];
});

// Obtener los tres primeros
$topThree = array_slice($pizzas, 0, 3);
$podiumOrder = [$topThree[2], $topThree[0], $topThree[1]];

// Colores para el ranking
$rankColors = ['#d6cd1e', '#bbbbbb', '#d6a21e'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Campeonato de Pizza</title>
    <link href="https://fonts.googleapis.com/css2?family=Railway&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #a5004d;
            --white: #f3f3f3;
        }
        
        body {
            font-family: "Railway", sans-serif;
            background-color: var(--white);
            background-image: url("https://www.transparenttextures.com/patterns/inspiration-geometry.png");
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            width: 100%;
            max-width: 800px;
            display: grid;
            grid-template-rows: auto 1fr;
            gap: 1em;
            padding: 20px;
        }
        
        .leaders {
                background-color: #b17a68 !important;

            background-image: url("https://www.transparenttextures.com/patterns/inspiration-geometry.png");
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 2em 1em;
            text-align: center;
        }
        
        .leaders h2 {
            font-size: 3rem;
            font-weight: 700;
            font-family: "Amatic SC", sans-serif;
            color: var(--white);
            margin-bottom: 40px;
        }
        
        .podium {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
        }
        
        .lead-pizzas {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .lead-pizzas__photo {
            width: 108px;
            height: 108px;
            margin-bottom: -20px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }
        
        .podium-place {
            background-color: var(--white);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 1em;
            text-align: center;
            position: relative;
            width: 200px;
        }
        
        .podium-place h4 {
            font-family: "Amatic SC", sans-serif;
            font-size: 1.8rem;
            color: var(--primary);
            margin: 0;
        }
        
        .podium-place p {
            color: rgb(73, 73, 73);
            margin: 5px 0;
            font-size: 0.9rem;
        }
        
        .ranking-lead {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .board {
            background-color: var(--white);
            border-radius: 10px;
            padding: 1em;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px,
                rgba(0, 0, 0, 0.3) 0px 18px 36px -18px;
        }
        
        .board h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            font-family: "Amatic SC", sans-serif;
            padding: 30px 0;
            margin: 0;
        }
        
        .pizza-item {
            display: grid;
            grid-template-columns: min-content 1fr 1fr;
            gap: 1em;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid rgb(233, 233, 233);
            transition: background-color 0.2s;
        }
        
        .pizza-item:hover {
            background-color: hsla(0, 0%, 74%, 0.102);
        }
        
        .pizza-item:last-child {
            border-bottom: none;
        }
        
        .pizza-item__photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: ##b17a68;

            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            font-size: 1.5rem;
            color: white;
        }
        
        .ranking {
            position: absolute;
            bottom: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            background-color: #1ca1fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: white;
        }
        
        .pizza-item__info h4 {
            font-family: "Amatic SC", serif;
            font-size: 1.7rem;
            color: var(--primary);
            margin: 0;
        }
        
        .pizza-item__info p {
            margin: 0;
            font-size: 0.9rem;
            color: rgb(73, 73, 73);
        }
        
        .pizza-item__scores {
            text-align: right;
        }
        
        .pizza-item__scores p {
            font-size: 1.2rem;
            color: rgb(73, 73, 73);
            margin: 0;
        }
        
        .pizza-item__scores span {
            font-size: 0.8rem;
            color: rgb(120, 120, 120);
        }
        
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
    

    <div class="container">
        <div class="leaders">
            <h2>PIZZA RANKING</h2>
            <div class="podium">
                <?php foreach ($podiumOrder as $index => $pizza): ?>
                    <div class="lead-pizzas">
                        <div class="lead-pizzas__photo">🍕</div>
                        <div class="podium-place" style="height: <?php echo $index === 1 ? '160px' : ($index === 0 ? '100px' : '130px'); ?>">
                            <div class="ranking-lead" style="background-color: <?php echo $rankColors[$index]; ?>"><?php echo $index === 1 ? 1 : ($index === 0 ? 3 : 2); ?></div>
                            <h4><?php echo $pizza['name']; ?></h4>
                            <p><?php echo number_format($pizza['total_score'], 2); ?> puntos</p>
                            <!--<p><?php echo $pizza['user_name']; ?></p>-->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="board">
            <h2>Leaderboard</h2>
            <?php foreach ($pizzas as $index => $pizza): ?>
                <div class="pizza-item">
                    <div class="pizza-item__photo">
                        🍕 
                        <div class="ranking" style="background-color: <?php echo $index < 3 ? $rankColors[$index] : '#1ca1fa'; ?>"><?php echo $index + 1; ?></div>
                    </div>
                    <div class="pizza-item__info">
                        <h4><?php echo $pizza['name']; ?></h4>
                        <!--<p><?php echo $pizza['user_name']; ?></p>-->
                    </div>
                    <div class="pizza-item__scores">
                        <p><?php echo number_format($pizza['total_score'], 2); ?> puntos</p>
                        <span>
                            Nombre más original: <?php echo number_format($pizza['scores']['originality'], 2); ?> <br>
                            Sabor y calidad: <?php echo number_format($pizza['scores']['taste'], 2); ?> <br> 
                            Presentacion: <?php echo number_format($pizza['scores']['presentation'], 2); ?> 
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

