<?php
$pageTitle = "Productos";

$PROJECT_ROOT = is_dir(__DIR__ . "/app") ? __DIR__ : dirname(__DIR__);

require $PROJECT_ROOT . "/app/auth.php";
require_login();

require $PROJECT_ROOT . "/app/layout/header.php";
require $PROJECT_ROOT . "/config/db.php";

// Insertar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre'] ?? '');
  $precio = $_POST['precio'] ?? '';
  $stock  = $_POST['stock'] ?? '';

  if ($nombre !== '' && is_numeric($precio) && is_numeric($stock)) {
    $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $precio, $stock]);
    header("Location: productos.php?ok=add");
    exit;
  }
}

// Listar productos
$stmt = $pdo->query("SELECT id, nombre, precio, stock, creado_en FROM productos ORDER BY id DESC");
$productos = $stmt->fetchAll();
?>

<h2>Productos</h2>
<p>Agregar y ver productos desde la base de datos.</p>

<h3>Agregar producto</h3>
<form method="POST" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
  <label>Nombre
    <input type="text" name="nombre" required>
  </label>

  <label>Precio
    <input type="number" step="0.01" name="precio" required>
  </label>

  <label>Stock
    <input type="number" name="stock" required>
  </label>

  <button type="submit">Guardar</button>
</form>

<h3>Lista de productos</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Stock</th>
      <th>Creado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($productos as $p): ?>
    <tr>
      <td><?= (int)$p['id'] ?></td>
      <td><?= htmlspecialchars($p['nombre']) ?></td>
      <td>₡ <?= number_format((float)$p['precio'], 2) ?></td>
      <td><?= (int)$p['stock'] ?></td>
      <td><?= htmlspecialchars($p['creado_en']) ?></td>
      <td>
        <a href="producto_editar.php?id=<?= (int)$p['id'] ?>">Editar</a> |
        <a href="producto_eliminar.php?id=<?= (int)$p['id'] ?>">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php require $PROJECT_ROOT . "/app/layout/footer.php"; ?>
