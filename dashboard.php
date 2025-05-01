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

// Check if user is logged in
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
if (!$is_logged_in) {
    header("Location: index.php");
    exit;
}

// Process user update
if (isset($_POST['update_user'])) {
    $user_id = intval($_POST['user_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (empty($name) || empty($email)) {
        $error_message = "Name and email are required";
    } else {
        $check_email_query = "SELECT * FROM users WHERE email = '$email' AND id != $user_id";
        $check_result = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($check_result) > 0) {
            $error_message = "Email already exists";
        } else {
            $update_query = "UPDATE users SET name = '$name', email = '$email' WHERE id = $user_id";
            if (mysqli_query($conn, $update_query)) {
                $success_message = "User updated successfully";
                if ($user_id == $_SESSION['user_id']) {
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_email'] = $email;
                }
            } else {
                $error_message = "Failed to update user: " . mysqli_error($conn);
            }
        }
    }
}

// Process user delete
if (isset($_GET['delete_user'])) {
    $user_id = intval($_GET['delete_user']);
    if ($user_id != $_SESSION['user_id']) {
        $delete_query = "DELETE FROM users WHERE id = $user_id";
        if (mysqli_query($conn, $delete_query)) {
            $success_message = "User deleted successfully";
        } else {
            $error_message = "Failed to delete user: " . mysqli_error($conn);
        }
    } else {
        $error_message = "You cannot delete your own account";
    }
}

// Admin logic
if (isset($_GET['view']) && $_GET['view'] == 'admin' && $_SESSION['user_role'] == 'admin') {
    $users_query = "SELECT COUNT(*) as total FROM users";
    $users_result = mysqli_query($conn, $users_query);
    $users_count = mysqli_fetch_assoc($users_result)['total'];

    $verified_query = "SELECT COUNT(*) as verified FROM users WHERE verified = 1";
    $verified_result = mysqli_query($conn, $verified_query);
    $verified_count = mysqli_fetch_assoc($verified_result)['verified'];

    $admin_query = "SELECT COUNT(*) as admin FROM users WHERE role = 'admin'";
    $admin_result = mysqli_query($conn, $admin_query);
    $admin_count = mysqli_fetch_assoc($admin_result)['admin'];

    $admin_view = isset($_GET['admin_view']) ? $_GET['admin_view'] : 'dashboard';

    if (isset($_GET['verify_user'])) {
        $user_id = intval($_GET['verify_user']);
        $verify_query = "UPDATE users SET verified = 1 WHERE id = $user_id";
        if (mysqli_query($conn, $verify_query)) {
            $success_message = "User verified successfully";
        } else {
            $error_message = "Failed to verify user: " . mysqli_error($conn);
        }
    }
}

