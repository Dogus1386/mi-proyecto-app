<?php
$pageTitle = "Productos";

// Carga layout
$PROJECT_ROOT = is_dir(__DIR__ . "/app") ? __DIR__ : dirname(__DIR__);
require __DIR__ . "/../app/auth.php";
require_login();

require $PROJECT_ROOT . "/app/layout/header.php";

// Conexión BD
require $PROJECT_ROOT . "/config/db.php";

// Insertar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = (float)($_POST['precio'] ?? 0);
    $stock  = (int)($_POST['stock'] ?? 0);

    if ($nombre !== '') {
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $precio, $stock]);
    }

    header("Location: productos.php");
    exit;
}

// Traer productos
$productos = $pdo->query("SELECT id, nombre, precio, stock, creado_en FROM productos ORDER BY id DESC")->fetchAll();
?>

<h2>Productos</h2>
<p>Agregar y ver productos desde la base de datos.</p>

<section class="card">
  <h3>Agregar producto</h3>

  <form method="post" class="form">
    <label>
      Nombre
      <input type="text" name="nombre" required>
    </label>

    <label>
      Precio
      <input type="number" step="0.01" name="precio" value="0">
    </label>

    <label>
      Stock
      <input type="number" name="stock" value="0">
    </label>

    <button type="submit">Guardar</button>
  </form>
</section>

<section class="card">
  <h3>Lista de productos</h3>

  <?php if (!$productos): ?>
    <p>No hay productos todavía.</p>
  <?php else: ?>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th class="right">Precio</th>
          <th class="right">Stock</th>
          <th>Creado</th>
          <th>Acciones</th>



        </tr>
      </thead>
      <tbody>
<?php foreach ($productos as $p): ?>
<tr>
  <td><?= $p['id'] ?></td>
  <td><?= $p['nombre'] ?></td>
  <td><?= $p['precio'] ?></td>
  <td><?= $p['stock'] ?></td>
  <td><?= $p['creado_en'] ?></td>
  <td>
    <a href="producto_editar.php?id=<?= $p['id'] ?>">Editar</a>
    |
    <a href="producto_eliminar.php?id=<?= $p['id'] ?>">Eliminar</a>
  </td>
</tr>
<?php endforeach; ?>

      </tbody>
    </table>
  <?php endif; ?>
</section>

<?php require $PROJECT_ROOT . "/app/layout/footer.php"; ?>
