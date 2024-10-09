<?php
// edit.php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

// Obtener el contacto existente
$sql = "SELECT * FROM contacto WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
    header("Location: index.php");
    exit();
}

$contacto = $result->fetch_assoc();

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

    // Actualizar en la base de datos
    $sql = "UPDATE contacto SET 
                nombres='$nombres', 
                apaterno='$apaterno', 
                amaterno='$amaterno', 
                genero='$genero', 
                fecha_nacimiento='$fecha_nacimiento', 
                telefono='$telefono', 
                email='$email', 
                linkedin='$linkedin'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error actualizando el contacto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Contacto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Contacto</h2>
    <form method="POST" action="edit.php?id=<?= $id ?>">
        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" value="<?= htmlspecialchars($contacto['nombres']) ?>" required>
        </div>
        <div class="form-group">
            <label for="apaterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="apaterno" name="apaterno" value="<?= htmlspecialchars($contacto['apaterno']) ?>" required>
        </div>
        <div class="form-group">
            <label for="amaterno">Apellido Materno</label>
            <input type="text" class="form-control" id="amaterno" name="amaterno" value="<?= htmlspecialchars($contacto['amaterno']) ?>">
        </div>
        <div class="form-group">
            <label for="genero">Género</label>
            <select class="form-control" id="genero" name="genero" required>
                <option value="">Selecciona</option>
                <option value="Masculino" <?= $contacto['genero'] == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                <option value="Femenino" <?= $contacto['genero'] == 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                <option value="Otro" <?= $contacto['genero'] == 'Otro' ? 'selected' : '' ?>>Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($contacto['fecha_nacimiento']) ?>">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($contacto['telefono']) ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($contacto['email']) ?>">
        </div>
        <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?= htmlspecialchars($contacto['linkedin']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
