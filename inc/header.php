<?php
// Start session
session_start();

// Database connection settings
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'booking_db';

// Create connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if database exists, if not create it
$check_db = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'");
if (mysqli_num_rows($check_db) == 0) {
    $create_db = "CREATE DATABASE IF NOT EXISTS $db_name";
    if (mysqli_query($conn, $create_db)) {
        mysqli_select_db($conn, $db_name);
        $create_table = "CREATE TABLE IF NOT EXISTS users (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('admin', 'user') DEFAULT 'user',
            verified TINYINT(1) NOT NULL DEFAULT 0,
            verification_code VARCHAR(6) DEFAULT NULL,
            code_expires_at DATETIME DEFAULT NULL,
            created_at DATETIME NOT NULL,
            last_login DATETIME DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        if (mysqli_query($conn, $create_table)) {
            $admin_password = password_hash('admin123', PASSWORD_DEFAULT);
            $insert_admin = "INSERT INTO users (name, email, password, role, verified, created_at) VALUES 
                ('Admin User', 'admin@example.com', '$admin_password', 'admin', 1, NOW())";
            mysqli_query($conn, $insert_admin);
        }
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Process login
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error_message = "Email and password are required";
    } else {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                $update_query = "UPDATE users SET last_login = NOW() WHERE id = " . $user['id'];
                mysqli_query($conn, $update_query);

                // Redirect to dashboard.php with appropriate view
                header("Location: dashboard.php" . ($user['role'] == 'admin' ? "?view=admin" : ""));
                exit;
            } else {
                $error_message = "Invalid password";
            }
        } else {
            $error_message = "Email not found";
        }
    }
}

// Process signup
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long";
    } else {
        $check_query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result) > 0) {
            $error_message = "Email already exists";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $verification_code = sprintf("%06d", mt_rand(100000, 999999));
            $expires = date('Y-m-d H:i:s', strtotime('+24 hours'));

            $insert_query = "INSERT INTO users (name, email, password, verification_code, code_expires_at, created_at) 
                           VALUES ('$name', '$email', '$hashed_password', '$verification_code', '$expires', NOW())";

            if (mysqli_query($conn, $insert_query)) {
                $_SESSION['temp_email'] = $email;
                $_SESSION['temp_name'] = $name;
                $_SESSION['verification_needed'] = true;
                $simulate_email_message = "A verification code has been sent to $email";
                $show_verification = true;
            } else {
                $error_message = "Registration failed: " . mysqli_error($conn);
            }
        }
    }
}

// Process verification
if (isset($_POST['verify'])) {
    $verification_code = $_POST['verification_code'];
    $email = isset($_SESSION['temp_email']) ? $_SESSION['temp_email'] : "";

    if (empty($verification_code) || empty($email)) {
        $error_message = "Verification code and email are required";
    } elseif (!preg_match('/^\d{6}$/', $verification_code)) {
        $error_message = "Verification code must be exactly 6 digits";
        $show_verification = true;
    } else {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $update_query = "UPDATE users SET verified = 1, verification_code = NULL WHERE id = " . $user['id'];

            if (mysqli_query($conn, $update_query)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                unset($_SESSION['temp_email']);
                unset($_SESSION['temp_name']);
                unset($_SESSION['verification_needed']);

                $success_message = "Email verification successful!";
                $redirect_after_success = true;
            } else {
                $error_message = "Verification failed: " . mysqli_error($conn);
                $show_verification = true;
            }
        } else {
            $error_message = "Email not found";
            $show_verification = true;
        }
    }
}

// Resend verification code
if (isset($_POST['resend'])) {
    $email = isset($_SESSION['temp_email']) ? $_SESSION['temp_email'] : "";
    if (!empty($email)) {
        $verification_code = sprintf("%06d", mt_rand(100000, 999999));
        $expires = date('Y-m-d H:i:s', strtotime('+24 hours'));

        $update_query = "UPDATE users SET verification_code = '$verification_code', code_expires_at = '$expires' WHERE email = '$email'";
        if (mysqli_query($conn, $update_query)) {
            $success_message = "A new verification code has been sent";
            $show_verification = true;
        } else {
            $error_message = "Failed to resend verification code";
            $show_verification = true;
        }
    } else {
        $error_message = "Email address not found";
    }
}

$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$show_verification = isset($show_verification) ? $show_verification :
    (isset($_SESSION['verification_needed']) && $_SESSION['verification_needed'] === true);
