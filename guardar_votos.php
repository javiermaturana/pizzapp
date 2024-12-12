<?php
include 'core/db.php';
session_start();

$voter_id = $_SESSION['user_id'];
if (!$voter_id) {
    echo "Error: No se ha seleccionado un usuario.";
    exit;
}

// Verificar si el usuario ya votó
$sql = "SELECT COUNT(*) AS total FROM votes WHERE voter_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $voter_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if ($result['total'] > 0) {
    echo "Ya has votado. Gracias.";
    exit;
}

// Procesar votos
$categories = ['originality', 'taste', 'presentation'];
foreach ($categories as $category) {
    if (!isset($_POST[$category])) {
        echo "Error: Falta la categoría $category.";
        exit;
    }

    $votes = $_POST[$category];

    // Validar posiciones únicas
    $positions = array_values($votes);
    if (count($positions) !== count(array_unique($positions))) {
        echo "Error: Las posiciones en la categoría {$category} deben ser únicas.";
        exit;
    }

    // Guardar votos
    foreach ($votes as $pizza_id => $position) {
        $sql = "INSERT INTO votes (voter_id, pizza_id, category, position)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisi", $voter_id, $pizza_id, $category, $position);
        $stmt->execute();
    }
}


    echo'<script type="text/javascript">
    alert("¡Tus votos se han registrado exitosamente!");
    window.location.href="index.php";
    </script>';
?>
