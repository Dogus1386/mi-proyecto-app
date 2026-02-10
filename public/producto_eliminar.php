<?php
$pageTitle = "Eliminar producto";
require __DIR__ . "/../app/layout/header.php";

// Ajusta si tu conexión está en otra ruta:
require __DIR__ . "/../config/db.php"; // <-- si tu archivo se llama distinto, me dices el nombre

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<p>ID inválido.</p>";
  require __DIR__ . "/../app/layout/footer.php";
  exit;
}

$id = (int)$_GET['id'];

// Cargar producto
$stmt = $pdo->prepare("SELECT id, nombre FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
  echo "<p>Producto no encontrado.</p>";
  require __DIR__ . "/../app/layout/footer.php";
  exit;
}

// Confirmación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
  $stmt->execute([$id]);

  header("Location: productos.php?ok=del");
  exit;
}
?>

<h2>Eliminar producto</h2>
<p>¿Seguro que deseas eliminar: <b><?= htmlspecialchars($producto['nombre']) ?></b>?</p>

<form method="POST" style="display:flex; gap:10px;">
  <button type="submit" style="background:#c00;color:#fff;">Sí, eliminar</button>
  <a href="productos.php">Cancelar</a>
</form>

<?php require __DIR__ . "/../app/layout/footer.php"; ?>
