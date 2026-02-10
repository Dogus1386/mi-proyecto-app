<?php
if (!isset($pageTitle)) {
  $pageTitle = "Mi Proyecto App";
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="stylesheet" href="/css/styles.css" />
</head>
<body>

<header class="topbar">
  <div class="brand">Mi Proyecto App</div>
  <nav class="menu">
    <a href="/">Inicio</a>
    <a href="/clientes.php">Clientes</a>
    <a href="/productos.php">Productos</a>
  </nav>
</header>

<main class="container">
