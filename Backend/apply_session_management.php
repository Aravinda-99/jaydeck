<?php
// Script to help apply session management to all Backend PHP files

echo "<h2>Session Management Application Tool</h2>";
echo "<p>This tool will help you apply session management to all your Backend PHP files.</p>";

// List of Backend PHP files that might need session management
$backend_files = [
    'addProduct.php',
    'addCategory.php', 
    'addSlider.php',
    'allProduct.php',
    'editProduct.php',
    'editProductCategory.php',
    'editSlider.php',
    'productCategory.php'
];

echo "<h3>Files that may need session management:</h3>";
echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 10px 0;'>";

foreach ($backend_files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        echo "<div style='margin: 10px 0; padding: 10px; border: 1px solid #ddd; border-radius: 5px;'>";
        echo "<strong>$file</strong><br>";
        
        // Check if file already has session_start()
        if (strpos($content, 'session_start()') !== false) {
            echo "<span style='color: green;'>✓ Already has session management</span><br>";
        } else {
            echo "<span style='color: red;'>✗ Missing session management</span><br>";
            echo "<small>Needs: session_start(), login check, and logout button fix</small><br>";
        }
        
        // Check for logout button
        if (strpos($content, 'href="logout.php"') !== false) {
            echo "<span style='color: green;'>✓ Logout button is fixed</span><br>";
        } elseif (strpos($content, 'Logout') !== false) {
            echo "<span style='color: orange;'>⚠ Has logout button but needs href fix</span><br>";
        } else {
            echo "<span style='color: blue;'>ℹ No logout button found</span><br>";
        }
        
        echo "</div>";
    } else {
        echo "<div style='margin: 10px 0; padding: 10px; border: 1px solid #ddd; border-radius: 5px;'>";
        echo "<strong>$file</strong> - <span style='color: gray;'>File not found</span>";
        echo "</div>";
    }
}

echo "</div>";

echo "<h3>Code Template to Add:</h3>";
echo "<div style='background: #f1f3f4; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
echo "<strong>1. Add at the very beginning of PHP files (after &lt;?php):</strong>";
echo "<pre style='background: #fff; padding: 10px; margin: 10px 0; border-radius: 3px;'>";
echo htmlspecialchars('session_start();

// Check if user is logged in
if (!isset($_SESSION[\'user_id\'])) {
    header("Location: login.php");
    exit();
}

// Get user information from session
$user_name = isset($_SESSION[\'user_name\']) ? $_SESSION[\'user_name\'] : \'Admin User\';
$user_email = isset($_SESSION[\'user_email\']) ? $_SESSION[\'user_email\'] : \'\';');
echo "</pre>";

echo "<strong>2. Fix logout buttons (change href=\"#\" to):</strong>";
echo "<pre style='background: #fff; padding: 10px; margin: 10px 0; border-radius: 3px;'>";
echo htmlspecialchars('<a href="logout.php" class="nav-link" onclick="return confirm(\'Are you sure you want to logout?\')">');
echo "</pre>";

echo "<strong>3. Update profile buttons to show user info:</strong>";
echo "<pre style='background: #fff; padding: 10px; margin: 10px 0; border-radius: 3px;'>";
echo htmlspecialchars('<img src="https://placehold.co/40x40/6366f1/ffffff?text=<?php echo strtoupper(substr($user_name, 0, 1)); ?>" alt="<?php echo htmlspecialchars($user_name); ?>">
<span><?php echo htmlspecialchars($user_name); ?></span>');
echo "</pre>";
echo "</div>";

echo "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
echo "<strong>✅ Files Fixed So Far:</strong><br>";
echo "• index.php - Session management and logout working<br>";
echo "• Allslider.php - Session management and logout working<br>";
echo "• login.php - Authentication system complete<br>";
echo "• logout.php - Session destruction working<br>";
echo "</div>";

echo "<br><a href='index.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-right: 10px;'>Go to Dashboard</a>";
echo "<a href='Allslider.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Allslider</a>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    line-height: 1.6;
}
</style>