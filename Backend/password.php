<?php

// --- [ STEP 1: CONFIGURE YOUR SETTINGS ] ---

// Database connection details
// You might need to get these from your hosting provider or configuration files.
$servername = "localhost";
$port = 4306; // The port from your screenshot
$db_username = "root"; // Your database username (e.g., 'root' or another user)
$db_password = ""; // Your database password
$dbname = "jaydeck"; // The database name from your screenshot

// User and new password details
$admin_user_id = 1; // The ID of the admin user you want to update
$new_password = "Sltds@jaydeck2020"; // <<-- IMPORTANT: Change this to your desired new password


// --- [ STEP 2: SCRIPT LOGIC (No need to edit below this line) ] ---

echo "<h2>Password Reset Script</h2>";

// Hash the new password using PHP's recommended bcrypt algorithm.
// This will create a secure hash compatible with what's already in your database.
echo "Attempting to hash the new password...<br>";
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

if (!$hashed_password) {
    die("<strong style='color:red;'>Error: Could not hash the password. Please check your PHP installation.</strong>");
}

echo "Password hashed successfully.<br>";
echo "Connecting to the database...<br>";

// Create a new database connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname, $port);

// Check the connection for errors
if ($conn->connect_error) {
    die("<strong style='color:red;'>Database Connection Failed: " . $conn->connect_error . "</strong><br>Please double-check your database credentials in the script.");
}

echo "Database connection successful.<br>";
echo "Preparing to update the password in the 'users' table...<br>";

// Prepare the SQL update statement to prevent SQL injection
$sql = "UPDATE users SET password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("<strong style='color:red;'>Error preparing statement: " . $conn->error . "</strong>");
}

// Bind the new hashed password and the admin user ID to the statement
$stmt->bind_param("si", $hashed_password, $admin_user_id);

// Execute the statement
if ($stmt->execute()) {
    echo "<h3 style='color:green;'>Success! The password for user ID {$admin_user_id} has been updated.</h3>";
    echo "Your new password is: <strong>" . htmlspecialchars($new_password) . "</strong><br>";
    echo "<p style='color:orange; font-weight:bold;'>IMPORTANT: For security reasons, please delete this PHP file from your server immediately!</p>";
} else {
    echo "<strong style='color:red;'>Error: Could not update the password: " . $stmt->error . "</strong>";
}

// Close the statement and the connection
$stmt->close();
$conn->close();

?>
