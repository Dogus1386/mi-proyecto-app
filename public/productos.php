<?php
$pageTitle = "Productos";

$PROJECT_ROOT = is_dir(__DIR__ . "/app") ? __DIR__ : dirname(__DIR__);
require $PROJECT_ROOT . "/app/layout/header.php";
?>

<h2>Productos</h2>
<p>Esta será la pantalla de productos.</p>

<?php require $PROJECT_ROOT . "/app/layout/footer.php"; ?>
