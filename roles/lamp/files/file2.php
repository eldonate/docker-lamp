<?php
$host     = 'db';       // <— use the Compose service name
$port     = 3306;
$user     = 'test_user';
$password = 'StrongP@ssw0rd!';
$dbname   = 'test_db';

$mysqli = new mysqli($host, $user, $password, $dbname, $port);
if ($mysqli->connect_errno) {
    echo "❌ Connection failed: (" . $mysqli->connect_errno . ") " 
         . $mysqli->connect_error;
    exit;
}
echo "✅ Successfully connected to database '{$dbname}' on {$host}:{$port}";
$mysqli->close();
