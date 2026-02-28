<?php
require_once 'config.php';

$new_password = 'admin123'; // Change if you want a different password
$hash = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE admin_settings SET setting_value = ? WHERE setting_key = 'admin_password'");
if ($stmt->execute([$hash])) {
    echo "Password reset to '$new_password'. New hash stored.";
} else {
    echo "Failed to update password.";
}