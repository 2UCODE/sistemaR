<?php
// delete.php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

// Eliminar el contacto
$sql = "DELETE FROM contacto WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error al eliminar el contacto: " . $conn->error;
}
?>
