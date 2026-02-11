<?php
// app/auth.php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function require_login(): void {
  if (empty($_SESSION['user'])) {
    // Redirección robusta (sirve en local y en producción)
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $baseUrl = rtrim($scriptDir, '/');
    if ($baseUrl === '/' || $baseUrl === '.' ) $baseUrl = '';

    header("Location: {$baseUrl}/login.php");
    exit;
  }
}
