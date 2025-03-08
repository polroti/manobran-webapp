<?php
session_start();

// Check if the employee is logged in and is a tailor
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['employee_role'] !== 'TAILOR') {
    header('Location: employee_login.php');
    exit();
}

// Include the database connection
require_once '../../db_connect.php';

// Fetch assigned orders for the current tailor
$assigned_orders_stmt = $conn->prepare("SELECT COUNT(*) as assigned_orders FROM orders WHERE assigned_to = :username");
$assigned_orders_stmt->bindParam(':username', $_SESSION['employee_username']);
$assigned_orders_stmt->execute();
$assigned_orders = $assigned_orders_stmt->fetch(PDO::FETCH_ASSOC)['assigned_orders'];

// Fetch completed orders for the current tailor within this month
$current_month_start = date('Y-m-01'); // First day of the current month
$current_month_end = date('Y-m-t'); // Last day of the current month

$completed_orders_stmt = $conn->prepare("
    SELECT COUNT(*) as completed_orders 
    FROM orders 
    WHERE assigned_to = :username 
      AND status = 'completed' 
      AND created_date BETWEEN :start_date AND :end_date
");
$completed_orders_stmt->bindParam(':username', $_SESSION['employee_username']);
$completed_orders_stmt->bindParam(':start_date', $current_month_start);
$completed_orders_stmt->bindParam(':end_date', $current_month_end);
$completed_orders_stmt->execute();
$completed_orders = $completed_orders_stmt->fetch(PDO::FETCH_ASSOC)['completed_orders'];
?>

<?php include 'emp_header.php'; ?>

<div class="dashboard-container">
    <?php include 'emp_side_navigator.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Tailor Dashboard</h2>
        
        <div class="stats-container">
            <div class="stat-card">
                <h3>Assigned Orders</h3>
                <p><?php echo htmlspecialchars($assigned_orders); ?></p>
            </div>
            <div class="stat-card">
                <h3>Completed Orders (This Month)</h3>
                <p><?php echo htmlspecialchars($completed_orders); ?></p>
            </div>
        </div>
    </div>
</div>

<?php include '../emp_footer.php'; ?>