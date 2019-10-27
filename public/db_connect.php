<?php

$dsn = 'mysql:127.0.0.1;utf8mb4';
$username = 'root';
$password = 'mocotarou0419';

try {
  $pdo = new PDO (
    $dsn, $username, $password,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

} catch (PDOException $e) {
  exit($e->getMessage());
}
