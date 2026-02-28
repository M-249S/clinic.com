<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $appointment_date = $_POST['appointment_date'] ?? '';
    $department = $_POST['department'] ?? '';
    $message = trim($_POST['message'] ?? '');

    $errors = [];
    if (empty($full_name)) $errors[] = 'Name is required.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (empty($appointment_date)) $errors[] = 'Appointment date is required.';

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO appointments (full_name, email, phone, appointment_date, department, message) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$full_name, $email, $phone, $appointment_date, $department, $message]);

            // Optional: send confirmation email to patient and notification to clinic

            header('Location: appointment.php?success=1');
            exit;
        } catch (PDOException $e) {
            error_log("Appointment error: " . $e->getMessage());
            header('Location: appointment.php?error=1');
            exit;
        }
    } else {
        header('Location: appointment.php?error=1');
        exit;
    }
} else {
    header('Location: appointment.php');
    exit;
}