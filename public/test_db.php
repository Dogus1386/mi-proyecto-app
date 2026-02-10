<?php
require __DIR__ . "/../config/db.php";

$row = $pdo->query("SELECT NOW() AS ahora")->fetch();
echo "✅ Conectado. Hora MySQL: " . $row["ahora"];
