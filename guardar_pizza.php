<?php
include 'core/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario y sanitizarlos
    $nombre = trim($_POST['nombre']);
    $pizza_nombre = trim($_POST['pizza_nombre']);
    $descripcion = trim($_POST['descripcion']);

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($pizza_nombre) || empty($descripcion)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Verificar que el nombre del participante exista en la base de datos
    $sql = "SELECT id FROM users WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "El nombre ingresado no coincide con ningún participante registrado.";
        exit;
    }

    // Obtener el ID del usuario
    $user = $result->fetch_assoc();
    $user_id = $user['id'];

    // Verificar si el usuario ya tiene una pizza registrada
    $sql = "SELECT id FROM pizzas WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si existe, actualizar el registro
        $sql = "UPDATE pizzas SET name = ?, description = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $pizza_nombre, $descripcion, $user_id);
        $stmt->execute();
        echo "¡Tu pizza ha sido actualizada exitosamente!";
    } else {
        // Si no existe, insertar un nuevo registro
        $sql = "INSERT INTO pizzas (user_id, name, description) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $pizza_nombre, $descripcion);
        $stmt->execute();
        echo "¡Tu pizza ha sido registrada exitosamente!";
    }

    echo'<script type="text/javascript">
    alert("¡Tu pizza ha sido registrada exitosamente!");
    window.location.href="index.php";
    </script>';
    

    // exit;
} else {
    echo "Método de solicitud no válido.";
}
?>
