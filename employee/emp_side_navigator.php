<div class="side-navigator">
    <ul>
        <li><a href="<?php echo ($_SESSION['employee_role'] === 'cashier') ? 'cashier_dashboard.php' : 'tailor_dashboard.php'; ?>">Dashboard</a></li>
        <?php if ($_SESSION['employee_role'] === 'cashier'): ?>
            <li><a href="orders.php">View All Orders</a></li>
        <?php else: ?>
            <li><a href="assigned_orders.php">My Assigned Orders</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>