<?php
/**
 * PDO database connection, built from .env credentials.
 * Returns null (instead of throwing) when the DB is unreachable so that
 * static pages of the site keep working even before the DB is set up;
 * pages that need data must check db() !== null.
 */

function db(): ?PDO
{
    static $pdo = null;
    static $attempted = false;

    if ($pdo !== null || $attempted) {
        return $pdo;
    }

    $attempted = true;

    $host    = env('DB_HOST', '127.0.0.1');
    $port    = env('DB_PORT', '3306');
    $name    = env('DB_NAME', 'ajh_consulting');
    $user    = env('DB_USER', 'root');
    $pass    = env('DB_PASS', '');
    $charset = env('DB_CHARSET', 'utf8mb4');

    $dsn = "mysql:host={$host};port={$port};dbname={$name};charset={$charset}";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        error_log('DB connection failed: ' . $e->getMessage());
        $pdo = null;
    }

    return $pdo;
}
