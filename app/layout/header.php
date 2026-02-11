<?php
// app/layout/header.php

// Base URL relativa al directorio donde está el script actual
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim($scriptDir, '/');

// Si queda "/" o ".", lo dejamos vacío
if ($baseUrl === '/' || $baseUrl === '.') {
  $baseUrl = '';
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle ?? 'Mi Proyecto App') ?></title>
  <link rel="stylesheet" href="<?= $baseUrl ?>/css/styles.css">
</head>
<body>

<header class="topbar">
  <h1>Mi Proyecto App</h1>
  <nav>
    <a href="<?= $baseUrl ?>/index.php">Inicio</a>
    <a href="<?= $baseUrl ?>/clientes.php">Clientes</a>
    <a href="<?= $baseUrl ?>/productos.php">Productos</a>
    <a href="<?= $baseUrl ?>/logout.php">Salir</a>
  </nav>
</header>

<main class="container">
