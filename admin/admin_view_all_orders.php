<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Include the database connection
require_once '../db_connect.php';

// Check if the orders table exists
$table_exists = false;
try {
    $stmt = $conn->query("SELECT 1 FROM orders LIMIT 1");
    $table_exists = true;
} catch (PDOException $e) {
    $table_exists = false;
}

// Fetch all orders if the table exists
$orders = [];
if ($table_exists) {
    $stmt = $conn->prepare("SELECT * FROM orders");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-container">
    <?php include 'side_navigator.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Orders</h2>
        <?php if (!$table_exists): ?>
            <div class="exception-content">
                <p>The <strong>orders</strong> table does not exist.</p>
                <p>Click the button below to create the table.</p>
                <a href="create_orders_table.php" class="mui-btn mui-btn--primary">Create Orders Table</a>
            </div>
        <?php else: ?>
            <table class="mui-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td>
                                <a href="view_order.php?id=<?php echo $order['id']; ?>" class="mui-btn mui-btn--primary">View</a>
                                <a href="edit_order.php?id=<?php echo $order['id']; ?>" class="mui-btn mui-btn--secondary">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>