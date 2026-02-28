<?php
session_start();
require_once 'config.php';

// If already logged in, redirect to admin panel
if (isset($_SESSION['admin_id'])) {
    header('Location: admin.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $error = 'Username or email already taken.';
        } else {
            // Hash password and insert
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO admin_users (username, email, password_hash) VALUES (?, ?, ?)");
            if ($insert->execute([$username, $email, $hash])) {
                $success = 'Admin registered successfully. You can now <a href="admin.php">login</a>.';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - MediCare+</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f0f9f7; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .register-box { max-width: 450px; width: 100%; background: white; padding: 40px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        h1 { color: #1e3b3a; margin-bottom: 10px; font-size: 2rem; }
        .subtitle { color: #5a7778; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #1e3b3a; font-weight: 500; }
        input { width: 100%; padding: 14px; border: 1.5px solid #cde3dd; border-radius: 50px; font-size: 1rem; outline: none; transition: 0.2s; }
        input:focus { border-color: #0b6e4f; box-shadow: 0 0 0 3px rgba(11,110,79,0.1); }
        button { background: #0b6e4f; color: white; border: none; padding: 14px; border-radius: 50px; width: 100%; font-weight: 600; font-size: 1.1rem; cursor: pointer; transition: 0.2s; margin-top: 10px; }
        button:hover { background: #095a40; }
        .error { color: #dc3545; background: #f8d7da; padding: 12px; border-radius: 50px; margin-bottom: 20px; text-align: center; }
        .success { color: #155724; background: #d4edda; padding: 12px; border-radius: 50px; margin-bottom: 20px; text-align: center; }
        .login-link { text-align: center; margin-top: 20px; }
        .login-link a { color: #0b6e4f; text-decoration: none; }
    </style>
</head>
<body>
    <div class="register-box">
        <h1>Create Admin Account</h1>
        <div class="subtitle">Register to manage the clinic</div>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Password (min. 6 characters)</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="admin.php">Login here</a>
        </div>
    </div>
</body>
</html>