<?php
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if ($pdo) {
    $pdo->query("UPDATE team_members SET designation = 'Practice Director & Lead Partner' WHERE id = 1");
    $pdo->query("UPDATE team_members SET designation = 'Senior CA ANZ Chartered Accountant' WHERE id = 2");
    $pdo->query("UPDATE team_members SET designation = 'Cloud Accounting & Systems Specialist' WHERE id = 3");
    $pdo->query("UPDATE team_members SET designation = 'NZ Tax & IRD Compliance Manager' WHERE id = 4");
    echo "Team designations updated.\n";
}
