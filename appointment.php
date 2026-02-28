<?php
session_start();

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
        'nav_home' => 'Home',
        'nav_services' => 'Services',
        'nav_doctors' => 'Doctors',
        'nav_contact' => 'Contact',
        'nav_book' => 'Book now',
        'page_title' => 'Book Appointment - MediCare+',
        'heading' => 'Book an appointment',
        'subheading' => 'Fill in your details and we\'ll confirm your visit.',
        'success_message' => 'Appointment request sent! We\'ll contact you shortly.',
        'error_message' => 'Something went wrong. Please try again.',
        'label_name' => 'Full name',
        'label_email' => 'Email address',
        'label_phone' => 'Phone number',
        'label_date' => 'Preferred date',
        'label_department' => 'Department',
        'label_notes' => 'Additional notes',
        'submit_btn' => 'Request appointment',
        'back_link' => 'Back to Home',
        'footer_tagline' => 'Your trusted partner in health.',
        'footer_quick_links' => 'Quick links',
        'footer_legal' => 'Legal',
        'footer_privacy' => 'Privacy policy',
        'footer_terms' => 'Terms of use',
        'footer_copyright' => '© 2025 MediCare+ Clinic. All rights reserved.',
    ],
    'ar' => [
        'nav_home' => 'الرئيسية',
        'nav_services' => 'الخدمات',
        'nav_doctors' => 'الأطباء',
        'nav_contact' => 'اتصل بنا',
        'nav_book' => 'احجز الآن',
        'page_title' => 'حجز موعد - ميديكير+',
        'heading' => 'احجز موعدًا',
        'subheading' => 'املأ التفاصيل وسنؤكد زيارتك.',
        'success_message' => 'تم إرسال طلب الموعد! سنتصل بك قريبًا.',
        'error_message' => 'حدث خطأ. حاول مرة أخرى.',
        'label_name' => 'الاسم الكامل',
        'label_email' => 'البريد الإلكتروني',
        'label_phone' => 'رقم الهاتف',
        'label_date' => 'التاريخ المفضل',
        'label_department' => 'القسم',
        'label_notes' => 'ملاحظات إضافية',
        'submit_btn' => 'طلب موعد',
        'back_link' => 'العودة للرئيسية',
        'footer_tagline' => 'شريكك الموثوق في الصحة.',
        'footer_quick_links' => 'روابط سريعة',
        'footer_legal' => 'قانوني',
        'footer_privacy' => 'سياسة الخصوصية',
        'footer_terms' => 'شروط الاستخدام',
        'footer_copyright' => '© 2025 عيادة ميديكير+. جميع الحقوق محفوظة.',
    ]
];

