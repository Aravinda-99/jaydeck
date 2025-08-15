<?php
// Database connection
$link = mysqli_connect("localhost:4306", "root", "", "jaydeck");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$message = '';
$messageType = '';

// Debug: Always show what we received
echo "<!-- DEBUG: POST METHOD: " . $_SERVER['REQUEST_METHOD'] . " -->";
echo "<!-- DEBUG: POST KEYS: " . implode(', ', array_keys($_POST)) . " -->";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    echo "<!-- FORM SUBMITTED: YES -->";
    echo "<!-- POST DATA: " . htmlspecialchars(print_r($_POST, true)) . " -->";
    
    // Get form data (only fields that exist in your DB)
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $display_order = isset($_POST['display_order']) ? intval($_POST['display_order']) : 0;
    
    echo "<!-- RAW VALUES: name='$name', desc='$description', order=$display_order -->";
    
    // Validate required fields
    if (empty($name)) {
        $message = 'Category name is required!';
        $messageType = 'error';
        echo "<!-- VALIDATION ERROR: Name is empty -->";
    } else {
        $main_image_path = NULL; // Default to NULL if no image
        
        // Handle image upload
        if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
            echo "<!-- FILE UPLOAD: Processing category image -->";
            $uploadDir = '../assets/uploads/categories/main_image/';
            
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
                echo "<!-- DIRECTORY CREATED: $uploadDir -->";
            }
            
            $fileName = time() . '_' . basename($_FILES['category_image']['name']);
            $targetPath = $uploadDir . $fileName;
            $main_image_path = 'assets/uploads/categories/main_image/' . $fileName;
            
            echo "<!-- FILE PATH: $main_image_path -->";
            
            // Check if file is an image
            $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            
            if (in_array($imageFileType, $allowedTypes)) {
                if (!move_uploaded_file($_FILES['category_image']['tmp_name'], $targetPath)) {
                    echo "<!-- FILE UPLOAD ERROR -->";
                    $main_image_path = NULL;
                } else {
                    echo "<!-- FILE UPLOADED SUCCESSFULLY -->";
                }
            } else {
                echo "<!-- FILE TYPE ERROR -->";
                $main_image_path = NULL;
            }
        } else {
            echo "<!-- NO IMAGE UPLOADED -->";
        }
        
        // Escape data for database
        $name_escaped = mysqli_real_escape_string($link, $name);
        $description_escaped = mysqli_real_escape_string($link, $description);
        $image_part = $main_image_path ? "'$main_image_path'" : "NULL";
        
        // SQL for your simplified table structure (only 5 columns)
        $sql = "INSERT INTO product_category (name, description, image, display_order) VALUES ('$name_escaped', '$description_escaped', $image_part, $display_order)";
        
        echo "<!-- SQL QUERY: $sql -->";
        
        if (mysqli_query($link, $sql)) {
            $category_id = mysqli_insert_id($link);
            $message = 'Category added successfully! ID: ' . $category_id;
            $messageType = 'success';
            echo "<!-- DATABASE INSERT: SUCCESS - ID: $category_id -->";
            
            // Clear form data on success
            $_POST = array();
        } else {
            $message = 'Database error: ' . mysqli_error($link);
            $messageType = 'error';
            echo "<!-- DATABASE ERROR: " . mysqli_error($link) . " -->";
        }
    }
} else {
    echo "<!-- FORM NOT SUBMITTED - Method: " . $_SERVER['REQUEST_METHOD'] . " -->";
    if (!isset($_POST['add_category'])) {
        echo "<!-- add_category button not found in POST -->";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Modern Admin Panel</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            --sidebar-logo-bg: #1f2937; /* Changed to match sidebar */
            --sidebar-text: #d1d5db;
            --sidebar-text-hover: #ffffff;
            --sidebar-active-bg: #374151;
            --border-light: #e5e7eb;
            --border-dark: #374151;
            --indigo-400: #818cf8;
            --indigo-600: #4f46e5;
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
            height: 88px; /* Matched height */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--sidebar-logo-bg);
            flex-shrink: 0;
            border-bottom: 1px solid var(--border-dark); /* Added border */
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
            background-color: rgba(55, 65, 81, 0.5); /* gray-700/50 */
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
            display: none; /* Hide on mobile, shown on desktop */
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
        
        .view-all-btn {
            background-color: #6b7280;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        
        .view-all-btn:hover {
            background-color: #4b5563;
        }
        
        .message {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        
        .message.success {
            background-color: #dcfce7;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }
        
        .message.error {
            background-color: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        
        .dark .message.success {
            background-color: rgba(22, 163, 74, 0.2);
            color: #a7f3d0;
            border-color: rgba(22, 163, 74, 0.3);
        }
        
        .dark .message.error {
            background-color: rgba(220, 38, 38, 0.2);
            color: #fca5a5;
            border-color: rgba(220, 38, 38, 0.3);
        }
        
        .category-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group label {
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }
        
        .form-group input, .form-group textarea, .form-group select {
            padding: 0.75rem;
            border: 1px solid var(--border-light);
            border-radius: 0.5rem;
            font-size: 1rem;
            background-color: var(--card-bg-light);
            color: var(--text-light);
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            outline: none;
            border-color: var(--indigo-400);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .file-upload-area {
            position: relative;
            border: 2px dashed var(--border-light);
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }
        
        .file-upload-area:hover {
            border-color: var(--indigo-400);
        }
        
        .file-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }
        
        .upload-placeholder svg {
            color: #9ca3af;
            margin-bottom: 1rem;
        }
        
        .upload-placeholder p {
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }
        
        .file-info {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .image-preview {
            position: relative;
            display: inline-block;
        }
        
        .image-preview img {
            max-width: 200px;
            max-height: 150px;
            border-radius: 0.5rem;
            object-fit: cover;
        }
        
        .remove-image {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 16px;
            line-height: 1;
        }
        
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1rem;
        }
        
        .btn-cancel, .btn-submit {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-cancel {
            background-color: #6b7280;
            color: white;
        }
        
        .btn-cancel:hover {
            background-color: #4b5563;
        }
        
        .btn-submit {
            background-color: var(--indigo-600);
            color: white;
        }
        
        .btn-submit:hover {
            background-color: var(--indigo-400);
        }

        /* Responsive */
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
                <a href="index.php" class="nav-link">
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
                        <li><a href="../admin/products" class="submenu-link">All Product</a></li>
                        <li><a href="../admin/products/create" class="submenu-link">Add Product</a></li>
                        <li><a href="productCategory.php" class="submenu-link">Product Category</a></li>
                        <li><a href="addCategory.php" class="submenu-link" style="background-color: rgba(255, 255, 255, 0.1); color: #ffffff;">Add Category</a></li>
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
                    <h2>Add New Category</h2>
                    
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
                    <!-- Add Category Form -->
                    <div class="form-container">
                        <div class="form-header">
                            <h3>Add New Category</h3>
                            <a href="productCategory.php" class="view-all-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                                Back to All Categories
                            </a>
                        </div>
                        
                        <?php if ($message): ?>
                            <div class="message <?php echo $messageType; ?>">
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" enctype="multipart/form-data" class="category-form">
                            <div class="form-group">
                                <label for="name">Category Name *</label>
                                <input type="text" id="name" name="name" placeholder="Enter category name..." value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="4" placeholder="Enter category description..."><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="display_order">Display Order</label>
                                <input type="number" id="display_order" name="display_order" value="<?php echo isset($_POST['display_order']) ? intval($_POST['display_order']) : 0; ?>" min="0" placeholder="Enter display order (optional)">
                            </div>
                            
                            <div class="form-group">
                                <label for="category_image">Category Image (Optional)</label>
                                <div class="file-upload-area" id="fileUploadArea">
                                    <input type="file" id="category_image" name="category_image" accept="image/*">
                                    <div class="upload-placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/></svg>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="file-info">JPG, JPEG, PNG, GIF up to 10MB</p>
                                    </div>
                                    <div class="image-preview" id="imagePreview" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview">
                                        <button type="button" class="remove-image" onclick="removeImage()">×</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn-cancel" onclick="window.location.href='productCategory.php'">Cancel</button>
                                <button type="submit" name="add_category" class="btn-submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1-2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                                    Add Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div> <!-- Close main-content-scroll -->
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
            const fileInput = document.getElementById('category_image');
            const fileUploadArea = document.getElementById('fileUploadArea');
            const uploadPlaceholder = fileUploadArea.querySelector('.upload-placeholder');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            
            // Handle file selection
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Check file type
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Please select a valid image file (JPG, JPEG, PNG, GIF)');
                        fileInput.value = '';
                        return;
                    }
                    
                    // Check file size (10MB)
                    if (file.size > 10 * 1024 * 1024) {
                        alert('File size must be less than 10MB');
                        fileInput.value = '';
                        return;
                    }
                    
                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        uploadPlaceholder.style.display = 'none';
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            // Drag and drop functionality
            fileUploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--indigo-400)';
            });
            
            fileUploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--border-light)';
            });
            
            fileUploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                fileUploadArea.style.borderColor = 'var(--border-light)';
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });
            
            // Remove image function
            window.removeImage = function() {
                fileInput.value = '';
                uploadPlaceholder.style.display = 'block';
                imagePreview.style.display = 'none';
                previewImg.src = '';
            };

        });
    </script>
</body>
</html>
