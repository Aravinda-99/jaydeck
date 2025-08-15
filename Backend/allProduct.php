
<?php
// Database connection
$link = mysqli_connect("localhost:4306", "root", "", "jaydeck");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Handle product deletion
if (isset($_POST['delete_product'])) {
    $product_id = intval($_POST['delete_product']);
    
    // First get the image path to delete the file
    $get_image_sql = "SELECT image FROM products WHERE id = $product_id";
    $image_result = mysqli_query($link, $get_image_sql);
    if ($image_result && $image_row = mysqli_fetch_assoc($image_result)) {
        $image_path = "../" . $image_row['image'];
        if (file_exists($image_path) && !empty($image_row['image'])) {
            unlink($image_path); // Delete the image file
        }
    }
    
    // Delete from database
    $delete_sql = "DELETE FROM products WHERE id = $product_id";
    if (mysqli_query($link, $delete_sql)) {
        echo "<script>alert('Product deleted successfully!'); window.location.href='allProduct.php';</script>";
    } else {
        echo "<script>alert('Error deleting product: " . mysqli_error($link) . "');</script>";
    }
}

// Pagination variables
$items_per_page = 10;
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($current_page - 1) * $items_per_page;

// Get total count of products
$count_sql = "SELECT COUNT(*) as total FROM products p";
$count_result = mysqli_query($link, $count_sql);
$total_items = 0;
if ($count_result) {
    $count_row = mysqli_fetch_assoc($count_result);
    $total_items = $count_row['total'];
}
$total_pages = ceil($total_items / $items_per_page);

// Fetch product data from database with brand and category information (with pagination)
$sql = "SELECT p.id, p.name, p.code, p.slug, p.description, p.image, p.active, p.brand_id, p.main_cat_id, p.sub_cat_1_id, p.sub_cat_2_id, 
               b.name as brand_name, c1.name as main_category_name, c2.name as sub_cat_1_name, c3.name as sub_cat_2_name 
        FROM products p 
        LEFT JOIN brand b ON p.brand_id = b.id 
        LEFT JOIN product_categories c1 ON p.main_cat_id = c1.id 
        LEFT JOIN product_categories c2 ON p.sub_cat_1_id = c2.id 
        LEFT JOIN product_categories c3 ON p.sub_cat_2_id = c3.id 
        ORDER BY p.id DESC
        LIMIT $items_per_page OFFSET $offset";
