<?php
session_start();

// Check if the employee is logged in and is a tailor
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['employee_role'] !== 'tailor') {
    header('Location: employee_login.php');
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <?php include 'includes/side_navigator.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Tailor Dashboard</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['employee_username']); ?>!</p>
        <div class="stats-container">
            <div class="stat-card">
                <h3>Assigned Orders</h3>
                <p>15</p> <!-- Replace with actual data -->
            </div>
            <div class="stat-card">
                <h3>Completed Orders</h3>
                <p>5</p> <!-- Replace with actual data -->
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>