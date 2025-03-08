<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manobran Tailors - Employee</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <nav class="mui-appbar mui--z1">
        <div class="mui-container">
            <table width="100%">
                <tr style="vertical-align: middle;">
                    <td class="mui--text-title">Manobran Tailors</td>
                    <td style="text-align: right;">
                        <?php if (isset($_SESSION['employee_username'])): ?>
                            <span>Welcome, <?php echo htmlspecialchars($_SESSION['employee_username']); ?></span>
                            <a href="../logout.php" class="mui-btn mui-btn--primary" style="margin-left: 10px;">Logout</a>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </nav>