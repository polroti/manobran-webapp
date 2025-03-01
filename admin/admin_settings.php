<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Include the database connection
require_once '..//db_connect.php';

// Check if the settings table exists
$table_exists = false;
try {
    $stmt = $conn->query("SELECT 1 FROM settings LIMIT 1");
    $table_exists = true;
} catch (PDOException $e) {
    $table_exists = false;
}

// Fetch settings if the table exists
$settings = [];
if ($table_exists) {
    $stmt = $conn->prepare("SELECT * FROM settings");
    $stmt->execute();
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-container">
    <?php include 'side_navigator.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Settings</h2>
        <?php if (!$table_exists): ?>
            <div class="exception-content">
                <p>The <strong>settings</strong> table does not exist.</p>
                <p>Click the button below to create the table.</p>
                <a href="create_settings_table.php" class="mui-btn mui-btn--primary">Create Settings Table</a>
            </div>
        <?php else: ?>
            <form action="update_settings.php" method="POST">
                <div class="mui-textfield">
                    <label for="shop_name">Shop Name</label>
                    <input type="text" id="shop_name" name="shop_name" value="<?php echo htmlspecialchars($settings['shop_name'] ?? 'Manobran Tailors'); ?>" required>
                </div>
                <div class="mui-textfield">
                    <label for="email">Contact Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($settings['email'] ?? 'info@manobrantailors.com'); ?>" required>
                </div>
                <button type="submit" class="mui-btn mui-btn--primary">Save Changes</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>