$view = isset($_GET['view']) ? $_GET['view'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($view == 'admin' ? 'Admin Dashboard' : 'User Dashboard') . ' - Booking.com'; ?></title>
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
            display Wflex;
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

        .dashboard-header {
            background-color: white;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title {
            color: var(--booking-blue);
            margin-bottom: 16px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: var(--booking-light-blue);
            margin-bottom: 8px;
        }

        .stat-card .label {
            color: #666;
            font-size: 14px;
        }

        .content-card {
            background-color: white;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .tab-container {
            display: flex;
            border-bottom: 1px solid #e7e7e7;
            margin-bottom: 24px;
        }

        .tab {
            padding: 12px 24px;
            cursor: pointer;
            font-weight: 500;
            color: #666;
        }

        .tab.active {
            color: var(--booking-light-blue);
            border-bottom: 2px solid var(--booking-light-blue);
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 12px 16px;
            border-bottom: 2px solid #e7e7e7;
            font-weight: 500;
        }

        .data-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e7e7e7;
        }

        .data-table tr:hover {
            background-color: #f9f9f9;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background-color: var(--success);
            color: white;
        }

        .badge-warning {
            background-color: var(--warning);
            color: #212529;
        }

        .badge-danger {
            background-color: var(--danger);
            color: white;
        }

        .badge-info {
            background-color: var(--info);
            color: white;
        }

        .action-btn {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            text-decoration: none;
            margin-right: 4px;
        }

        .action-btn-verify {
            background-color: var(--success);
            color: white;
        }

        .action-btn-delete {
            background-color: var(--danger);
            color: white;
        }

        .action-btn-edit {
            background-color: var(--info);
            color: white;
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
                    <div class="user-name me-3 align-self-center">Welcome,
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </div>
                    <?php if ($_SESSION['user_role'] == 'admin'): ?>
                        <a href="?view=admin" class="btn btn-outline-dark shadow-none me-lg-3 me
                        me-2">Admin Panel</a>
                    <?php endif; ?>
                    <a href="index.php?logout=true" class="btn btn-outline-dark shadow-none me-lg-3 me-2">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h1 class="modal-title fs-3">Edit User</h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"
                            style="filter: invert(1);"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($error_message) && isset($_POST['update_user'])): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <input type="hidden" name="user_id" id="edit_user_id">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" id="edit_email" class="form-control shadow-none" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="update_user" class="btn btn-dark shadow-none">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <main class="main">
        <?php if ($view == 'admin' && $_SESSION['user_role'] == 'admin'): ?>
            <!-- Admin Dashboard -->
            <div class="container">
                <div class="dashboard-header">
                    <h1 class="dashboard-title">Admin Dashboard</h1>
                    <p class="dashboard-subtitle">Manage your website data</p>
                </div>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="number"><?php echo $users_count; ?></div>
                        <div class="label">Total Users</div>
                    </div>
                    <div class="stat-card">
                        <div class="number"><?php echo $verified_count; ?></div>
                        <div class="label">Verified Users</div>
                    </div>
                    <div class="stat-card">
                        <div class="number"><?php echo $admin_count; ?></div>
                        <div class="label">Admin Users</div>
                    </div>
                    <div class="stat-card">
                        <div class="number">0</div>
                        <div class="label">Total Bookings</div>
                    </div>
                </div>
                <div class="content-card">
                    <div class="tab-container">
                        <div class="tab <?php echo $admin_view == 'dashboard' ? 'active' : ''; ?>"
                            onclick="window.location='?view=admin&admin_view=dashboard'">Dashboard</div>
                        <div class="tab <?php echo $admin_view == 'users' ? 'active' : ''; ?>"
                            onclick="window.location='?view=admin&admin_view=users'">Users</div>
                    </div>
                    <?php if ($admin_view == 'users'): ?>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users_query = "SELECT * FROM users ORDER BY id DESC";
                                    $users_result = mysqli_query($conn, $users_query);
                                    if (mysqli_num_rows($users_result) > 0) {
                                        while ($user = mysqli_fetch_assoc($users_result)) {
                                            echo "<tr>";
                                            echo "<td>" . $user['id'] . "</td>";
                                            echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                                            echo "<td>" . ($user['role'] == 'admin' ? "<span class='badge badge-info'>Admin</span>" : "<span class='badge badge-warning'>User</span>") . "</td>";
                                            echo "<td>" . ($user['verified'] ? "<span class='badge badge-success'>Verified</span>" : "<span class='badge badge-danger'>Not Verified</span>") . "</td>";
                                            echo "<td>" . $user['created_at'] . "</td>";
                                            echo "<td>" . ($user['last_login'] ? $user['last_login'] : "Never") . "</td>";
                                            echo "<td>";
                                            if (!$user['verified']) {
                                                echo "<a href='?view=admin&admin_view=users&verify_user=" . $user['id'] . "' class='action-btn action-btn-verify'>Verify</a>";
                                            }
                                            if ($user['id'] != $_SESSION['user_id']) {
                                                echo "<a href='?view=admin&admin_view=users&delete_user=" . $user['id'] . "' class='action-btn action-btn-delete' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' style='text-align: center;'>No users found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div>
                            <h2>Welcome to your Admin Portal!</h2>
                            <p>This is where you can manage your website data, users, and settings.</p>
                            <div style="margin-top: 30px;">
                                <h3>Quick Links</h3>
                                <ul style="margin-top: 10px; margin-left: 20px;">
                                    <li><a href="?view=admin&admin_view=users">Manage Users</a></li>
                                    <li><a href="testoo.php">Return to Main Site</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- User Dashboard -->
            <div class="container">
                <div class="dashboard-header">
                    <h1 class="dashboard-title">User Dashboard</h1>
                    <p class="dashboard-subtitle">Manage your account and bookings</p>
                </div>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if (!isset($_GET['user_view'])): ?>
                    <div class="stats-container">
                        <div class="stat-card" onclick="window.location='?view=dashboard&user_view=users'">
                            <div class="number">Users</div>
                            <div class="label">View all users information</div>
                        </div>
                        <div class="stat-card">
                            <div class="number">0</div>
                            <div class="label">Total Bookings</div>
                        </div>
                        <div class="stat-card">
                            <div class="number">0</div>
                            <div class="label">Pending Requests</div>
                        </div>
                        <div class="stat-card">
                            <div class="number">$0.00</div>
                            <div class="label">Total Spent</div>
                        </div>
                    </div>
                <?php elseif ($_GET['user_view'] == 'users'): ?>
                    <div class="content-card">
                        <div class="tab-container">
                            <div class="tab" onclick="window.location='?view=dashboard'">Dashboard</div>
                            <div class="tab active">All Users</div>
                        </div>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users_query = "SELECT * FROM users ORDER BY id DESC";
                                    $users_result = mysqli_query($conn, $users_query);
                                    if (mysqli_num_rows($users_result) > 0) {
                                        while ($user = mysqli_fetch_assoc($users_result)) {
                                            echo "<tr>";
                                            echo "<td>" . $user['id'] . "</td>";
                                            echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                                            echo "<td>" . ($user['role'] == 'admin' ? "<span class='badge badge-info'>Admin</span>" : "<span class='badge badge-warning'>User</span>") . "</td>";
                                            echo "<td>" . ($user['verified'] ? "<span class='badge badge-success'>Verified</span>" : "<span class='badge badge-danger'>Not Verified</span>") . "</td>";
                                            echo "<td>" . $user['created_at'] . "</td>";
                                            echo "<td>" . ($user['last_login'] ? $user['last_login'] : "Never") . "</td>";
                                            echo "<td>";
                                            echo "<a href='#' class='action-btn action-btn-edit' data-bs-toggle='modal' data-bs-target='#editUserModal' data-id='" . $user['id'] . "' data-name='" . htmlspecialchars($user['name']) . "' data-email='" . htmlspecialchars($user['email']) . "'>Edit</a>";
                                            if ($user['id'] != $_SESSION['user_id']) {
                                                echo "<a href='?view=dashboard&user_view=users&delete_user=" . $user['id'] . "' class='action-btn action-btn-delete' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' style='text-align: center;'>No users found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Booking.com. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle edit button click
        document.querySelectorAll('.action-btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const userEmail = this.getAttribute('data-email');

                document.getElementById('edit_user_id').value = userId;
                document.getElementById('edit_name').value = userName;
                document.getElementById('edit_email').value = userEmail;
            });
        });

        // Keep modals open on form submission errors
        <?php if (isset($error_message) && isset($_POST['update_user'])): ?>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = new bootstrap.Modal(document.querySelector('#editUserModal'));
                modal.show();
            });
        <?php endif; ?>
    </script>
</body>

</html>


testoo.php