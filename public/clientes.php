<?php
$pageTitle = "Clientes";

$PROJECT_ROOT = is_dir(__DIR__ . "/../app") ? dirname(__DIR__) : __DIR__;
require $PROJECT_ROOT . "/app/auth.php";
require_login();

require $PROJECT_ROOT . "/app/layout/header.php";
?>

<h2>Clientes</h2>
<p>Esta será la pantalla de clientes.</p>

<?php require $PROJECT_ROOT . "/app/layout/footer.php"; ?>

