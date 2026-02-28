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
        // Navigation
        'nav_home' => 'Home',
        'nav_services' => 'Services',
        'nav_doctors' => 'Doctors',
        'nav_contact' => 'Contact',
        'nav_book' => 'Book now',
        // Login
        'login_heading' => 'Admin Login',
        'login_username_placeholder' => 'Username or Email',
        'login_password_placeholder' => 'Password',
        'login_button' => 'Login',
        'login_error_empty' => 'Please enter username/email and password.',
        'login_error_invalid' => 'Invalid credentials.',
        'register_link' => 'No account? <a href="register_admin.php">Register here</a>',
        // Dashboard
        'welcome' => 'Welcome,',
        'logout' => 'Logout',
        'dashboard_heading' => 'Admin Dashboard',
        'change_password_heading' => 'Change Your Password',
        'current_password_placeholder' => 'Current password',
        'new_password_placeholder' => 'New password (min. 6 characters)',
        'confirm_password_placeholder' => 'Confirm new password',
        'update_password_btn' => 'Update Password',
        'password_success' => 'Password changed successfully.',
        'password_error_incorrect' => 'Current password is incorrect.',
        'password_error_length' => 'New password must be at least 6 characters.',
        'password_error_mismatch' => 'New passwords do not match.',
        'password_error_failed' => 'Failed to change password.',
        // Contacts
        'contacts_title' => 'Contact Messages',
        'table_id' => 'ID',
        'table_name' => 'Name',
        'table_email' => 'Email',
        'table_message' => 'Message',
        'table_date' => 'Date',
        'table_actions' => 'Actions',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'no_contacts' => 'No contact messages yet.',
        // Appointments
        'appointments_title' => 'Appointments',
        'table_phone' => 'Phone',
        'table_appointment_date' => 'Date',
        'table_department' => 'Dept',
        'table_notes' => 'Notes',
        'table_booked' => 'Booked',
        'no_appointments' => 'No appointments yet.',
        // Services
        'services_title' => 'Manage Services',
        'add_service' => '+ Add New Service',
        'table_icon' => 'Icon',
        'table_title' => 'Title',
        'table_description' => 'Description',
        'table_order' => 'Order',
        'no_services' => 'No services yet. <a href="edit_service.php">Add your first service</a>.',
        // Delete confirm
        'confirm_delete_contact' => 'Delete this contact message?',
        'confirm_delete_appointment' => 'Delete this appointment?',
        'confirm_delete_service' => 'Delete this service?',
        // Footer
        'footer_tagline' => 'Your trusted partner in health.',
        'footer_quick_links' => 'Quick links',
        'footer_legal' => 'Legal',
        'footer_privacy' => 'Privacy policy',
        'footer_terms' => 'Terms of use',
        'footer_copyright' => '© 2026 MediCare+ Clinic. All rights reserved.',
    ],
    'ar' => [
        // Navigation
        'nav_home' => 'الرئيسية',
        'nav_services' => 'الخدمات',
        'nav_doctors' => 'الأطباء',
        'nav_contact' => 'اتصل بنا',
        'nav_book' => 'احجز الآن',
        // Login
        'login_heading' => 'تسجيل دخول المدير',
        'login_username_placeholder' => 'اسم المستخدم أو البريد الإلكتروني',
        'login_password_placeholder' => 'كلمة المرور',
        'login_button' => 'دخول',
        'login_error_empty' => 'الرجاء إدخال اسم المستخدم/البريد الإلكتروني وكلمة المرور.',
        'login_error_invalid' => 'بيانات الدخول غير صحيحة.',
        'register_link' => 'ليس لديك حساب؟ <a href="register_admin.php">سجل هنا</a>',
        // Dashboard
        'welcome' => 'مرحبًا،',
        'logout' => 'تسجيل خروج',
        'dashboard_heading' => 'لوحة التحكم',
        'change_password_heading' => 'تغيير كلمة المرور',
        'current_password_placeholder' => 'كلمة المرور الحالية',
        'new_password_placeholder' => 'كلمة المرور الجديدة (6 أحرف على الأقل)',
        'confirm_password_placeholder' => 'تأكيد كلمة المرور الجديدة',
        'update_password_btn' => 'تحديث كلمة المرور',
        'password_success' => 'تم تغيير كلمة المرور بنجاح.',
        'password_error_incorrect' => 'كلمة المرور الحالية غير صحيحة.',
        'password_error_length' => 'كلمة المرور الجديدة يجب أن تكون 6 أحرف على الأقل.',
        'password_error_mismatch' => 'كلمتا المرور غير متطابقتين.',
        'password_error_failed' => 'فشل تغيير كلمة المرور.',
        // Contacts
        'contacts_title' => 'رسائل الاتصال',
        'table_id' => 'المعرف',
        'table_name' => 'الاسم',
        'table_email' => 'البريد الإلكتروني',
        'table_message' => 'الرسالة',
        'table_date' => 'التاريخ',
        'table_actions' => 'الإجراءات',
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'no_contacts' => 'لا توجد رسائل اتصال بعد.',
        // Appointments
        'appointments_title' => 'المواعيد',
        'table_phone' => 'الهاتف',
        'table_appointment_date' => 'التاريخ',
        'table_department' => 'القسم',
        'table_notes' => 'ملاحظات',
        'table_booked' => 'تاريخ الحجز',
        'no_appointments' => 'لا توجد مواعيد بعد.',
        // Services
        'services_title' => 'إدارة الخدمات',
        'add_service' => '+ إضافة خدمة جديدة',
        'table_icon' => 'الأيقونة',
        'table_title' => 'العنوان',
        'table_description' => 'الوصف',
        'table_order' => 'الترتيب',
        'no_services' => 'لا توجد خدمات بعد. <a href="edit_service.php">أضف خدمتك الأولى</a>.',
        // Delete confirm
        'confirm_delete_contact' => 'هل تريد حذف رسالة الاتصال هذه؟',
        'confirm_delete_appointment' => 'هل تريد حذف هذا الموعد؟',
        'confirm_delete_service' => 'هل تريد حذف هذه الخدمة؟',
        // Footer
        'footer_tagline' => 'شريكك الموثوق في الصحة.',
        'footer_quick_links' => 'روابط سريعة',
        'footer_legal' => 'قانوني',
        'footer_privacy' => 'سياسة الخصوصية',
        'footer_terms' => 'شروط الاستخدام',
        'footer_copyright' => '© 2026 عيادة ميديكير+. جميع الحقوق محفوظة.',
    ]
];

