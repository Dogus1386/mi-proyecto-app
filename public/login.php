<?php
$pageTitle = "Login";

$PROJECT_ROOT = is_dir(__DIR__ . "/app") ? __DIR__ : dirname(__DIR__);
require $PROJECT_ROOT . "/config/db.php";

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $pass  = $_POST['password'] ?? '';

  $stmt = $pdo->prepare("SELECT id, nombre, email, password_hash, activo FROM usuarios WHERE email = ? LIMIT 1");
  $stmt->execute([$email]);
  $u = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$u || (int)$u['activo'] !== 1 || !password_verify($pass, $u['password_hash'])) {
    $error = "Credenciales inválidas.";
  } else {
    $_SESSION['user'] = [
      'id' => (int)$u['id'],
      'nombre' => $u['nombre'],
      'email' => $u['email'],
    ];
    header("Location: index.php");
    exit;
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<main class="container">
  <h2>Iniciar sesión</h2>

  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post" class="form" style="max-width:360px;">
    <label>Email
      <input type="email" name="email" required>
    </label>
    <label>Contraseña
      <input type="password" name="password" required>
    </label>
    <button type="submit">Entrar</button>
  </form>
</main>
</body>
</html>
