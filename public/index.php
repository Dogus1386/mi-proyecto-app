<?php
$pageTitle = "Inicio";

// Detectar ROOT del proyecto (local: .../public | prod: .../)
$PROJECT_ROOT = is_dir(__DIR__ . "/app") ? __DIR__ : dirname(__DIR__);

require $PROJECT_ROOT . "/app/auth.php";
require_login();

require $PROJECT_ROOT . "/app/layout/header.php";
?>

<h2>Bienvenido</h2>
<p>Este es el inicio del mini sistema web. Usa el menú para navegar.</p>

<?php require $PROJECT_ROOT . "/app/layout/footer.php"; ?>
