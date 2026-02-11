<?php
$pageTitle = "Eliminar producto";

$PROJECT_ROOT = is_dir(__DIR__ . "/app") ? __DIR__ : dirname(__DIR__);

require $PROJECT_ROOT . "/app/auth.php";
require_login();

require $PROJECT_ROOT . "/app/layout/header.php";
require $PROJECT_ROOT . "/config/db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<p>ID inválido.</p>";
  require $PROJECT_ROOT . "/app/layout/footer.php";
  exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT id, nombre FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch();

if (!$producto) {
  echo "<p>Producto no encontrado.</p>";
  require $PROJECT_ROOT . "/app/layout/footer.php";
  exit;
}

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

<?php require $PROJECT_ROOT . "/app/layout/footer.php"; ?>
