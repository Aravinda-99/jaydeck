<?php
// Simple test to debug form submission
$link = mysqli_connect("localhost:4306", "root", "", "jaydeck");

if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

echo "<h2>Form Test</h2>";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
echo "POST data count: " . count($_POST) . "<br>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h3>POST Data Received:</h3>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    if (isset($_POST['test_submit'])) {
        echo "<h3>Form was submitted!</h3>";
        
        $name = $_POST['name'] ?? '';
        $code = $_POST['code'] ?? '';
        
        echo "Name: '$name'<br>";
        echo "Code: '$code'<br>";
        
        if (!empty($name) && !empty($code)) {
            $sql = "INSERT INTO product2 (name, code, active, created_at, updated_at) VALUES ('$name', '$code', 1, NOW(), NOW())";
            echo "SQL: $sql<br>";
            
            if (mysqli_query($link, $sql)) {
                echo "<strong style='color: green;'>SUCCESS! Product added with ID: " . mysqli_insert_id($link) . "</strong><br>";
            } else {
                echo "<strong style='color: red;'>ERROR: " . mysqli_error($link) . "</strong><br>";
            }
        } else {
            echo "<strong style='color: red;'>Name and Code are required!</strong><br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Test Form</title>
</head>
<body>
    <h1>Simple Product Test Form</h1>
    
    <form method="POST" action="">
        <p>
            <label>Product Name:</label><br>
            <input type="text" name="name" required>
        </p>
        
        <p>
            <label>Product Code:</label><br>
            <input type="text" name="code" required>
        </p>
        
        <p>
            <button type="submit" name="test_submit">Add Product</button>
        </p>
    </form>
    
    <hr>
    <h3>Current Products in Database:</h3>
    <?php
    $result = mysqli_query($link, "SELECT id, name, code, created_at FROM product2 ORDER BY id DESC LIMIT 5");
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Code</th><th>Created</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['code']}</td><td>{$row['created_at']}</td></tr>";
    }
    echo "</table>";
    ?>
</body>
</html>
