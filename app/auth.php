<?php
// app/auth.php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

/**
 * Protege una página: si no hay sesión, manda al login.
 * Funciona en local y producción porque usa ruta relativa al "directorio actual"
 * (ej: /mi-proyecto-app/public/login.php o /login.php).
 */
function require_login(): void {
  if (empty($_SESSION['user'])) {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $baseUrl = rtrim($scriptDir, '/');
    if ($baseUrl === '/' || $baseUrl === '.') $baseUrl = '';

    header("Location: " . $baseUrl . "/login.php");
    exit;
  }
}
