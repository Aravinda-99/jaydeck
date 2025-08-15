<?php
// Debug form to test product insertion
$link = mysqli_connect("localhost:4306", "root", "", "jaydeck");

if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

echo "<h1>DEBUG FORM TEST</h1>";
echo "<p>Request Method: " . $_SERVER['REQUEST_METHOD'] . "</p>";
echo "<p>POST Count: " . count($_POST) . "</p>";
echo "<p>FILES Count: " . count($_FILES) . "</p>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h2>POST Data:</h2>";
    echo "<pre>" . print_r($_POST, true) . "</pre>";
    
    echo "<h2>FILES Data:</h2>";
    echo "<pre>" . print_r($_FILES, true) . "</pre>";
    
    if (isset($_POST['add_product'])) {
        echo "<h2 style='color: green;'>✅ FORM SUBMITTED CORRECTLY</h2>";
        
        $name = $_POST['name'] ?? '';
        $code = $_POST['code'] ?? '';
        
        echo "<p>Name: '$name'</p>";
        echo "<p>Code: '$code'</p>";
        
        if (!empty($name) && !empty($code)) {
            $name = mysqli_real_escape_string($link, $name);
            $code = mysqli_real_escape_string($link, $code);
            
            $sql = "INSERT INTO product2 (name, code, active, created_at, updated_at) VALUES ('$name', '$code', 1, NOW(), NOW())";
            echo "<p><strong>SQL:</strong> $sql</p>";
            
            if (mysqli_query($link, $sql)) {
                $id = mysqli_insert_id($link);
                echo "<h2 style='color: green;'>✅ SUCCESS! Product added with ID: $id</h2>";
            } else {
                echo "<h2 style='color: red;'>❌ ERROR: " . mysqli_error($link) . "</h2>";
            }
        } else {
            echo "<h2 style='color: red;'>❌ Name and Code are required!</h2>";
        }
    } else {
        echo "<h2 style='color: red;'>❌ add_product button not found!</h2>";
    }
} else {
    echo "<p>Form not submitted yet</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Debug Form Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin: 10px 0; }
        input, button { padding: 8px; margin: 5px 0; }
        button { background: #007cba; color: white; border: none; padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Simple Product Add Test</h2>
    
    <form method="POST" action="">
        <div class="form-group">
            <label>Product Name *:</label><br>
            <input type="text" name="name" required>
        </div>
        
        <div class="form-group">
            <label>Product Code *:</label><br>
            <input type="text" name="code" required>
        </div>
        
        <div class="form-group">
            <button type="submit" name="add_product">Add Product</button>
        </div>
    </form>
    
    <hr>
    <h3>Recent Products in Database:</h3>
    <?php
    $result = mysqli_query($link, "SELECT id, name, code, created_at FROM product2 ORDER BY id DESC LIMIT 10");
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Name</th><th>Code</th><th>Created</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['code']}</td><td>{$row['created_at']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No products found</p>";
    }
    ?>
</body>
</html>
