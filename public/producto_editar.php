<?php
$pageTitle = "Editar producto";

// Root del proyecto (sirve en local y en producción)
$PROJECT_ROOT = is_dir(__DIR__ . "/../app") ? dirname(__DIR__) : __DIR__;
require $PROJECT_ROOT . "/app/auth.php";
require_login();

// Layout
require $PROJECT_ROOT . "/app/layout/header.php";

// Conexión BD
require $PROJECT_ROOT . "/config/db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<p>ID inválido.</p>";
  require $PROJECT_ROOT . "/app/layout/footer.php";
  exit;
}

$id = (int)$_GET['id'];

// 1) Cargar producto
$stmt = $pdo->prepare("SELECT id, nombre, precio, stock FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
  echo "<p>Producto no encontrado.</p>";
  require $PROJECT_ROOT . "/app/layout/footer.php";
  exit;
}

$mensaje = "";

// 2) Guardar cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre'] ?? '');
  $precio = $_POST['precio'] ?? '';
  $stock  = $_POST['stock'] ?? '';

  if ($nombre === '' || !is_numeric($precio) || !is_numeric($stock)) {
    $mensaje = "Por favor completa los datos correctamente.";
  } else {
    $stmt = $pdo->prepare("UPDATE productos SET nombre=?, precio=?, stock=? WHERE id=?");
    $stmt->execute([$nombre, $precio, $stock, $id]);

    header("Location: productos.php?ok=edit");
    exit;
  }
}
?>

<h2>Editar producto</h2>

<?php if ($mensaje): ?>
  <p style="color:red;"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<form method="POST" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
  <label>Nombre
    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
  </label>

  <label>Precio
    <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required>
  </label>

  <label>Stock
    <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" required>
  </label>

  <button type="submit">Guardar cambios</button>
  <a href="productos.php">Cancelar</a>
</form>

<?php require $PROJECT_ROOT . "/app/layout/footer.php"; ?>
