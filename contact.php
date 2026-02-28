<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $errors = [];
    if (empty($full_name)) $errors[] = 'Name is required.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (empty($message)) $errors[] = 'Message is required.';

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (full_name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$full_name, $email, $message]);

            // Optional: send email notification to admin
            // mail('admin@example.com', 'New contact message', $message, "From: $email");

            header('Location: index.php?contact=success#contact');
            exit;
        } catch (PDOException $e) {
            error_log("Contact error: " . $e->getMessage());
            header('Location: index.php?contact=error#contact');
            exit;
        }
    } else {
        // In a real app, you'd store errors in session and redirect back
        header('Location: index.php?contact=error#contact');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}