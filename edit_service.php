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
        'page_title_edit' => 'Edit Service - Admin',
        'page_title_add' => 'Add Service - Admin',
        'heading_edit' => 'Edit Service',
        'heading_add' => 'Add New Service',
        'label_title' => 'Title',
        'label_description' => 'Description',
        'label_icon' => 'Font Awesome Icon Class',
        'label_order' => 'Display Order',
        'placeholder_icon' => 'e.g., fa-stethoscope',
        'preview' => 'Preview:',
        'icon_note' => 'Find icons at <a href="https://fontawesome.com/icons" target="_blank">FontAwesome</a>. Use class names like "fa-heartbeat", "fa-child", etc.',
        'button_update' => 'Update',
        'button_create' => 'Create',
        'button_cancel' => 'Cancel',
        'error_title_required' => 'Title is required.',
        'error_description_required' => 'Description is required.',
        'error_icon_required' => 'Icon class is required.',
        'back_link' => 'Back to Admin',  // Added missing key
    ],
    'ar' => [
        'page_title_edit' => 'تعديل الخدمة - المدير',
        'page_title_add' => 'إضافة خدمة - المدير',
        'heading_edit' => 'تعديل الخدمة',
        'heading_add' => 'إضافة خدمة جديدة',
        'label_title' => 'العنوان',
        'label_description' => 'الوصف',
        'label_icon' => 'فئة أيقونة Font Awesome',
        'label_order' => 'ترتيب العرض',
        'placeholder_icon' => 'مثال: fa-stethoscope',
        'preview' => 'معاينة:',
        'icon_note' => 'ابحث عن الأيقونات في <a href="https://fontawesome.com/icons" target="_blank">FontAwesome</a>. استخدم أسماء الفئات مثل "fa-heartbeat"، "fa-child"، إلخ.',
        'button_update' => 'تحديث',
        'button_create' => 'إنشاء',
        'button_cancel' => 'إلغاء',
        'error_title_required' => 'العنوان مطلوب.',
        'error_description_required' => 'الوصف مطلوب.',
        'error_icon_required' => 'فئة الأيقونة مطلوبة.',
        'back_link' => 'العودة للإدارة',  // Added missing key
    ]
];

$lang = $translations[$current_lang];

// Check login
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin.php?lang=' . $current_lang);
    exit;
}

$id = intval($_GET['id'] ?? 0);
$service = null;
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$service) {
        header('Location: admin.php?lang=' . $current_lang);
        exit;
    }
}

// Handle form submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $icon_class = trim($_POST['icon_class'] ?? '');
    $display_order = intval($_POST['display_order'] ?? 0);

    if (empty($title)) $errors[] = $lang['error_title_required'];
    if (empty($description)) $errors[] = $lang['error_description_required'];
    if (empty($icon_class)) $errors[] = $lang['error_icon_required'];

    if (empty($errors)) {
        if ($id > 0) {
            // Update
            $stmt = $pdo->prepare("UPDATE services SET title = ?, description = ?, icon_class = ?, display_order = ? WHERE id = ?");
            $stmt->execute([$title, $description, $icon_class, $display_order, $id]);
        } else {
            // Insert
            $stmt = $pdo->prepare("INSERT INTO services (title, description, icon_class, display_order) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $description, $icon_class, $display_order]);
        }
        header('Location: admin.php?lang=' . $current_lang);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $current_lang ?>" dir="<?= $current_lang == 'ar' ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? $lang['page_title_edit'] : $lang['page_title_add'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .cancel { background: #6c757d; color: white; padding: 14px 30px; border-radius: 50px; text-decoration: none; display: inline-block; }
        .error { color: #dc3545; margin-bottom: 15px; }
        .icon-preview { margin-top: 10px; font-size: 2rem; color: #0b6e4f; }
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

        <h1><?= $id ? $lang['heading_edit'] : $lang['heading_add'] ?></h1>
        <?php if (!empty($errors)): ?>
            <div class="error"><?= implode('<br>', $errors) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label><?= $lang['label_title'] ?></label>
                <input type="text" name="title" value="<?= htmlspecialchars($service['title'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label><?= $lang['label_description'] ?></label>
                <textarea name="description" rows="4" required><?= htmlspecialchars($service['description'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label><?= $lang['label_icon'] ?></label>
                <input type="text" name="icon_class" value="<?= htmlspecialchars($service['icon_class'] ?? '') ?>" placeholder="<?= $lang['placeholder_icon'] ?>" required>
                <div class="icon-preview">
                    <?= $lang['preview'] ?> <i class="fas <?= htmlspecialchars($service['icon_class'] ?? 'fa-stethoscope') ?>"></i>
                </div>
                <small><?= $lang['icon_note'] ?></small>
            </div>
            <div class="form-group">
                <label><?= $lang['label_order'] ?></label>
                <input type="number" name="display_order" value="<?= htmlspecialchars($service['display_order'] ?? '0') ?>" min="0">
            </div>
            <button type="submit"><?= $id ? $lang['button_update'] : $lang['button_create'] ?></button>
            <a href="admin.php?lang=<?= $current_lang ?>" class="cancel"><?= $lang['button_cancel'] ?></a>
        </form>
        <!-- Fixed back link with proper arrow direction -->
        <a href="admin.php?lang=<?= $current_lang ?>" class="back-link">
            <?php if ($current_lang == 'ar'): ?>
                <i class="fas fa-arrow-right"></i>
            <?php else: ?>
                <i class="fas fa-arrow-left"></i>
            <?php endif; ?>
            <?= $lang['back_link'] ?>
        </a>
    </div>
    <script>
        // Live icon preview
        const iconInput = document.querySelector('input[name="icon_class"]');
        const previewSpan = document.querySelector('.icon-preview i');
        iconInput.addEventListener('input', function() {
            previewSpan.className = 'fas ' + this.value;
        });
    </script>
    
</body>
</html>