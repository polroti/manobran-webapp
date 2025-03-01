<?php
session_start();

// Check if the employee is logged in and is a cashier
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['employee_role'] !== 'cashier') {
    header('Location: employee_login.php');
    exit();
}

// Include the database connection
require_once 'admin/includes/db_connect.php';

// Fetch all orders
$stmt = $conn->prepare("SELECT * FROM orders");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/employee_header.php'; ?>

<div class="dashboard-container">
    <?php include 'includes/employee_side_navigator.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>All Orders</h2>
        <table class="mui-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td>
                            <span class="badge badge-<?php echo strtolower($order['status']); ?>">
                                <?php echo htmlspecialchars($order['status']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($order['assigned_to'] ?? 'Unassigned'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/employee_footer.php'; ?>