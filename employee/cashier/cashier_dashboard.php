<?php
session_start();

// Check if the employee is logged in and is a cashier
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['employee_role'] !== 'cashier') {
    header('Location: ../employee_login.php');
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <?php include 'includes/side_navigator.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Cashier Dashboard</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['employee_username']); ?>!</p>
        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p>25</p> <!-- Replace with actual data -->
            </div>
            <div class="stat-card">
                <h3>Pending Orders</h3>
                <p>10</p> <!-- Replace with actual data -->
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>