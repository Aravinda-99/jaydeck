<?php
// Database connection
$link = mysqli_connect("localhost:4306", "root", "", "jaydeck");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$message = '';
$messageType = '';
$product = null;

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    header('Location: allProduct.php');
    exit();
}

// Fetch existing product data
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
} else {
    $message = 'Product not found.';
    $messageType = 'error';
}

// Fetch brands for dropdown
$brands_sql = "SELECT id, name FROM brand ORDER BY name ASC";
$brands_result = mysqli_query($link, $brands_sql);
$brands = [];
if ($brands_result) {
    while ($brand = mysqli_fetch_assoc($brands_result)) {
        $brands[] = $brand;
    }
}

// Fetch categories for dropdown (with hierarchical structure)
$categories_sql = "SELECT id, name, category_level FROM product_categories WHERE active = 1 ORDER BY category_level ASC, name ASC";
$categories_result = mysqli_query($link, $categories_sql);
$categories = [];
if ($categories_result) {
    while ($category = mysqli_fetch_assoc($categories_result)) {
        $categories[] = $category;
    }
}

// Handle form submission
if (isset($_POST['update_product']) && $product) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $code = mysqli_real_escape_string($link, $_POST['code']);
    $slug = mysqli_real_escape_string($link, $_POST['slug']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $brand_id = intval($_POST['brand_id']);
    $main_cat_id = intval($_POST['main_cat_id']);
    $sub_cat_1_id = intval($_POST['sub_cat_1_id']);
    $sub_cat_2_id = intval($_POST['sub_cat_2_id']);
    $active = intval($_POST['active']);
    $updateImage = false;
    $newImagePath = $product['image']; // Keep existing image by default
    
    // Handle file upload if new image is provided
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/products/main_image/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($_FILES['product_image']['name']);
        $targetPath = $uploadDir . $fileName;
        $dbPath = 'assets/uploads/products/main_image/' . $fileName;
        
        // Check if file is an image
        $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetPath)) {
                // Delete old image file
                if (!empty($product['image'])) {
                    $oldImagePath = '../' . $product['image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $newImagePath = $dbPath;
                $updateImage = true;
            } else {
                $message = 'Error uploading new image.';
                $messageType = 'error';
            }
        } else {
            $message = 'Only JPG, JPEG, PNG, and GIF files are allowed.';
            $messageType = 'error';
        }
    }
    
    // Update database if no errors
    if (empty($message)) {
        $image_part = $newImagePath ? "'$newImagePath'" : "NULL";
        $brand_id_part = ($brand_id > 0) ? $brand_id : "NULL";
        $main_cat_id_part = ($main_cat_id > 0) ? $main_cat_id : "NULL";
        $sub_cat_1_id_part = ($sub_cat_1_id > 0) ? $sub_cat_1_id : "NULL";
        $sub_cat_2_id_part = ($sub_cat_2_id > 0) ? $sub_cat_2_id : "NULL";
        
        $sql = "UPDATE products SET 
                name = '$name', 
                code = '$code', 
                slug = '$slug', 
                description = '$description', 
                image = $image_part, 
                brand_id = $brand_id_part, 
                main_cat_id = $main_cat_id_part, 
                sub_cat_1_id = $sub_cat_1_id_part, 
                sub_cat_2_id = $sub_cat_2_id_part, 
                active = $active,
                updated_at = NOW()
                WHERE id = $product_id";
        
        if (mysqli_query($link, $sql)) {
            $message = 'Product updated successfully!';
            $messageType = 'success';
            // Refresh product data
            $sql = "SELECT * FROM products WHERE id = $product_id";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $product = mysqli_fetch_assoc($result);
            }
        } else {
            $message = 'Error updating product: ' . mysqli_error($link);
            $messageType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Modern Admin Panel</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="../admin/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <script src="../admin/assets/plugins/sweetalert/sweetalert.min.js"></script>

    <?php if (!empty($message) && !empty($messageType)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var messageText = <?php echo json_encode($message); ?>;
                var messageType = <?php echo json_encode($messageType); ?>;
                var messageTitle = messageType === 'success' ? 'Success!' : 'Error!';
                
                swal({
                    title: messageTitle,
                    text: messageText,
                    type: messageType,
                    confirmButtonText: "OK",
                    confirmButtonColor: messageType === 'success' ? '#4f46e5' : '#dc2626',
                    closeOnConfirm: true
                }, function() {
                    if (messageType === 'success') {
                        // Redirect to product list after successful update
                        window.location.href = 'allProduct.php';
                    }
                });
            }, 500);
        });
    </script>
    <?php endif; ?>

    <style>
        /* CSS Variables for Theming */
        :root {
            --bg-light: #f3f4f6;
            --bg-dark: #111827;
            --text-light: #1f2937;
            --text-dark: #f9fafb;
            --card-bg-light: #ffffff;
            --card-bg-dark: #1f2937;
            --sidebar-bg: #1f2937;
            --sidebar-logo-bg: #1f2937;
            --sidebar-text: #d1d5db;
            --sidebar-text-hover: #ffffff;
            --sidebar-active-bg: #374151;
            --border-light: #e5e7eb;
            --border-dark: #374151;
            --indigo-400: #818cf8;
            --indigo-600: #4f46e5;
            --green-500: #10b981;
            --red-500: #ef4444;
            --font-sans: 'Inter', sans-serif;
            --transition-speed: 300ms;
        }

        .dark {
            --bg-light: #111827;
            --bg-dark: #f3f4f6;
            --text-light: #f9fafb;
            --text-dark: #1f2937;
            --card-bg-light: #1f2937;
            --card-bg-dark: #ffffff;
            --border-light: #374151;
            --border-dark: #e5e7eb;
        }

        /* Base & Reset */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-family: var(--font-sans);
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: background-color var(--transition-speed), color var(--transition-speed);
            font-synthesis: none;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }

        /* Layout */
        .admin-panel {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 256px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: transform var(--transition-speed);
            position: fixed;
            height: 100vh;
            z-index: 20;
            transform: translateX(-100%);
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            transition: margin-left var(--transition-speed);
            margin-left: 0;
            width: 100%;
        }

        /* Mobile Header (for menu toggle) */
        .mobile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            background-color: var(--card-bg-light);
            border-bottom: 1px solid var(--border-light);
        }
        
        .menu-toggle {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .theme-toggle {
            padding: 0.5rem;
            border-radius: 9999px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            transition: background-color var(--transition-speed);
        }

        .theme-toggle:hover {
            background-color: #e5e7eb;
        }
        
        .dark .theme-toggle:hover {
             background-color: #374151;
        }

        .profile-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: none;
            cursor: pointer;
        }

        .profile-button img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--indigo-400);
        }
        
        .profile-button span {
            font-weight: 500;
            color: var(--text-light);
        }

        /* Sidebar Content */
        .sidebar-logo {
            height: 88px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--sidebar-logo-bg);
            flex-shrink: 0;
            border-bottom: 1px solid var(--border-dark);
        }
        
        .sidebar-logo svg {
            color: var(--indigo-400);
            width: 2rem;
            height: 2rem;
        }

        .sidebar-logo h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-left: 0.75rem;
        }

        .sidebar-nav {
            flex-grow: 1;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            overflow-y: auto;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.625rem 1rem;
            color: var(--sidebar-text);
            border-radius: 0.5rem;
            transition: color var(--transition-speed), background-color var(--transition-speed);
        }
        
        .nav-link:hover {
            color: var(--sidebar-text-hover);
            background-color: rgba(55, 65, 81, 0.5);
        }
        
        .nav-link.active {
            background-color: var(--sidebar-active-bg);
            color: var(--sidebar-text-hover);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        
        .nav-link svg {
            width: 1.25rem;
            height: 1.25rem;
        }
        
        .nav-link span {
            margin-left: 1rem;
            font-weight: 500;
        }

        .sidebar-footer {
            padding: 1rem;
            margin-top: auto;
        }

        /* Main Area */
        .main-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 88px;
            padding: 0 2rem;
            border-bottom: 1px solid var(--border-light);
            border-left: 1px solid var(--border-light);
            background-color: var(--card-bg-light);
            position: fixed;
            top: 0;
            right: 0;
            z-index: 15;
            flex-shrink: 0;
            width: calc(100% - 256px);
            margin-left: 256px;
        }
        
        .main-content-scroll {
            flex-grow: 1;
            padding: 2rem;
            padding-top: calc(88px + 2rem);
            overflow-y: auto;
            height: 100vh;
        }
        
        .main-header h2 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-light);
        }
        
        .main-header .header-right {
            display: none;
        }

        /* Form Styles */
        .form-container {
            background-color: var(--card-bg-light);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-light);
        }
        
        .form-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-light);
        }
        
        .back-btn {
            background-color: #6b7280;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .back-btn:hover {
            background-color: #4b5563;
        }
        
        .form-grid {
            display: grid;
            gap: 1.5rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .form-group label {
            font-weight: 500;
            color: var(--text-light);
            font-size: 0.875rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-light);
            border-radius: 0.5rem;
            background-color: var(--card-bg-light);
            color: var(--text-light);
            font-size: 0.875rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--indigo-400);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }
        
        .file-upload-area {
            border: 2px dashed var(--border-light);
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: border-color 0.3s ease, background-color 0.3s ease;
            cursor: pointer;
            background-color: var(--bg-light);
        }
        
        .file-upload-area:hover {
            border-color: var(--indigo-400);
            background-color: rgba(99, 102, 241, 0.05);
        }
        
        .file-upload-area.dragover {
            border-color: var(--indigo-400);
            background-color: rgba(99, 102, 241, 0.1);
        }
        
        .upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 1rem;
            color: #6b7280;
        }
        
        .upload-text {
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }
        
        .upload-hint {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .file-input {
            display: none;
        }
        
        .image-preview {
            max-width: 200px;
            max-height: 150px;
            border-radius: 0.5rem;
            margin-top: 1rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        
        .current-image {
            max-width: 200px;
            max-height: 150px;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            margin-bottom: 1rem;
        }
        
        .submit-btn {
            background-color: var(--indigo-600);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }
        
        .submit-btn:hover {
            background-color: var(--indigo-400);
        }
        
        .submit-btn:disabled {
            background-color: #9ca3af;
            cursor: not-allowed;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        
        .dark .alert-success {
            background-color: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
            border-color: rgba(16, 185, 129, 0.3);
        }
        
        .dark .alert-error {
            background-color: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.3);
        }

        /* Responsive */
        @media (min-width: 640px) {
            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .form-group.full-width {
                grid-column: span 2;
            }
            .profile-button span {
                display: inline;
            }
        }

        @media (max-width: 1023px) {
            .main-header {
                position: relative;
                width: 100%;
                margin-left: 0;
            }
            .main-content-scroll {
                padding-top: 2rem;
                height: auto;
            }
        }

        @media (min-width: 1024px) {
            .sidebar {
                position: fixed;
                transform: translateX(0);
                top: 0;
                left: 0;
                overflow-y: auto;
            }
            .main-content {
                margin-left: 256px;
                width: calc(100% - 256px);
            }
            .mobile-header {
                display: none;
            }
            .main-header .header-right {
                display: flex;
            }
        }

        /* Utility Classes */
        .hidden { display: none; }
        
        /* Mobile Sidebar Overlay */
        #sidebar-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0,0,0,0.6);
            z-index: 10;
        }
        
        /* Submenu Styles */
        .nav-item.has-submenu {
            position: relative;
        }
        
        .submenu-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        
        .submenu-arrow {
            transition: transform 0.3s ease;
            margin-left: auto;
        }
        
        .nav-item.has-submenu.active .submenu-arrow {
            transform: rotate(180deg);
        }
        
        .submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            margin-top: 4px;
        }
        
        .nav-item.has-submenu.active .submenu {
            max-height: 250px;
        }
        
        .submenu-link {
            display: block;
            padding: 8px 16px 8px 48px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .submenu-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .dark .submenu {
            background-color: rgba(0, 0, 0, 0.2);
        }
        
        .dark .submenu-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* SweetAlert Theme Customization */
        .sweet-alert {
            font-family: var(--font-sans) !important;
            border-radius: 8px !important;
        }

        .sweet-alert h2 {
            font-family: var(--font-sans) !important;
            font-weight: 600 !important;
            color: #1f2937 !important;
        }

        .sweet-alert p {
            font-family: var(--font-sans) !important;
            font-weight: 400 !important;
            color: #374151 !important;
        }

        /* Dark theme overrides */
        .dark .sweet-alert {
            background-color: #1f2937 !important;
        }

        .dark .sweet-alert h2 {
            color: #f9fafb !important;
        }

        .dark .sweet-alert p {
            color: #d1d5db !important;
        }

        .dark .sweet-alert .sa-icon.sa-success::before,
        .dark .sweet-alert .sa-icon.sa-success::after {
            background-color: #1f2937 !important;
        }

        .dark .sweet-alert .sa-icon.sa-success .sa-fix {
            background-color: #1f2937 !important;
        }

        /* Button styles */
        .sweet-alert button {
            font-family: var(--font-sans) !important;
            font-weight: 500 !important;
            padding: 8px 20px !important;
            border-radius: 6px !important;
        }
    </style>
</head>
<body>

    <div class="admin-panel">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.37 3.63a2.12 2.12 0 1 1 3 3L12 16l-4 1 1-4Z"/></svg>
                <h1>JayDeck</h1>
            </div>

            <nav class="sidebar-nav">
                <a href="#" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span>Users</span>
                </a>
                <a href="#" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    <span>Analytics</span>
                </a>
                <a href="#" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5"/><circle cx="17" cy="17" r="3"/><circle cx="7" cy="7" r="3"/></svg>
                    <span>Settings</span>
                </a>
                
                <!-- Slider Menu with Sub-menu -->
                <div class="nav-item has-submenu">
                    <a href="#" class="nav-link submenu-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/></svg>
                        <span>Slider</span>
                        <svg class="submenu-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6,9 12,15 18,9"/></svg>
                    </a>
                    <ul class="submenu">
                        <li><a href="Allslider.php" class="submenu-link">All Slider</a></li>
                        <li><a href="addSlider.php" class="submenu-link">Add Slider</a></li>
                    </ul>
                </div>
                
                <!-- Product Menu with Sub-menu -->
                <div class="nav-item has-submenu active">
                    <a href="#" class="nav-link submenu-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                        <span>Product</span>
                        <svg class="submenu-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6,9 12,15 18,9"/></svg>
                    </a>
                    <ul class="submenu">
                        <li><a href="allProduct.php" class="submenu-link">All Product</a></li>
                        <li><a href="addProduct.php" class="submenu-link">Add Product</a></li>
                        <li><a href="productCategory.php" class="submenu-link">Product Category</a></li>
                        <li><a href="addCategory.php" class="submenu-link">Add Category</a></li>
                    </ul>
                </div>
            </nav>

            <div class="sidebar-footer">
                 <a href="#" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <div class="main-content">
            <!-- Header for Mobile View -->
            <header class="mobile-header">
                <button id="menu-toggle" class="menu-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                </button>
                <div class="header-right">
                    <button id="theme-toggle-mobile" class="theme-toggle">
                        <svg id="theme-icon-light-mobile" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                        <svg id="theme-icon-dark-mobile" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                    </button>
                    <button class="profile-button">
                        <img src="https://placehold.co/40x40/6366f1/ffffff?text=A" alt="Admin">
                    </button>
                </div>
            </header>

            <main class="main-area">
                <!-- Header for Desktop View -->
                <div class="main-header">
                    <h2>Edit Product</h2>
                    <div class="header-right">
                        <button id="theme-toggle-desktop" class="theme-toggle">
                            <svg id="theme-icon-light-desktop" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9 Z"/></svg>
                            <svg id="theme-icon-dark-desktop" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                        </button>
                        <button class="profile-button">
                            <img src="https://placehold.co/40x40/6366f1/ffffff?text=A" alt="Admin">
                            <span>Admin User</span>
                        </button>
                    </div>
                </div>
                
                <!-- Scrollable Content Area -->
                <div class="main-content-scroll">

                    <?php if ($product): ?>
                    <!-- Edit Product Form -->
                    <div class="form-container">
                        <div class="form-header">
                            <h3>Edit Product: <?php echo htmlspecialchars($product['name']); ?></h3>
                            <a href="allProduct.php" class="back-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                                Back to All Products
                            </a>
                        </div>
                        
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="name">Product Name *</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="code">Product Code *</label>
                                    <input type="text" id="code" name="code" class="form-control" value="<?php echo htmlspecialchars($product['code']); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="slug">Product Slug *</label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="<?php echo htmlspecialchars($product['slug']); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="brand_id">Brand</label>
                                    <select id="brand_id" name="brand_id" class="form-control">
                                        <option value="0">Select Brand</option>
                                        <?php foreach ($brands as $brand): ?>
                                            <option value="<?php echo $brand['id']; ?>" <?php echo ($product['brand_id'] == $brand['id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($brand['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="category_selector">Select Category (Hierarchical)</label>
                                    <select id="category_selector" name="category_selector" class="form-control">
                                        <option value="">— Select a Category —</option>
                                        <?php
                                        // Function to display categories hierarchically (similar to addProduct.php)
                                        function displayEditProductCategoriesHierarchically($link, $parent_id = null, $level = 0, $selected_id = null) {
                                            $sql = "SELECT id, name, category_level, parent_id FROM product_categories 
                                                    WHERE active = 1 AND parent_id " . ($parent_id ? "= $parent_id" : "IS NULL") . " 
                                                    ORDER BY display_order ASC, name ASC";
                                            $result = mysqli_query($link, $sql);
                                            
                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                                                    $prefix = $level > 0 ? '├─ ' : '';
                                                    $selected = ($selected_id && $selected_id == $row['id']) ? 'selected' : '';
                                                    
                                                    echo "<option value=\"{$row['id']}\" data-level=\"{$row['category_level']}\" data-parent-id=\"{$row['parent_id']}\" $selected>";
                                                    echo $indent . $prefix . htmlspecialchars($row['name']);
                                                    echo "</option>";
                                                    
                                                    // Recursively display child categories
                                                    displayEditProductCategoriesHierarchically($link, $row['id'], $level + 1, $selected_id);
                                                }
                                            }
                                        }
                                        
                                        // Display the hierarchical categories
                                        displayEditProductCategoriesHierarchically($link, null, 0, null);
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="main_cat_id">Main Category (Auto-filled)</label>
                                    <select id="main_cat_id" name="main_cat_id" class="form-control" readonly style="background-color: #e9ecef; cursor: not-allowed;">
                                        <option value="">— Will be auto-filled —</option>
                                        <?php foreach ($categories as $category): ?>
                                            <?php if ($category['category_level'] == 0): ?>
                                                <option value="<?php echo $category['id']; ?>" <?php echo ($product['main_cat_id'] == $category['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category['name']); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="sub_cat_1_id">Sub Category 1 (Auto-filled)</label>
                                    <select id="sub_cat_1_id" name="sub_cat_1_id" class="form-control" readonly style="background-color: #e9ecef; cursor: not-allowed;">
                                        <option value="">— Will be auto-filled —</option>
                                        <?php foreach ($categories as $category): ?>
                                            <?php if ($category['category_level'] == 1): ?>
                                                <option value="<?php echo $category['id']; ?>" <?php echo ($product['sub_cat_1_id'] == $category['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category['name']); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="sub_cat_2_id">Sub Category 2 (Auto-filled)</label>
                                    <select id="sub_cat_2_id" name="sub_cat_2_id" class="form-control" readonly style="background-color: #e9ecef; cursor: not-allowed;">
                                        <option value="">— Will be auto-filled —</option>
                                        <?php foreach ($categories as $category): ?>
                                            <?php if ($category['category_level'] == 2): ?>
                                                <option value="<?php echo $category['id']; ?>" <?php echo ($product['sub_cat_2_id'] == $category['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category['name']); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="active">Status</label>
                                    <select id="active" name="active" class="form-control">
                                        <option value="1" <?php echo ($product['active'] == 1) ? 'selected' : ''; ?>>Active</option>
                                        <option value="0" <?php echo ($product['active'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>
                                
                                <div class="form-group full-width">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
                                </div>
                                
                                <div class="form-group full-width">
                                    <label for="product_image">Product Image</label>
                                    
                                    <?php if (!empty($product['image'])): ?>
                                        <div>
                                            <p style="margin-bottom: 0.5rem; color: #6b7280; font-size: 0.875rem;">Current Image:</p>
                                            <img src="../<?php echo htmlspecialchars($product['image']); ?>" 
                                                 alt="Current product image" 
                                                 class="current-image"
                                                 onerror="this.src='https://placehold.co/200x150/6366f1/ffffff?text=IMG'">
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="file-upload-area" onclick="document.getElementById('product_image').click()">
                                        <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="upload-text">Click to upload new image or drag and drop</p>
                                        <p class="upload-hint">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                    <input type="file" id="product_image" name="product_image" class="file-input" accept="image/*">
                                    <img id="imagePreview" class="image-preview hidden" alt="Preview">
                                </div>
                            </div>
                            
                            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                                <button type="submit" name="update_product" class="submit-btn">Update Product</button>
                                <a href="allProduct.php" class="back-btn">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <?php else: ?>
                        <div class="form-container">
                            <div class="alert alert-error">
                                Product not found.
                            </div>
                            <a href="allProduct.php" class="back-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                                Back to All Products
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
    
    <div id="sidebar-overlay" class="hidden"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggleBtnDesktop = document.getElementById('theme-toggle-desktop');
            const themeToggleBtnMobile = document.getElementById('theme-toggle-mobile');
            const htmlEl = document.documentElement;

            const setTheme = (theme) => {
                const lightIcons = document.querySelectorAll('[id^="theme-icon-light"]');
                const darkIcons = document.querySelectorAll('[id^="theme-icon-dark"]');

                if (theme === 'dark') {
                    htmlEl.classList.add('dark');
                    lightIcons.forEach(icon => icon.classList.remove('hidden'));
                    darkIcons.forEach(icon => icon.classList.add('hidden'));
                    localStorage.setItem('theme', 'dark');
                } else {
                    htmlEl.classList.remove('dark');
                    lightIcons.forEach(icon => icon.classList.add('hidden'));
                    darkIcons.forEach(icon => icon.classList.remove('hidden'));
                    localStorage.setItem('theme', 'light');
                }
            };
            
            const toggleTheme = () => {
                const currentTheme = htmlEl.classList.contains('dark') ? 'dark' : 'light';
                setTheme(currentTheme === 'dark' ? 'light' : 'dark');
            };

            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme) {
                setTheme(savedTheme);
            } else {
                setTheme(prefersDark ? 'dark' : 'light');
            }

            themeToggleBtnDesktop.addEventListener('click', toggleTheme);
            themeToggleBtnMobile.addEventListener('click', toggleTheme);

            const menuToggleBtn = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            const toggleSidebar = () => {
                const isVisible = sidebar.style.transform === 'translateX(0px)';
                sidebar.style.transform = isVisible ? 'translateX(-100%)' : 'translateX(0px)';
                sidebarOverlay.classList.toggle('hidden', isVisible);
            };

            menuToggleBtn.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);
            
            // Submenu toggle functionality
            const submenuToggles = document.querySelectorAll('.submenu-toggle');
            
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const navItem = this.closest('.nav-item');
                    const isActive = navItem.classList.contains('active');
                    
                    // Close all other submenus
                    document.querySelectorAll('.nav-item.has-submenu').forEach(item => {
                        if (item !== navItem) {
                            item.classList.remove('active');
                        }
                    });
                    
                    // Toggle current submenu
                    navItem.classList.toggle('active');
                });
            });
            
            // File upload functionality
            const fileInput = document.getElementById('product_image');
            const fileUploadArea = document.querySelector('.file-upload-area');
            const imagePreview = document.getElementById('imagePreview');

            if (fileInput && fileUploadArea) {
                // Handle file selection
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Handle drag and drop
                fileUploadArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    fileUploadArea.classList.add('dragover');
                });

                fileUploadArea.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    fileUploadArea.classList.remove('dragover');
                });

                fileUploadArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    fileUploadArea.classList.remove('dragover');
                    
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        const file = files[0];
                        if (file.type.startsWith('image/')) {
                            fileInput.files = files;
                            
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                imagePreview.src = e.target.result;
                                imagePreview.classList.remove('hidden');
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });
            }
            
            // Category hierarchy auto-fill functionality (similar to addProduct.php)
            const categorySelector = document.getElementById('category_selector');
            const mainCatSelect = document.getElementById('main_cat_id');
            const subCat1Select = document.getElementById('sub_cat_1_id');
            const subCat2Select = document.getElementById('sub_cat_2_id');
            
            // Function to pre-select hierarchical dropdown based on existing category values
            function preselectHierarchicalCategory() {
                const mainCatValue = mainCatSelect.value;
                const subCat1Value = subCat1Select.value;
                const subCat2Value = subCat2Select.value;
                
                // Determine which category to pre-select in hierarchical dropdown
                let categoryToSelect = '';
                if (subCat2Value) {
                    categoryToSelect = subCat2Value;
                } else if (subCat1Value) {
                    categoryToSelect = subCat1Value;
                } else if (mainCatValue) {
                    categoryToSelect = mainCatValue;
                }
                
                if (categoryToSelect) {
                    categorySelector.value = categoryToSelect;
                }
            }
            
            // Pre-select on page load
            preselectHierarchicalCategory();
            
            if (categorySelector) {
                categorySelector.addEventListener('change', function() {
                    const selectedCategoryId = this.value;
                    const selectedOption = this.options[this.selectedIndex];
                    
                    // Reset all category dropdowns
                    mainCatSelect.value = '';
                    subCat1Select.value = '';
                    subCat2Select.value = '';
                    
                    if (selectedCategoryId) {
                        const categoryLevel = parseInt(selectedOption.getAttribute('data-level'));
                        const parentId = selectedOption.getAttribute('data-parent-id');
                        
                        console.log('Selected Category:', selectedCategoryId, 'Level:', categoryLevel, 'Parent:', parentId);
                        
                        // Set the appropriate category field based on level
                        if (categoryLevel === 0) {
                            // Main category selected
                            mainCatSelect.value = selectedCategoryId;
                        } else if (categoryLevel === 1) {
                            // Sub category 1 selected - need to find its main category
                            subCat1Select.value = selectedCategoryId;
                            findAndSetParentCategory(parentId, 0, mainCatSelect);
                        } else if (categoryLevel === 2) {
                            // Sub category 2 selected - need to find its parents
                            subCat2Select.value = selectedCategoryId;
                            findAndSetParentCategory(parentId, 1, subCat1Select);
                            // Also need to find the main category (grandparent)
                            findParentHierarchy(selectedCategoryId);
                        }
                    }
                });
            }
            
            // Function to find and set parent category
            function findAndSetParentCategory(parentId, expectedLevel, targetSelect) {
                if (!parentId || parentId === 'NULL') return;
                
                // Find the parent in the hierarchical dropdown
                for (let i = 0; i < categorySelector.options.length; i++) {
                    const option = categorySelector.options[i];
                    if (option.value === parentId) {
                        const level = parseInt(option.getAttribute('data-level'));
                        if (level === expectedLevel) {
                            targetSelect.value = parentId;
                        } else if (level < expectedLevel) {
                            // Continue searching up the hierarchy
                            const grandParentId = option.getAttribute('data-parent-id');
                            findAndSetParentCategory(grandParentId, expectedLevel, targetSelect);
                        }
                        break;
                    }
                }
            }
            
            // Function to find complete parent hierarchy for level 2 categories
            function findParentHierarchy(categoryId) {
                // This is a more comprehensive approach to find all parents
                const categoryData = {};
                
                // Build category data map from dropdown options
                for (let i = 0; i < categorySelector.options.length; i++) {
                    const option = categorySelector.options[i];
                    if (option.value) {
                        categoryData[option.value] = {
                            level: parseInt(option.getAttribute('data-level')),
                            parentId: option.getAttribute('data-parent-id')
                        };
                    }
                }
                
                // Trace back to find all parents
                let currentId = categoryId;
                let currentData = categoryData[currentId];
                
                while (currentData && currentData.parentId && currentData.parentId !== 'NULL') {
                    const parentData = categoryData[currentData.parentId];
                    if (parentData) {
                        if (parentData.level === 1) {
                            subCat1Select.value = currentData.parentId;
                        } else if (parentData.level === 0) {
                            mainCatSelect.value = currentData.parentId;
                        }
                    }
                    currentId = currentData.parentId;
                    currentData = parentData;
                }
            }
        });
    </script>
</body>
</html>
