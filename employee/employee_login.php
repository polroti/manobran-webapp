<?php
session_start();

// Include the database connection
require_once '../db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch employee credentials from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND user_type IN ('CASHIER', 'TAILOR')");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employee && password_verify($password, $employee['password'])) {
        // Set session variables
        $_SESSION['employee_id'] = $employee['id'];
        $_SESSION['employee_username'] = $employee['username'];
        $_SESSION['employee_role'] = $employee['user_type'];
        $_SESSION['logged_in'] = true;

        // Redirect to the appropriate dashboard based on role
        if ($employee['user_type'] === 'CASHIER') {
            header('Location: cashier/cashier_dashboard.php');
        } else {
            header('Location: tailor/tailor_dashboard.php');
        }
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login - Manobran Tailors</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="centered">
        <div class="login-container">
            <h2>Employee Login</h2>
            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form method="POST" action="employee_login.php">
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
</body>
</html>