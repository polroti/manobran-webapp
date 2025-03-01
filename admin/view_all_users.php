<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Include the database connection
require_once '../db_connect.php';

// Fetch all users
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-container">
    <?php include 'side_navigator.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Users</h2>
        <table class="mui-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First Name </th>
                    <th>Last Name </th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                        <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                            <span class="badge badge-<?php echo strtolower($user['user_type']); ?>">
                                <?php echo htmlspecialchars($user['user_type']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="mui-btn mui-btn--primary">Edit</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="mui-btn mui-btn--danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>