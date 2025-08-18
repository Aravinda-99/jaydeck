<?php
session_start();
require_once '../connection.php';

// Initialize variables
$error_message = '';
$success_message = '';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to admin panel
    exit();
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Basic validation
    if (empty($email) || empty($password)) {
        $error_message = "Please enter both email and password.";
    } else {
        // Check user credentials
        $stmt = mysqli_prepare($link, "SELECT id, name, email, password FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($user = mysqli_fetch_assoc($result)) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                
                // Update remember token if needed
                $remember_token = bin2hex(random_bytes(32));
                $update_stmt = mysqli_prepare($link, "UPDATE users SET remember_token = ? WHERE id = ?");
                mysqli_stmt_bind_param($update_stmt, "si", $remember_token, $user['id']);
                mysqli_stmt_execute($update_stmt);
                
                header("Location: index.php"); // Redirect to admin panel
                exit();
            } else {
                $error_message = "Invalid email or password.";
            }
        } else {
            $error_message = "Invalid email or password.";
        }
        mysqli_stmt_close($stmt);
    }
}

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        $error_message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } else {
        // Check if email already exists
        $check_stmt = mysqli_prepare($link, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        $check_result = mysqli_stmt_get_result($check_stmt);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error_message = "Email already exists. Please use a different email.";
        } else {
            // Hash password and insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $remember_token = bin2hex(random_bytes(32));
            
            $insert_stmt = mysqli_prepare($link, "INSERT INTO users (name, email, password, remember_token) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert_stmt, "ssss", $name, $email, $hashed_password, $remember_token);
            
            if (mysqli_stmt_execute($insert_stmt)) {
                $success_message = "Registration successful! You can now login.";
            } else {
                $error_message = "Registration failed. Please try again.";
            }
            mysqli_stmt_close($insert_stmt);
        }
        mysqli_stmt_close($check_stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS compiled from the provided SCSS */
        :root {
            --white: #fff;
            --black: #333;
            --main-color: #2980b9;
            --sec-color: #3498db;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            position: relative;
            background: var(--white);
            box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.25);
            border-radius: 5px;
            width: 800px;
            max-width: 100%;
            min-height: 480px;
            overflow: hidden;
        }

        .animateWidth {
            animation: animateWidth 0.8s linear forwards;
        }

        @keyframes animateWidth {
            0% {
                width: 35%;
            }
            20% {
                width: 50%;
            }
            100% {
                width: 35%;
            }
        }

        .form__container {
            position: absolute;
            top: 0;
            z-index: -1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 65%;
            height: 100%;
            padding: 25px;
            text-align: center;
            background: var(--white);
            transition: all 0.6s ease-in-out;
        }

        .container.go-login .form__container-login {
            left: 35%;
            opacity: 0;
            z-index: -1;
        }
        .container.go-register .form__container-login {
            left: 0;
            opacity: 1;
            z-index: 5;
        }

        .container.go-login .form__container-register {
            left: 35%;
            opacity: 1;
            z-index: 5;
        }
        .container.go-register .form__container-register {
            left: 0;
            opacity: 0;
            z-index: -1;
        }

        .form {
            width: 100%;
        }

        .form__heading {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .form__field {
            width: 100%;
            height: 40px;
            line-height: 40px;
            padding-left: 15px;
            margin-bottom: 15px;
            background: #f4f8f7;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form__field:last-child {
            margin-bottom: 0;
        }

        .form__field::-webkit-input-placeholder {
            text-transform: capitalize;
        }
        .form__field::-moz-placeholder {
            text-transform: capitalize;
        }
        .form__field:-ms-input-placeholder {
            text-transform: capitalize;
        }
        .form__field:-moz-placeholder {
            text-transform: capitalize;
        }

        .form__field:focus,
        .form__field:active {
            outline: 0;
        }

        .form__text {
            margin-bottom: 15px;
            font-size: 14px;
        }

        .list {
            padding-left: 0;
            list-style: none;
        }

        .list__inline {
            margin-bottom: 15px;
        }

        .list__inline .list__item {
            display: inline-block;
            margin-left: 5px;
            margin-right: 5px;
            border: 1px solid var(--black);
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .list__inline .list__link {
            color: var(--black);
            text-decoration: none;
        }

        .list__inline .list__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            font-size: 16px;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 35%;
            text-align: center;
            background: linear-gradient(45deg, var(--main-color), var(--sec-color));
            transition: all 0.8s cubic-bezier(0.67, 0.67, 0.34, 0.95);
            z-index: 10;
        }

        .container.go-login .overlay-container {
            right: 65%;
        }
        .container.go-register .overlay-container {
            right: 0;
        }

        .overlay {
            padding: 25px;
            color: var(--white);
            position: absolute;
            width: 100%;
            transition: all 0.6s ease-in-out;
        }

        .overlay__heading {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .overlay__desc {
            max-width: 230px;
            width: 100%;
            margin: auto;
            margin-bottom: 15px;
        }

        .overlay--left {
            opacity: 0;
        }
        .container.go-login .overlay--left {
            opacity: 1;
        }
        .container.go-register .overlay--left {
            opacity: 0;
        }

        .overlay--right {
            opacity: 0;
        }
        .container.go-login .overlay--right {
            opacity: 0;
        }
        .container.go-register .overlay--right {
            opacity: 1;
        }

        .btn {
            padding: 12px 35px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            transition: transform 80ms ease-in;
        }
        .btn:active {
            transform: scale(0.95);
        }

        .btn--main {
            background: linear-gradient(45deg, var(--main-color), var(--sec-color));
            color: var(--white);
        }

        .btn--main-outline {
            background-color: transparent;
            border: 2px solid var(--white);
            color: var(--white);
        }

        .btn:focus,
        .btn:active {
            outline: 0;
        }

    </style>
</head>
<body>
    <div class="container go-register">
        <div class="form__container form__container-login">
            <form action="" method="POST" class="form">
                <h3 class="form__heading"> Sign In</h3>
                
                <?php if (!empty($error_message)): ?>
                    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($success_message)): ?>
                    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>
                
                <p class="form__text">Enter your credentials to access the admin panel</p>
                <input type="email" name="email" placeholder="Email" class="form__field" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <input type="password" name="password" placeholder="Password" class="form__field" required>
                <button type="submit" name="login" class="btn btn--main">Sign In</button>
            </form>
        </div>
        <div class="form__container form__container-register">
            <form action="" method="POST" class="form">
                <h3 class="form__heading"> Create Account</h3>
                
                <?php if (!empty($error_message) && isset($_POST['register'])): ?>
                    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($success_message)): ?>
                    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>
                
                <p class="form__text">Create your admin account</p>
                <input type="text" name="name" placeholder="Full Name" class="form__field" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                <input type="email" name="email" placeholder="Email" class="form__field" required value="<?php echo isset($_POST['email']) && !isset($_POST['login']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <input type="password" name="password" placeholder="Password (min 6 chars)" class="form__field" required>
                <button type="submit" name="register" class="btn btn--main">Sign Up</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay overlay--right">
                <h3 class="overlay__heading">Welcome to Admin Panel</h3>
                <p class="overlay__desc">Enter your personal details to access the admin panel</p>
                <!-- <button type="button" id="go-register" class="btn btn--main-outline">Sign Up</button> -->
            </div>
            <div class="overlay overlay--left">
                <h3 class="overlay__heading">Welcome Back!</h3>
                <p class="overlay__desc">To keep connected with us please login with your personal info</p>
                <button type="button" id="go-login" class="btn btn--main-outline">Sign In</button>
            </div>
            </div>
        </div>

    <script>
        (function (document) {
            // Cache DOM
            const goLoginBtn = document.querySelector('#go-login');
            const goRegisterBtn = document.querySelector('#go-register');
            const container = document.querySelector('.container');
            const overlayContainer = document.querySelector('.overlay-container');
        
            const toggleForm = () => {
                // Clear animation class on transition end to allow re-triggering
                const onTransitionEnd = () => {
                    overlayContainer.classList.remove('animateWidth');
                    overlayContainer.removeEventListener('transitionend', onTransitionEnd);
                };
                
                overlayContainer.addEventListener('transitionend', onTransitionEnd);

                if (container.classList.contains('go-register')) {
                    container.classList.remove('go-register');
                    container.classList.add('go-login');
                } else {
                    container.classList.remove('go-login');
                    container.classList.add('go-register');
                }
                overlayContainer.classList.add('animateWidth');
            };
        
            goLoginBtn.addEventListener('click', toggleForm);
            goRegisterBtn.addEventListener('click', toggleForm);
        })(document);
    </script>
</body>
</html>