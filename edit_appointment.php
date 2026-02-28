<?php
session_start();
require_once 'config.php';

// Language handling
$languages = ['en', 'ar'];
$default_lang = 'en';

if (isset($_GET['lang']) && in_array($_GET['lang'], $languages)) {
    $_SESSION['lang'] = $_GET['lang'];
    $current_lang = $_GET['lang'];
} elseif (isset($_SESSION['lang'])) {
    $current_lang = $_SESSION['lang'];
} else {
    $current_lang = $default_lang;
}

// Translations
$translations = [
    'en' => [
        'page_title' => 'Edit Appointment - Admin',
        'heading' => 'Edit Appointment',
        'label_full_name' => 'Full Name',
        'label_email' => 'Email',
        'label_phone' => 'Phone',
        'label_date' => 'Appointment Date',
        'label_department' => 'Department',
        'label_notes' => 'Additional Notes',
        'button_update' => 'Update',
        'button_cancel' => 'Cancel',
        'back_link' => 'Back to Admin',
        'error_name_required' => 'Name is required.',
        'error_email_invalid' => 'Valid email is required.',
        'error_date_required' => 'Appointment date is required.',
        // Department options
        'dept_general' => 'General checkup',
        'dept_cardiology' => 'Cardiology',
        'dept_pediatrics' => 'Pediatrics',
        'dept_orthopedics' => 'Orthopedics',
    ],
    'ar' => [
        'page_title' => 'تعديل الموعد - المدير',
        'heading' => 'تعديل الموعد',
        'label_full_name' => 'الاسم الكامل',
        'label_email' => 'البريد الإلكتروني',
        'label_phone' => 'رقم الهاتف',
        'label_date' => 'تاريخ الموعد',
        'label_department' => 'القسم',
        'label_notes' => 'ملاحظات إضافية',
        'button_update' => 'تحديث',
        'button_cancel' => 'إلغاء',
        'back_link' => 'العودة للإدارة',
        'error_name_required' => 'الاسم مطلوب.',
        'error_email_invalid' => 'البريد الإلكتروني صحيح مطلوب.',
        'error_date_required' => 'تاريخ الموعد مطلوب.',
        // Department options
        'dept_general' => 'فحص عام',
        'dept_cardiology' => 'أمراض القلب',
        'dept_pediatrics' => 'طب الأطفال',
        'dept_orthopedics' => 'جراحة العظام',
    ]
];

$lang = $translations[$current_lang];

// Check login
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin.php?lang=' . $current_lang);
    exit;
}

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: admin.php?lang=' . $current_lang);
    exit;
}

// Fetch appointment
$stmt = $pdo->prepare("SELECT * FROM appointments WHERE id = ?");
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$appointment) {
    header('Location: admin.php?lang=' . $current_lang);
    exit;
}

// Handle form submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $appointment_date = $_POST['appointment_date'] ?? '';
    $department = $_POST['department'] ?? '';
    $message = trim($_POST['message'] ?? '');
    
    if (empty($full_name)) $errors[] = $lang['error_name_required'];
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = $lang['error_email_invalid'];
    if (empty($appointment_date)) $errors[] = $lang['error_date_required'];
    
    if (empty($errors)) {
        $update = $pdo->prepare("UPDATE appointments SET full_name = ?, email = ?, phone = ?, appointment_date = ?, department = ?, message = ? WHERE id = ?");
        $update->execute([$full_name, $email, $phone, $appointment_date, $department, $message, $id]);
        header('Location: admin.php?updated=appointment&lang=' . $current_lang);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $current_lang ?>" dir="<?= $current_lang == 'ar' ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang['page_title'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f0f9f7; padding: 40px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        h1 { color: #1e3b3a; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #1e3b3a; font-weight: 500; }
        input, select, textarea { width: 100%; padding: 14px; border: 1.5px solid #cde3dd; border-radius: 50px; font-size: 1rem; outline: none; }
        textarea { border-radius: 30px; resize: vertical; }
        button { background: #0b6e4f; color: white; border: none; padding: 14px 30px; border-radius: 50px; font-weight: 600; cursor: pointer; margin-right: 10px; }
        .cancel { background: #6c757d; color: white; padding: 14px 30px; border-radius: 50px; text-decoration: none; display: inline-block; }
        .error { color: #dc3545; margin-bottom: 15px; }
        .back-link { display: inline-block; margin-top: 20px; color: #0b6e4f; text-decoration: none; }
        /* Language switcher */
        .lang-switcher {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .lang-switcher a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
            transition: 0.2s;
            color: #2f3e46;
            background: #e2f1ec;
        }
        .lang-switcher a.active {
            background: #0b6e4f;
            color: white;
        }
        [dir="rtl"] button {
            margin-right: 0;
            margin-left: 10px;
        }
        [dir="rtl"] .cancel {
            margin-right: 0;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lang-switcher">
            <a href="?id=<?= $id ?>&lang=en" class="<?= $current_lang == 'en' ? 'active' : '' ?>">English</a>
            <a href="?id=<?= $id ?>&lang=ar" class="<?= $current_lang == 'ar' ? 'active' : '' ?>">العربية</a>
        </div>

        <h1><?= $lang['heading'] ?></h1>
        <?php if (!empty($errors)): ?>
            <div class="error"><?= implode('<br>', $errors) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label><?= $lang['label_full_name'] ?></label>
                <input type="text" name="full_name" value="<?= htmlspecialchars($appointment['full_name']) ?>" required>
            </div>
            <div class="form-group">
                <label><?= $lang['label_email'] ?></label>
                <input type="email" name="email" value="<?= htmlspecialchars($appointment['email']) ?>" required>
            </div>
            <div class="form-group">
                <label><?= $lang['label_phone'] ?></label>
                <input type="tel" name="phone" value="<?= htmlspecialchars($appointment['phone']) ?>">
            </div>
            <div class="form-group">
                <label><?= $lang['label_date'] ?></label>
                <input type="date" name="appointment_date" value="<?= htmlspecialchars($appointment['appointment_date']) ?>" required>
            </div>
            <div class="form-group">
                <label><?= $lang['label_department'] ?></label>
                <select name="department">
                    <option value="General checkup" <?= $appointment['department'] == 'General checkup' ? 'selected' : '' ?>><?= $lang['dept_general'] ?></option>
                    <option value="Cardiology" <?= $appointment['department'] == 'Cardiology' ? 'selected' : '' ?>><?= $lang['dept_cardiology'] ?></option>
                    <option value="Pediatrics" <?= $appointment['department'] == 'Pediatrics' ? 'selected' : '' ?>><?= $lang['dept_pediatrics'] ?></option>
                    <option value="Orthopedics" <?= $appointment['department'] == 'Orthopedics' ? 'selected' : '' ?>><?= $lang['dept_orthopedics'] ?></option>
                </select>
            </div>
            <div class="form-group">
                <label><?= $lang['label_notes'] ?></label>
                <textarea name="message" rows="4"><?= htmlspecialchars($appointment['message']) ?></textarea>
            </div>
            <button type="submit"><?= $lang['button_update'] ?></button>
            <a href="admin.php?lang=<?= $current_lang ?>" class="cancel"><?= $lang['button_cancel'] ?></a>
        </form>
        <a href="admin.php?lang=<?= $current_lang ?>" class="back-link">&larr; <?= $lang['back_link'] ?></a>
    </div>
</body>
</html>