$lang = $translations[$current_lang];
?>
<!DOCTYPE html>
<html lang="<?= $current_lang ?>" dir="<?= $current_lang == 'ar' ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang['page_title'] ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* (same styles as before plus language switcher) */
        .appointment-form-container { max-width: 700px; margin: 50px auto; background: white; padding: 40px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.03); }
        .appointment-form-container h2 { color: #1e3b3a; font-size: 2.2rem; margin-bottom: 10px; }
        .appointment-form-container p { color: #5a7778; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #1e3b3a; font-weight: 500; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 14px 20px; border: 1.5px solid #cde3dd; border-radius: 50px; font-size: 1rem; outline: none; transition: 0.2s; background: #fafefc; }
        .form-group textarea { border-radius: 30px; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #0b6e4f; box-shadow: 0 0 0 3px rgba(11,110,79,0.1); }
        .submit-btn { background: #0b6e4f; color: white; border: none; padding: 16px 28px; border-radius: 60px; font-weight: 600; font-size: 1.2rem; cursor: pointer; transition: 0.2s; width: 100%; }
        .submit-btn:hover { background: #095a40; }
        .back-link { display: inline-block; margin-top: 20px; color: #0b6e4f; text-decoration: none; }
        .flash-message { padding: 15px 20px; border-radius: 50px; margin-bottom: 30px; text-align: center; font-weight: 500; }
        .flash-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .flash-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        /* Language switcher styles */
        .lang-switcher { display: flex; gap: 10px; margin-left: 20px; }
        .lang-switcher a { text-decoration: none; padding: 5px 10px; border-radius: 20px; font-weight: 500; transition: 0.2s; color: #2f3e46; background: #e2f1ec; }
        .lang-switcher a.active { background: #0b6e4f; color: white; }
        [dir="rtl"] .header-flex { flex-direction: row-reverse; }
        [dir="rtl"] .nav-menu { margin-right: auto; margin-left: 0; }
        [dir="rtl"] .lang-switcher { margin-left: 0; margin-right: 20px; }
    </style>
</head>
<body>
    <header>
        <div class="container header-flex">
            <div class="logo">
                <h1>MediCare<span>+</span></h1>
            </div>
            <nav class="nav-menu" id="navMenu">
                <a href="index.php"><?= $lang['nav_home'] ?></a>
                <a href="index.php#services"><?= $lang['nav_services'] ?></a>
                <a href="index.php#doctors"><?= $lang['nav_doctors'] ?></a>
                <a href="index.php#contact"><?= $lang['nav_contact'] ?></a>
                <a href="appointment.php" class="appointment-btn"><?= $lang['nav_book'] ?></a>
            </nav>
            <div class="lang-switcher">
                <a href="?lang=en" class="<?= $current_lang == 'en' ? 'active' : '' ?>">English</a>
                <a href="?lang=ar" class="<?= $current_lang == 'ar' ? 'active' : '' ?>">العربية</a>
            </div>
            <div class="hamburger" id="hamburgerBtn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="appointment-form-container">
                <h2><?= $lang['heading'] ?></h2>
                <p><?= $lang['subheading'] ?></p>

                <?php if (isset($_GET['success'])): ?>
                    <div class="flash-message flash-success"><?= $lang['success_message'] ?></div>
                <?php elseif (isset($_GET['error'])): ?>
                    <div class="flash-message flash-error"><?= $lang['error_message'] ?></div>
                <?php endif; ?>

                <form action="book-appointment.php" method="POST">
                    <div class="form-group">
                        <label><?= $lang['label_name'] ?></label>
                        <input type="text" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label><?= $lang['label_email'] ?></label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label><?= $lang['label_phone'] ?></label>
                        <input type="tel" name="phone">
                    </div>
                    <div class="form-group">
                        <label><?= $lang['label_date'] ?></label>
                        <input type="date" name="appointment_date" required>
                    </div>
                    <div class="form-group">
                        <label><?= $lang['label_department'] ?></label>
                        <select name="department">
                            <option value="General checkup">General checkup</option>
                            <option value="Cardiology">Cardiology</option>
                            <option value="Pediatrics">Pediatrics</option>
                            <option value="Orthopedics">Orthopedics</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?= $lang['label_notes'] ?></label>
                        <textarea name="message" rows="4" placeholder="Any specific concerns..."></textarea>
                    </div>
                    <button type="submit" class="submit-btn"><?= $lang['submit_btn'] ?></button>
                </form>
                <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> <?= $lang['back_link'] ?></a>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h5>MediCare+</h5>
                    <p><?= $lang['footer_tagline'] ?></p>
                </div>
                <div class="footer-col">
                    <h5><?= $lang['footer_quick_links'] ?></h5>
                    <ul>
                        <li><a href="index.php"><?= $lang['nav_home'] ?></a></li>
                        <li><a href="index.php#services"><?= $lang['nav_services'] ?></a></li>
                        <li><a href="index.php#doctors"><?= $lang['nav_doctors'] ?></a></li>
                        <li><a href="index.php#contact"><?= $lang['nav_contact'] ?></a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5><?= $lang['footer_legal'] ?></h5>
                    <ul>
                        <li><a href="privacy.php"><?= $lang['footer_privacy'] ?></a></li>
                        <li><a href="terms.php"><?= $lang['footer_terms'] ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p><?= $lang['footer_copyright'] ?></p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>