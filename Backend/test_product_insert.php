<?php
// Simple test script to check product insertion
$link = mysqli_connect("localhost:4306", "root", "", "jaydeck");

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

echo "Database connection: SUCCESS<br>";

// Test basic insertion
$test_sql = "INSERT INTO product2 (name, code, slug, description, active, created_at, updated_at) 
             VALUES ('Test Product', 'TEST001', 'test-product', 'Test Description', 1, NOW(), NOW())";

echo "SQL Query: " . $test_sql . "<br>";

if (mysqli_query($link, $test_sql)) {
    echo "Test product inserted successfully! ID: " . mysqli_insert_id($link) . "<br>";
} else {
    echo "Error: " . mysqli_error($link) . "<br>";
}

// Show product2 table structure
$structure_sql = "DESCRIBE product2";
$result = mysqli_query($link, $structure_sql);

echo "<h3>Product2 Table Structure:</h3>";
echo "<table border='1'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['Field'] . "</td>";
    echo "<td>" . $row['Type'] . "</td>";
    echo "<td>" . $row['Null'] . "</td>";
    echo "<td>" . $row['Key'] . "</td>";
    echo "<td>" . $row['Default'] . "</td>";
    echo "<td>" . $row['Extra'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($link);
?>
