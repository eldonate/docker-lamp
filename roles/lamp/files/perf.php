<?php
// roles/lamp/files/perf.php
// Simple DB benchmark for CRUD operations with timing.

$host       = 'db';
$port       = 3306;
$user       = 'test_user';
$password   = 'StrongP@ssw0rd!';
$dbname     = 'test_db';
$iterations = 100;

$mysqli = new mysqli($host, $user, $password, $dbname, $port);
if ($mysqli->connect_errno) {
    die("Connection failed: ({$mysqli->connect_errno}) {$mysqli->connect_error}\n");
}

function run_timer(mysqli $m, string $sql) : float {
    $t0 = microtime(true);
    if (! $m->query($sql)) {
        die("Query Error: " . $m->error . "\nSQL: $sql\n");
    }
    return (microtime(true) - $t0) * 1000;
}

$timeCreate = run_timer($mysqli,
  "CREATE TABLE IF NOT EXISTS benchmark_test (
     id INT AUTO_INCREMENT PRIMARY KEY,
     payload VARCHAR(100) NOT NULL
   ) ENGINE=InnoDB");

$timeInsert = 0;
for ($i = 1; $i <= $iterations; $i++) {
    $val = $mysqli->real_escape_string(str_repeat('x', rand(20,80)));
    $timeInsert += run_timer($mysqli,
      "INSERT INTO benchmark_test (payload) VALUES ('$val')");
}

$timeSelect = run_timer($mysqli, "SELECT * FROM benchmark_test");
$timeSearch = run_timer($mysqli,
  "SELECT * FROM benchmark_test WHERE id = " . rand(1, $iterations));
$timeUpdate = run_timer($mysqli,
  "UPDATE benchmark_test SET payload = CONCAT(payload, '_u')");
$timeDelete = run_timer($mysqli, "DELETE FROM benchmark_test");
$timeDrop   = run_timer($mysqli, "DROP TABLE benchmark_test");

$total = $timeCreate + $timeInsert + $timeSelect
       + $timeSearch + $timeUpdate + $timeDelete + $timeDrop;

header('Content-Type: text/plain');
echo "DB BENCHMARK (n={$iterations})\n";
echo str_repeat('=', 30) . "\n";
printf("Create table:     %.2f ms\n", $timeCreate);
printf("Bulk insert:      %.2f ms\n", $timeInsert);
printf("SELECT all:       %.2f ms\n", $timeSelect);
printf("SELECT WHERE:     %.2f ms\n", $timeSearch);
printf("UPDATE all:       %.2f ms\n", $timeUpdate);
printf("DELETE all:       %.2f ms\n", $timeDelete);
printf("Drop table:       %.2f ms\n", $timeDrop);
echo str_repeat('-', 30) . "\n";
printf("TOTAL:            %.2f ms\n", $total);
$mysqli->close();
