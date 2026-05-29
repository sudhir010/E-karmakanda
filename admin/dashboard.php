<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../database/config.php';

$bookings_result = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");
$contacts_result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – eKarmakanda Admin</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #fdfaf6; padding-top: 80px; }
        .dashboard { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }
        .dashboard h1 { color: #46244c; margin-bottom: 2rem; }
        .section { background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .section h2 { color: #46244c; margin-bottom: 1rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 0.75rem; border-bottom: 1px solid #eee; }
        th { background: #46244c; color: #fff; }
        .footer { text-align: center; padding: 1.5rem; background: #46244c; color: #fff; margin-top: 2rem; }
        .logout-btn { float: right; background: #a63860; color: #fff; padding: 0.5rem 1rem; border-radius: 5px; text-decoration: none; }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">eKarmakanda Admin</div>
            <ul class="nav-links">
                <li><a href="../index.php">Home</a></li>
                <li>
                    <form action="../logout.php" method="post" style="display:inline;">
                        <button type="submit" class="btn">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main class="dashboard">
        <h1>Admin Dashboard</h1>

        <div class="section">
            <h2>Recent Bookings</h2>
            <?php if ($bookings_result && $bookings_result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Puja</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th>Notes</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $bookings_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['puja_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['preferred_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['notes']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No bookings yet.</p>
            <?php endif; ?>
        </div>

        <div class="section">
            <h2>Contact Messages</h2>
            <?php if ($contacts_result && $contacts_result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $contacts_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No messages yet.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025 eKarmakanda. All rights reserved.</p>
    </footer>
</body>
</html>
<?php $conn->close(); ?>
