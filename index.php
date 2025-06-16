<?php

$redis = new Redis();

try {
    $redis->connect('redis', 6379);  // Use the service name as hostname
    error_log("✅ Connected to Redis successfully.");

    // Set a value
    $redis->set("test-key", "Hello from Redis");

    // Retrieve the value
    $value = $redis->get("test-key");

    echo "<h1>✅ Redis Test Successful</h1>";
    echo "<p><strong>test-key:</strong> $value</p>";

} catch (Exception $e) {
    error_log("❌ Redis connection failed: " . $e->getMessage());
    echo "<h1>❌ Redis Test Failed</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
