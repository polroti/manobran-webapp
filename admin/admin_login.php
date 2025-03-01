<?php
session_start();

// Include the database connection
require_once '../db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];

    // Fetch admin credentials from the database
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username");
    $stmt->bindParam(':username', $admin_username);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($admin_password, $admin['password'])) {
        // Set session variables
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_firstname'] = $admin['firstname'];
        $_SESSION['admin_lastname'] = $admin['lastname'];
        $_SESSION['logged_in'] = true;

        // Update last login timestamp
        $update_stmt = $conn->prepare("UPDATE admins SET last_login = CURRENT_TIMESTAMP WHERE id = :id");
        $update_stmt->bindParam(':id', $admin['id']);
        $update_stmt->execute();

        // Redirect to admin dashboard
        header('Location: admin_dashboard.php');
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="centered">
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST" action="admin_login.php">
            <div class="mui-textfield">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mui-textfield">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="mui-btn mui-btn--primary">Login</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>