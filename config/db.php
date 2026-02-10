<?php
// config/db.php

// Detecta si estamos en local o en producción
$hostActual = $_SERVER['HTTP_HOST'] ?? 'localhost';
$esLocal = str_contains($hostActual, 'localhost');

// Configuración LOCAL (XAMPP)
$local = [
  'host' => '127.0.0.1',
  'port' => '3306',
  'name' => 'bienestar-fitness',
  'user' => 'root',
  'pass' => '',
];

// Configuración PRODUCCIÓN (cPanel)
$prod = [
  'host' => 'localhost',
  'port' => '3306',
  'name' => 'bienestar_fitness',
  'user' => 'bf_user',
  'pass' => 'Hhw4KxoQeUYD3NkYTymf',
];

// Elegir configuración
$db = $esLocal ? $local : $prod;

try {
  $dsn = "mysql:host={$db['host']};port={$db['port']};dbname={$db['name']};charset=utf8mb4";
  $pdo = new PDO($dsn, $db['user'], $db['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (Exception $e) {
  die("Error de conexión a BD: " . $e->getMessage());
}
