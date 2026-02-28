<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin.php');
    exit;
}

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: admin.php');
    exit;
}

// Fetch contact
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$contact) {
    header('Location: admin.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    $errors = [];
    if (empty($full_name)) $errors[] = 'Name is required.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (empty($message)) $errors[] = 'Message is required.';
    
    if (empty($errors)) {
        $update = $pdo->prepare("UPDATE contacts SET full_name = ?, email = ?, message = ? WHERE id = ?");
        $update->execute([$full_name, $email, $message, $id]);
        header('Location: admin.php?updated=contact');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f0f9f7; padding: 40px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        h1 { color: #1e3b3a; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #1e3b3a; font-weight: 500; }
        input, textarea { width: 100%; padding: 14px; border: 1.5px solid #cde3dd; border-radius: 50px; font-size: 1rem; outline: none; }
        textarea { border-radius: 30px; resize: vertical; }
        button { background: #0b6e4f; color: white; border: none; padding: 14px 30px; border-radius: 50px; font-weight: 600; cursor: pointer; margin-right: 10px; }
        .cancel { background: #6c757d; }
        .error { color: #dc3545; margin-bottom: 15px; }
        .back-link { display: inline-block; margin-top: 20px; color: #0b6e4f; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Contact Message</h1>
        <?php if (!empty($errors)): ?>
            <div class="error"><?= implode('<br>', $errors) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?= htmlspecialchars($contact['full_name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" rows="6" required><?= htmlspecialchars($contact['message']) ?></textarea>
            </div>
            <button type="submit">Update</button>
            <a href="admin.php" class="cancel" style="background:#6c757d; color:white; padding:14px 30px; border-radius:50px; text-decoration:none;">Cancel</a>
        </form>
        <a href="admin.php" class="back-link">&larr; Back to Admin</a>
    </div>
</body>
</html>