<?php
// create.php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $nombres = $conn->real_escape_string($_POST['nombres']);
    $apaterno = $conn->real_escape_string($_POST['apaterno']);
    $amaterno = $conn->real_escape_string($_POST['amaterno']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $email = $conn->real_escape_string($_POST['email']);
    $linkedin = $conn->real_escape_string($_POST['linkedin']);

    // Insertar en la base de datos
    $sql = "INSERT INTO contacto (nombres, apaterno, amaterno, genero, fecha_nacimiento, telefono, email, linkedin)
            VALUES ('$nombres', '$apaterno', '$amaterno', '$genero', '$fecha_nacimiento', '$telefono', '$email', '$linkedin')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Contacto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Agregar Nuevo Contacto</h2>
    <form method="POST" action="create.php">
        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" required>
        </div>
        <div class="form-group">
            <label for="apaterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="apaterno" name="apaterno" required>
        </div>
        <div class="form-group">
            <label for="amaterno">Apellido Materno</label>
            <input type="text" class="form-control" id="amaterno" name="amaterno">
        </div>
        <div class="form-group">
            <label for="genero">Género</label>
            <select class="form-control" id="genero" name="genero" required>
                <option value="">Selecciona</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin">
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