$result = mysqli_query($link, $sql);
$products = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - Modern Admin Panel</title>
    
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
        
        /* Search Bar Styles */
        .search-container {
            flex: 1;
            max-width: 400px;
            margin: 0 2rem;
        }
        
        .search-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .search-icon {
            position: absolute;
            left: 12px;
            color: #9ca3af;
            pointer-events: none;
            transition: color 0.3s ease;
        }
        
        .search-input {
            width: 100%;
            padding: 10px 12px 10px 40px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            font-size: 14px;
            background-color: var(--card-bg-light);
            color: var(--text-light);
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--indigo-400);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .search-input::placeholder {
            color: #9ca3af;
            transition: color 0.3s ease;
        }
        
        /* Dark theme styles for search bar */
        .dark .search-input {
            background-color: var(--card-bg-dark);
            border-color: var(--border-dark);
            color: var(--text-light);
        }
        
        .dark .search-input:focus {
            border-color: var(--indigo-400);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        
        .dark .search-input::placeholder {
            color: #6b7280;
        }
        
        .dark .search-icon {
            color: #6b7280;
        }
        
        /* Hover effects for dark theme */
        .dark .search-input:hover {
            border-color: #4b5563;
        }
        
        .dark .search-input:focus:hover {
            border-color: var(--indigo-400);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: var(--card-bg-light);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-card-icon {
            padding: 0.75rem;
            border-radius: 50%;
        }
        
        .stat-card-icon svg {
            width: 1.5rem;
            height: 1.5rem;
        }
        
        .stat-card-info p:first-child {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
        }
        
        .dark .stat-card-info p:first-child {
            color: #9ca3af;
        }

        .stat-card-info p:last-child {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-light);
        }
        
        /* Color variations for stat cards */
        .icon-indigo { background-color: #e0e7ff; } .dark .icon-indigo { background-color: rgba(99, 102, 241, 0.2); }
        .icon-indigo svg { color: #4338ca; } .dark .icon-indigo svg { color: #a5b4fc; }
        .icon-green { background-color: #d1fae5; } .dark .icon-green { background-color: rgba(16, 185, 129, 0.2); }
        .icon-green svg { color: #059669; } .dark .icon-green svg { color: #6ee7b7; }
        .icon-yellow { background-color: #fef3c7; } .dark .icon-yellow { background-color: rgba(245, 158, 11, 0.2); }
        .icon-yellow svg { color: #d97706; } .dark .icon-yellow svg { color: #fcd34d; }
        .icon-red { background-color: #fee2e2; } .dark .icon-red { background-color: rgba(239, 68, 68, 0.2); }
        .icon-red svg { color: #dc2626; } .dark .icon-red svg { color: #fca5a5; }

        /* Recent Users Table */
        .users-table-container {
            background-color: var(--card-bg-light);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            padding: 1.5rem;
        }
        
        .users-table-container h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-light);
        }
        
        .table-wrapper {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }
        
        thead tr {
            border-bottom: 1px solid var(--border-light);
        }
        
        th {
            font-weight: 600;
            color: #4b5567;
        }
        .dark th {
            color: #d1d5db;
        }
        
        tbody tr {
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
            transition: background-color var(--transition-speed);
        }
        .dark tbody tr {
             border-bottom: 1px solid rgba(55, 65, 81, 0.5);
        }
        tbody tr:last-child {
            border-bottom: none;
        }
        
        tbody tr:hover {
            background-color: #f9fafb;
        }
        .dark tbody tr:hover {
            background-color: rgba(55, 65, 81, 0.5);
        }
        
        td {
            color: #374151;
        }
        .dark td {
            color: #9ca3af;
        }
        
        .user-cell {
            display: flex;
            align-items: center;
        }
        
        .user-cell img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.75rem;
        }
        
        .status-badge {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
        }
        
        .status-active { color: #14532d; background-color: #dcfce7; }
        .dark .status-active { color: #a7f3d0; background-color: rgba(22, 163, 74, 0.2); }
        .status-pending { color: #78350f; background-color: #fef3c7; }
        .dark .status-pending { color: #fcd34d; background-color: rgba(245, 158, 11, 0.2); }
        .status-inactive { color: #991b1b; background-color: #fee2e2; }
        .dark .status-inactive { color: #fca5a5; background-color: rgba(220, 38, 38, 0.2); }

        /* Slider Table Styles */
        .slider-table-container {
            background-color: var(--card-bg-light);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .slider-table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .slider-table-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-light);
        }
        
        .add-slider-btn {
            background-color: var(--indigo-600);
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
        }
        
        .add-slider-btn:hover {
            background-color: var(--indigo-400);
        }
        
        .slider-image {
            width: 60px;
            height: 40px;
            border-radius: 0.375rem;
            object-fit: cover;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-edit, .btn-delete {
            padding: 0.25rem 0.5rem;
            border: none;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-edit {
            background-color: #10b981;
            color: white;
        }
        
        .btn-edit:hover {
            background-color: #059669;
        }
        
        .btn-delete {
            background-color: #ef4444;
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #dc2626;
        }

        /* Responsive */
        @media (min-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        /* Mobile responsive for search bar */
        @media (max-width: 1023px) {
            .search-container {
                display: none; /* Hide search bar on mobile */
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
        
        /* Pagination Styles */
        .pagination-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .pagination-info {
            color: var(--text-secondary);
            font-size: 14px;
        }
        
        .pagination-links {
            display: flex;
            gap: 5px;
            align-items: center;
        }
        
        .pagination-link, .pagination-current {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
            transition: all 0.2s ease;
            display: inline-block;
            min-width: 40px;
            text-align: center;
        }
        
        .pagination-link {
            background: #ffffff;
            color: #374151;
            border-color: #d1d5db;
        }
        
        .pagination-link:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .pagination-current {
            background: #3b82f6;
            color: white;
            font-weight: 600;
            border-color: #3b82f6;
        }
        
        /* Dark theme pagination */
        .dark .pagination-link {
            background: #374151;
            color: #f9fafb;
            border-color: #4b5563;
        }
        
        .dark .pagination-link:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .dark .pagination-current {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .pagination-disabled {
            padding: 8px 12px;
            background: #f3f4f6;
            color: #9ca3af;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
            cursor: not-allowed;
        }
        
        .dark .pagination-disabled {
            background: #1f2937;
            color: #6b7280;
            border-color: #374151;
        }
        
        .pagination-ellipsis {
            padding: 8px 4px;
            color: #6b7280;
        }
        
        .dark .pagination-ellipsis {
            color: #9ca3af;
        }
        
        /* Responsive pagination */
        @media (max-width: 768px) {
            .pagination-container {
                flex-direction: column;
                text-align: center;
            }
            
            .pagination-links {
                flex-wrap: wrap;
                justify-content: center;
            }
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
                <a href="#" class="nav-link active">
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
                <div class="nav-item has-submenu">
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
                    <h2>All Products</h2>
                    
                    <!-- Search Bar -->
                    <div class="search-container">
                        <div class="search-input-wrapper">
                            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                            <input type="text" class="search-input" placeholder="Search products by name, code, brand or category..." id="searchInput">
                        </div>
                    </div>
                    
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
                    <!-- All Products Table -->
                <div class="slider-table-container">
                    <div class="slider-table-header">
                        <h3>Product Management</h3>
                        <a href="addProduct.php" class="add-slider-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Add New Product
                        </a>
                    </div>
                    
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Brand</th>
                                    <th>Main Category</th>
                                    <th>Sub Category 1</th>
                                    <th>Sub Category 2</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($products)): ?>
                                    <?php foreach ($products as $index => $product): ?>
                                        <tr>
                                            <td><?php echo $product['id']; ?></td>
                                            <td>
                                                <img src="../<?php echo htmlspecialchars($product['image']); ?>" 
                                                     alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                                     class="slider-image"
                                                     onerror="this.src='https://placehold.co/60x40/6366f1/ffffff?text=IMG'">
                                            </td>
                                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                                            <td><?php echo htmlspecialchars($product['code']); ?></td>
                                            <td><?php echo htmlspecialchars($product['slug']); ?></td>
                                            <td><?php echo htmlspecialchars(substr($product['description'] ?? '', 0, 50)) . (strlen($product['description'] ?? '') > 50 ? '...' : ''); ?></td>
                                            <td><?php echo htmlspecialchars($product['brand_name'] ?? 'No Brand'); ?></td>
                                            <td><?php echo htmlspecialchars($product['main_category_name'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($product['sub_cat_1_name'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($product['sub_cat_2_name'] ?? '-'); ?></td>
                                            <td>
                                                <span class="status-badge <?php echo ($product['active'] == 1) ? 'status-active' : 'status-inactive'; ?>">
                                                    <?php echo ($product['active'] == 1) ? 'Active' : 'Inactive'; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn-edit" onclick="editProduct(<?php echo $product['id']; ?>)">Edit</button>
                                                    <button class="btn-delete" onclick="deleteProduct(<?php echo $product['id']; ?>)">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="12" style="text-align: center; padding: 2rem; color: #6b7280;">
                                            No products found. <a href="addProduct.php" style="color: var(--indigo-600);">Add your first product</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination Section -->
                    <?php if ($total_pages > 1): ?>
                    <div class="pagination-container">
                        <!-- Pagination Info -->
                        <div class="pagination-info">
                            <?php 
                            $start_item = ($current_page - 1) * $items_per_page + 1;
                            $end_item = min($current_page * $items_per_page, $total_items);
                            ?>
                            Showing <?php echo $start_item; ?> to <?php echo $end_item; ?> of <?php echo $total_items; ?> products
                        </div>
                        
                        <!-- Pagination Links -->
                        <div class="pagination-links">
                            <!-- Previous Button -->
                            <?php if ($current_page > 1): ?>
                                <a href="?page=<?php echo ($current_page - 1); ?>" class="pagination-link">
                                    ← Previous
                                </a>
                            <?php else: ?>
                                <span class="pagination-disabled">
                                    ← Previous
                                </span>
                            <?php endif; ?>
                            
                            <!-- Page Numbers -->
                            <?php
                            // Calculate page range to show
                            $start_page = max(1, $current_page - 2);
                            $end_page = min($total_pages, $current_page + 2);
                            
                            // Show first page if not in range
                            if ($start_page > 1): ?>
                                <a href="?page=1" class="pagination-link">1</a>
                                <?php if ($start_page > 2): ?>
                                    <span class="pagination-ellipsis">...</span>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <!-- Page numbers in range -->
                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <?php if ($i == $current_page): ?>
                                    <span class="pagination-current">
                                        <?php echo $i; ?>
                                    </span>
                                <?php else: ?>
                                    <a href="?page=<?php echo $i; ?>" class="pagination-link">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endfor; ?>
                            
                            <!-- Show last page if not in range -->
                            <?php if ($end_page < $total_pages): ?>
                                <?php if ($end_page < $total_pages - 1): ?>
                                    <span class="pagination-ellipsis">...</span>
                                <?php endif; ?>
                                <a href="?page=<?php echo $total_pages; ?>" class="pagination-link"><?php echo $total_pages; ?></a>
                            <?php endif; ?>
                            
                            <!-- Next Button -->
                            <?php if ($current_page < $total_pages): ?>
                                <a href="?page=<?php echo ($current_page + 1); ?>" class="pagination-link">
                                    Next →
                                </a>
                            <?php else: ?>
                                <span class="pagination-disabled">
                                    Next →
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
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
            
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const tableRows = document.querySelectorAll('.slider-table-container tbody tr');
                    
                    tableRows.forEach(row => {
                        const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                        const name = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                        const code = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                        const slug = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                        const description = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
                        const brand = row.querySelector('td:nth-child(7)').textContent.toLowerCase();
                        const mainCategory = row.querySelector('td:nth-child(8)').textContent.toLowerCase();
                        const subCat1 = row.querySelector('td:nth-child(9)').textContent.toLowerCase();
                        const subCat2 = row.querySelector('td:nth-child(10)').textContent.toLowerCase();
                        const status = row.querySelector('td:nth-child(11)').textContent.toLowerCase();
                        
                        if (id.includes(searchTerm) || 
                            name.includes(searchTerm) || 
                            code.includes(searchTerm) || 
                            slug.includes(searchTerm) || 
                            description.includes(searchTerm) || 
                            brand.includes(searchTerm) || 
                            mainCategory.includes(searchTerm) || 
                            subCat1.includes(searchTerm) || 
                            subCat2.includes(searchTerm) || 
                            status.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
                
                // Add keyboard shortcut (Ctrl/Cmd + K) to focus search
                document.addEventListener('keydown', function(e) {
                    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                        e.preventDefault();
                        searchInput.focus();
                    }
                });
            }

            // Edit product function
            window.editProduct = function(productId) {
                // Redirect to edit page with product ID
                window.location.href = 'editProduct.php?id=' + productId;
            };

            // Delete product function
            window.deleteProduct = function(productId) {
                if (confirm('Are you sure you want to delete this product?')) {
                    // Create form and submit for deletion
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'allProduct.php';
                    
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'delete_product';
                    input.value = productId;
                    
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            };

        });
    </script>
</body>
</html>
