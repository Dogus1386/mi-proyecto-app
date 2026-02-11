<?php
// app/layout/header.php

// Base URL automática (local: /mi-proyecto-app/public | prod: '')
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim($scriptDir, '/');
if ($baseUrl === '/' || $baseUrl === '.') {
  $baseUrl = '';
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
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