$lang = $translations[$current_lang];

// Redirect to login if not authenticated
function requireLogin() {
    if (!isset($_SESSION['admin_id'])) {
        header('Location: admin.php');
        exit;
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    unset($_SESSION['admin_id']);
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Handle login
$login_error = '';
if (isset($_POST['login'])) {
    $username_email = trim($_POST['username_email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username_email) || empty($password)) {
        $login_error = $lang['login_error_empty'];
    } else {
        // Find user by username or email
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ? OR email = ?");
        $stmt->execute([$username_email, $username_email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            header('Location: admin.php?lang=' . $current_lang);
            exit;
        } else {
            $login_error = $lang['login_error_invalid'];
        }
    }
}

// Handle password change (only if logged in)
if (isset($_POST['change_password']) && isset($_SESSION['admin_id'])) {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // Fetch current user's hash
    $stmt = $pdo->prepare("SELECT password_hash FROM admin_users WHERE id = ?");
    $stmt->execute([$_SESSION['admin_id']]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($current, $user['password_hash'])) {
        $pw_error = $lang['password_error_incorrect'];
    } elseif (strlen($new) < 6) {
        $pw_error = $lang['password_error_length'];
    } elseif ($new !== $confirm) {
        $pw_error = $lang['password_error_mismatch'];
    } else {
        $new_hash = password_hash($new, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE admin_users SET password_hash = ? WHERE id = ?");
        if ($update->execute([$new_hash, $_SESSION['admin_id']])) {
            $pw_success = $lang['password_success'];
        } else {
            $pw_error = $lang['password_error_failed'];
        }
    }
}

// Handle delete actions (only if logged in)
if (isset($_SESSION['admin_id']) && isset($_GET['delete'])) {
    $type = $_GET['type'] ?? '';
    $id = intval($_GET['id'] ?? 0);
    if ($type === 'contact' && $id > 0) {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: admin.php?lang=' . $current_lang);
        exit;
    } elseif ($type === 'appointment' && $id > 0) {
        $stmt = $pdo->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: admin.php?lang=' . $current_lang);
        exit;
    }
}
if (isset($_SESSION['admin_id']) && isset($_GET['delete_service'])) {
    $id = intval($_GET['id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: admin.php?lang=' . $current_lang);
        exit;
    }
}

// Fetch data if logged in
if (isset($_SESSION['admin_id'])) {
    $contacts = $pdo->query("SELECT * FROM contacts ORDER BY submitted_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    $appointments = $pdo->query("SELECT * FROM appointments ORDER BY booked_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    $services = $pdo->query("SELECT * FROM services ORDER BY display_order ASC")->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="<?= $current_lang ?>" dir="<?= $current_lang == 'ar' ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - MediCare+</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f0f9f7; padding: 40px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: #1e3b3a; margin-bottom: 20px; }
        .login-box { max-width: 400px; margin: 100px auto; background: white; padding: 40px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        .login-box input { width: 100%; padding: 14px; border: 1.5px solid #cde3dd; border-radius: 50px; margin-bottom: 20px; }
        .login-box button { background: #0b6e4f; color: white; border: none; padding: 14px; border-radius: 50px; width: 100%; font-weight: 600; cursor: pointer; }
        .error { color: #dc3545; margin-bottom: 15px; text-align: center; }
        .success { color: #155724; background: #d4edda; padding: 10px; border-radius: 50px; margin-bottom: 15px; text-align: center; }
        .logout { text-align: right; margin-bottom: 20px; }
        .logout a { color: #0b6e4f; text-decoration: none; margin-left: 15px; }
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.02); margin-bottom: 40px; }
        th { background: #0b6e4f; color: white; font-weight: 500; padding: 14px; text-align: left; }
        td { padding: 14px; border-bottom: 1px solid #e0f0e8; }
        tr:last-child td { border-bottom: none; }
        .section-title { font-size: 1.8rem; color: #1e3b3a; margin: 30px 0 20px; }
        .action-btn { padding: 5px 12px; border-radius: 30px; text-decoration: none; font-size: 0.9rem; margin-right: 5px; display: inline-block; }
        .edit-btn { background: #ffc107; color: #333; }
        .delete-btn { background: #dc3545; color: white; }
        .delete-btn:hover { background: #c82333; }
        .edit-btn:hover { background: #e0a800; }
        .password-change { background: white; padding: 30px; border-radius: 30px; margin-bottom: 40px; box-shadow: 0 10px 20px rgba(0,0,0,0.02); }
        .password-change h3 { color: #1e3b3a; margin-bottom: 20px; }
        .password-change input { width: 100%; padding: 12px; border: 1.5px solid #cde3dd; border-radius: 50px; margin-bottom: 15px; }
        .password-change button { background: #0b6e4f; color: white; border: none; padding: 12px 30px; border-radius: 50px; font-weight: 600; cursor: pointer; }
        .register-link { text-align: center; margin-top: 20px; }
        .register-link a { color: #0b6e4f; text-decoration: none; }
        /* Language switcher */
        .lang-switcher {
            display: flex;
            gap: 10px;
            margin-left: 20px;
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
        [dir="rtl"] .logout {
            text-align: left;
        }
        [dir="rtl"] .lang-switcher {
            margin-left: 0;
            margin-right: 20px;
        }
        [dir="rtl"] table th,
        [dir="rtl"] table td {
            text-align: right;
        }
        [dir="rtl"] .action-btn {
            margin-right: 0;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!isset($_SESSION['admin_id'])): ?>
            <!-- Login Form -->
            <div class="login-box">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h1><?= $lang['login_heading'] ?></h1>
                    <div class="lang-switcher">
                        <a href="?lang=en" class="<?= $current_lang == 'en' ? 'active' : '' ?>">English</a>
                        <a href="?lang=ar" class="<?= $current_lang == 'ar' ? 'active' : '' ?>">العربية</a>
                    </div>
                </div>
                <?php if ($login_error): ?>
                    <p class="error"><?= htmlspecialchars($login_error) ?></p>
                <?php endif; ?>
                <form method="POST">
                    <input type="text" name="username_email" placeholder="<?= $lang['login_username_placeholder'] ?>" required>
                    <input type="password" name="password" placeholder="<?= $lang['login_password_placeholder'] ?>" required>
                    <button type="submit" name="login"><?= $lang['login_button'] ?></button>
                </form>
                <div class="register-link">
                    <?= $lang['register_link'] ?>
                </div>
            </div>
        <?php else: ?>
            <!-- Header with language switcher and logout -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div class="logout">
                    <?= $lang['welcome'] ?> <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong> |
                    <a href="?logout=1&lang=<?= $current_lang ?>"><?= $lang['logout'] ?></a>
                </div>
                <div class="lang-switcher">
                    <a href="?lang=en" class="<?= $current_lang == 'en' ? 'active' : '' ?>">English</a>
                    <a href="?lang=ar" class="<?= $current_lang == 'ar' ? 'active' : '' ?>">العربية</a>
                </div>
            </div>
            <h1><?= $lang['dashboard_heading'] ?></h1>

            <!-- Change Password Section -->
            <div class="password-change">
                <h3><?= $lang['change_password_heading'] ?></h3>
                <?php if (isset($pw_success)) echo "<p class='success'>" . htmlspecialchars($pw_success) . "</p>"; ?>
                <?php if (isset($pw_error)) echo "<p class='error'>" . htmlspecialchars($pw_error) . "</p>"; ?>
                <form method="POST">
                    <input type="password" name="current_password" placeholder="<?= $lang['current_password_placeholder'] ?>" required>
                    <input type="password" name="new_password" placeholder="<?= $lang['new_password_placeholder'] ?>" required>
                    <input type="password" name="confirm_password" placeholder="<?= $lang['confirm_password_placeholder'] ?>" required>
                    <button type="submit" name="change_password"><?= $lang['update_password_btn'] ?></button>
                </form>
            </div>

            <!-- Contact Messages -->
            <div class="section-title"><?= $lang['contacts_title'] ?></div>
            <?php if (count($contacts) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th><?= $lang['table_id'] ?></th>
                            <th><?= $lang['table_name'] ?></th>
                            <th><?= $lang['table_email'] ?></th>
                            <th><?= $lang['table_message'] ?></th>
                            <th><?= $lang['table_date'] ?></th>
                            <th><?= $lang['table_actions'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?= htmlspecialchars($contact['id']) ?></td>
                            <td><?= htmlspecialchars($contact['full_name']) ?></td>
                            <td><?= htmlspecialchars($contact['email']) ?></td>
                            <td><?= htmlspecialchars(substr($contact['message'], 0, 50)) . (strlen($contact['message']) > 50 ? '...' : '') ?></td>
                            <td><?= htmlspecialchars($contact['submitted_at']) ?></td>
                            <td>
                                <a href="edit_contact.php?id=<?= $contact['id'] ?>&lang=<?= $current_lang ?>" class="action-btn edit-btn"><?= $lang['edit'] ?></a>
                                <a href="?delete&type=contact&id=<?= $contact['id'] ?>&lang=<?= $current_lang ?>" class="action-btn delete-btn" onclick="return confirm('<?= $lang['confirm_delete_contact'] ?>')"><?= $lang['delete'] ?></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><?= $lang['no_contacts'] ?></p>
            <?php endif; ?>

            <!-- Appointments -->
            <div class="section-title"><?= $lang['appointments_title'] ?></div>
            <?php if (count($appointments) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th><?= $lang['table_id'] ?></th>
                            <th><?= $lang['table_name'] ?></th>
                            <th><?= $lang['table_email'] ?></th>
                            <th><?= $lang['table_phone'] ?></th>
                            <th><?= $lang['table_appointment_date'] ?></th>
                            <th><?= $lang['table_department'] ?></th>
                            <th><?= $lang['table_notes'] ?></th>
                            <th><?= $lang['table_booked'] ?></th>
                            <th><?= $lang['table_actions'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $app): ?>
                        <tr>
                            <td><?= htmlspecialchars($app['id']) ?></td>
                            <td><?= htmlspecialchars($app['full_name']) ?></td>
                            <td><?= htmlspecialchars($app['email']) ?></td>
                            <td><?= htmlspecialchars($app['phone']) ?></td>
                            <td><?= htmlspecialchars($app['appointment_date']) ?></td>
                            <td><?= htmlspecialchars($app['department']) ?></td>
                            <td><?= htmlspecialchars(substr($app['message'], 0, 30)) ?></td>
                            <td><?= htmlspecialchars($app['booked_at']) ?></td>
                            <td>
                                <a href="edit_appointment.php?id=<?= $app['id'] ?>&lang=<?= $current_lang ?>" class="action-btn edit-btn"><?= $lang['edit'] ?></a>
                                <a href="?delete&type=appointment&id=<?= $app['id'] ?>&lang=<?= $current_lang ?>" class="action-btn delete-btn" onclick="return confirm('<?= $lang['confirm_delete_appointment'] ?>')"><?= $lang['delete'] ?></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><?= $lang['no_appointments'] ?></p>
            <?php endif; ?>

            <!-- Services Management -->
            <div class="section-title"><?= $lang['services_title'] ?></div>
            <p><a href="edit_service.php?lang=<?= $current_lang ?>" class="action-btn edit-btn" style="padding: 10px 20px; margin-bottom: 20px; display: inline-block;"><?= $lang['add_service'] ?></a></p>
            <?php if (count($services) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th><?= $lang['table_id'] ?></th>
                            <th><?= $lang['table_icon'] ?></th>
                            <th><?= $lang['table_title'] ?></th>
                            <th><?= $lang['table_description'] ?></th>
                            <th><?= $lang['table_order'] ?></th>
                            <th><?= $lang['table_actions'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?= htmlspecialchars($service['id']) ?></td>
                            <td><i class="fas <?= htmlspecialchars($service['icon_class']) ?>"></i></td>
                            <td><?= htmlspecialchars($service['title']) ?></td>
                            <td><?= htmlspecialchars(substr($service['description'], 0, 50)) . (strlen($service['description']) > 50 ? '...' : '') ?></td>
                            <td><?= htmlspecialchars($service['display_order']) ?></td>
                            <td>
                                <a href="edit_service.php?id=<?= $service['id'] ?>&lang=<?= $current_lang ?>" class="action-btn edit-btn"><?= $lang['edit'] ?></a>
                                <a href="?delete_service&id=<?= $service['id'] ?>&lang=<?= $current_lang ?>" class="action-btn delete-btn" onclick="return confirm('<?= $lang['confirm_delete_service'] ?>')"><?= $lang['delete'] ?></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><?= $lang['no_services'] ?></p>
            <?php endif; ?>

            <!-- Footer (optional, you can include a footer similar to other pages) -->
            <footer style="margin-top: 50px; text-align: center; color: #5a7778;">
                <p><?= $lang['footer_copyright'] ?></p>
            </footer>
        <?php endif; ?>
    </div>
</body>
</html>