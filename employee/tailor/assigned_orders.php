<?php



session_start();

// Check if the employee is logged in and is a tailor
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['employee_role'] !== 'TAILOR') {
    header('Location: employee_login.php');
    exit();
}

// Include the database connection
require_once '../../db_connect.php';

// Fetch orders assigned to the current tailor
$stmt = $conn->prepare("SELECT * FROM orders WHERE assigned_to = :username");
$stmt->bindParam(':username', $_SESSION['employee_username']);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
$header_file = '../emp_header.php';
if (file_exists($header_file)) {
    include $header_file;
} else {
    echo '<div class="exception-content"><p>The header file is missing. Please contact the administrator.</p></div>';
}
    ?>
<div class="dashboard-container">

    <?php include './emp_side_navigator.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>My Assigned Orders</h2>
        <table class="mui-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Status</th>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/employee_footer.php'; ?>