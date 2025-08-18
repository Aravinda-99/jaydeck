<?php
require_once '../connection.php';

echo "<h2>Password Hashing Utility</h2>";
echo "<p>This script will hash any plain text passwords in your users table.</p>";

// Get all users with passwords
$query = "SELECT id, email, password FROM users";
$result = mysqli_query($link, $query);

if ($result) {
    echo "<h3>Users found:</h3>";
    $updated_count = 0;
    
    while ($user = mysqli_fetch_assoc($result)) {
        echo "<div style='margin: 10px; padding: 10px; border: 1px solid #ccc;'>";
        echo "<strong>ID:</strong> " . $user['id'] . "<br>";
        echo "<strong>Email:</strong> " . htmlspecialchars($user['email']) . "<br>";
        
        // Check if password is already hashed (bcrypt hashes start with $2y$ and are 60 chars long)
        if (strlen($user['password']) !== 60 || !str_starts_with($user['password'], '$2y$')) {
            echo "<strong>Current password:</strong> " . htmlspecialchars($user['password']) . " (PLAIN TEXT)<br>";
            
            // Hash the password
            $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
            
            // Update in database
            $update_stmt = mysqli_prepare($link, "UPDATE users SET password = ? WHERE id = ?");
            mysqli_stmt_bind_param($update_stmt, "si", $hashed_password, $user['id']);
            
            if (mysqli_stmt_execute($update_stmt)) {
                echo "<strong>Status:</strong> <span style='color: green;'>Password hashed successfully!</span><br>";
                $updated_count++;
            } else {
                echo "<strong>Status:</strong> <span style='color: red;'>Failed to update password</span><br>";
            }
            mysqli_stmt_close($update_stmt);
        } else {
            echo "<strong>Status:</strong> <span style='color: blue;'>Password already hashed</span><br>";
        }
        echo "</div>";
    }
    
    echo "<h3>Summary:</h3>";
    echo "<p>Updated $updated_count passwords.</p>";
    
    if ($updated_count > 0) {
        echo "<div style='background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
        echo "<strong>Important:</strong> Passwords have been hashed. You can now use the login form with the original plain text passwords.";
        echo "</div>";
    }
} else {
    echo "<p style='color: red;'>Error retrieving users: " . mysqli_error($link) . "</p>";
}

echo "<br><a href='login.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Login Page</a>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}
</style>