$view = isset($_GET['view']) ? $_GET['view'] : ($is_logged_in ? 'dashboard' : 'login');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($is_logged_in ? 'Account' : 'Login') . ' - Booking.com'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --booking-blue: #003580;
            --booking-light-blue: #006ce4;
            --booking-yellow: #f5a623;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #f2f6f8;
            color: #333;
            line-height: 1.5;
        }

        .navbar {
            background-color: white !important;
        }

        .navbar-brand {
            font-size: 1.5rem !important;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            border-radius: 8px;
            overflow: hidden;
        }

        .modal-header {
            background-color: #2c2c2c;
            color: white;
            border-bottom: none;
        }

        .modal-title {
            font-weight: bold;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }

        @media (min-width: 576px) {
            .modal-dialog-centered {
                min-height: calc(100% - 3.5rem);
            }
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 12px 16px;
            font-size: 16px;
            border: 1px solid #e7e7e7;
            border-radius: 4px;
        }

        .btn-dark {
            background-color: #2c2c2c;
            border-color: var(--booking-light-blue);
        }

        .btn-dark:hover {
            background-color: #0053a8;
            border-color: #0053a8;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 16px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .container {
            width: 100%;


            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .main {
            min-height: calc(100vh - 140px);
            padding: 32px 16px;
        }

        .auth-container {
            background-color: white;
            width: 100%;
            max-width: 450px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .footer {
            background-color: #f5f5f5;
            padding: 16px 0;
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 32px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Booking.com</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="Rooms.php">Room</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="Facilities.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="contactUs.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="Ocassion.php">Occasion Booking</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php if ($is_logged_in): ?>
                        <div class="user-name me-3 align-self-center">Welcome,
                            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                        </div>
                        <?php if ($_SESSION['user_role'] == 'admin'): ?>
                            <a href="dashboard.php?view=admin" class="btn btn-outline-dark shadow-none me-lg-3 me-2">Admin Panel</a>
                        <?php endif; ?>
                        <a href="?logout=true" class="btn btn-outline-dark shadow-none me-lg-3 me-2">Logout</a>
                    <?php else: ?>
                        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Login</button>
                        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Register</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h1 class="modal-title fs-3 d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"
                            style="filter: invert(1);"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($error_message) && isset($_POST['login'])): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control shadow-none" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <button type="submit" name="login" class="btn btn-dark shadow-none">Login</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot
                                Password</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h1 class="modal-title fs-3 d-flex align-items-center">
                            <i class="bi bi-person-lines-fill"></i> User Registration
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"
                            style="filter: invert(1);"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($error_message) && isset($_POST['signup'])): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <?php if (isset($simulate_email_message)): ?>
                            <div class="alert alert-success"><?php echo $simulate_email_message; ?></div>
                        <?php endif; ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control shadow-none"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" name="signup" class="btn btn-dark shadow-none">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Verification Modal -->
    <?php if ($show_verification): ?>
        <div class="modal fade show d-block" id="verificationModal" aria-hidden="true"
            style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(5px);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" action="">
                        <div class="modal-header">
                            <h1 class="modal-title fs-3">Email Verification</h1>
                            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"
                                style="filter: invert(1);"></button>
                        </div>
                        <div class="modal-body">
                            <?php if (isset($error_message) && isset($_POST['verify'])): ?>
                                <div class="alert alert-danger"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            <?php if (isset($success_message) && isset($_POST['resend'])): ?>
                                <div class="alert alert-success"><?php echo $success_message; ?></div>
                            <?php endif; ?>
                            <div class="text-center mb-3">
                                <p>We've sent a 6-digit verification code to</p>
                                <p style="font-weight: 500; color: var(--booking-light-blue);">
                                    <?php echo htmlspecialchars($_SESSION['temp_email']); ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Verification Code</label>
                                <input type="text" name="verification_code" class="form-control shadow-none" maxlength="6"
                                    placeholder="------" required
                                    style="text-align: center; letter-spacing: 2px; font-size: 20px;">
                            </div>
                            <button type="submit" name="verify" class="btn btn-dark shadow-none w-100 mb-2">Verify
                                Email</button>
                            <button type="submit" name="resend" class="btn btn-outline-dark shadow-none w-100">Resend
                                Code</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if (isset($redirect_after_success)): ?>
            setTimeout(function () {
                window.location.href = "dashboard.php";
            }, 2000);
        <?php endif; ?>

        document.querySelectorAll('.modal .btn-close').forEach(button => {
            button.addEventListener('click', function () {
                const modal = this.closest('.modal');
                modal.classList.remove('show');
                modal.style.display = 'none';
                document.querySelector('.modal-backdrop')?.remove();
                document.body.classList.remove('modal-open');
            });
        });

        document.querySelectorAll('a[href="javascript: void(0)"]').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                alert("Password reset functionality would be implemented here.");
            });
        });

        // Keep modals open on form submission errors
        <?php if (isset($error_message) && (isset($_POST['login']) || isset($_POST['signup']))): ?>
            document.addEventListener('DOMContentLoaded', function () {
                const modalId = <?php echo isset($_POST['login']) ? "'#loginModal'" : "'#registerModal'"; ?>;
                const modal = new bootstrap.Modal(document.querySelector(modalId));
                modal.show();
            });
        <?php endif; ?>
    </script>
</body>

</html>