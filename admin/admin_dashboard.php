<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Include the database connection
require_once '../db_connect.php';
// Fetch statistics
$total_users = 0; // Replace with actual query
$logged_in_users = 0; // Replace with actual query
$logged_in_admins = 0;

// Fetch total number of users
$stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users");
$stmt->execute();
$total_users = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

// Fetch number of currently logged-in users (assuming you have a `last_login` field)
$stmt = $conn->prepare("SELECT COUNT(*) as logged_in_users FROM users WHERE last_login >= NOW() - INTERVAL 30 SECOND");
$stmt->execute();
$logged_in_users = $stmt->fetch(PDO::FETCH_ASSOC)['logged_in_users'];

// Fetch total number of admins
$stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM admins");
$stmt->execute();
$logged_in_admins = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-container">
<?php include 'side_navigator.php'; ?>


    <!-- Main Content -->
    <div class="main-content">
        <h2>Dashboard</h2>
        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
            <div class="stat-card">
                <h3>Logged In Users</h3>
                <p><?php echo $logged_in_users; ?></p>
            </div>

            <div class="stat-card">
                <h3>Total Admins</h3>
                <p><?php echo $logged_in_admins; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>