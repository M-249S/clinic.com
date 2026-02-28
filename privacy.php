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
        // Navigation
        'nav_home' => 'Home',
        'nav_services' => 'Services',
        'nav_doctors' => 'Doctors',
        'nav_contact' => 'Contact',
        'nav_book' => 'Book now',
        // Page title
        'page_title' => 'Privacy Policy - MediCare+',
        // Main content
        'heading' => 'Privacy Policy',
        'last_updated' => 'Last updated: January 2025',
        'section1_title' => '1. Information We Collect',
        'section1_text' => 'We collect personal information you provide to us when you use our website, book appointments, or contact us. This may include your name, email address, phone number, and any other information you choose to provide.',
        'section2_title' => '2. How We Use Your Information',
        'section2_text' => 'We use your information to:',
        'section2_list_item1' => 'Provide and manage your appointments',
        'section2_list_item2' => 'Communicate with you about your healthcare needs',
        'section2_list_item3' => 'Improve our website and services',
        'section2_list_item4' => 'Comply with legal obligations',
        'section3_title' => '3. Sharing Your Information',
        'section3_text' => 'We do not sell or rent your personal information. We may share it with healthcare providers directly involved in your care, or as required by law.',
        'section4_title' => '4. Data Security',
        'section4_text' => 'We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, or destruction.',
        'section5_title' => '5. Your Rights',
        'section5_text' => 'You have the right to access, correct, or delete your personal information. To exercise these rights, please contact us at privacy@medicareplus.com.',
        'section6_title' => '6. Changes to This Policy',
        'section6_text' => 'We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page.',
        'back_link' => 'Back to Home',
        // Footer
        'footer_tagline' => 'Your trusted partner in health.',
        'footer_quick_links' => 'Quick links',
        'footer_legal' => 'Legal',
        'footer_privacy' => 'Privacy policy',
        'footer_terms' => 'Terms of use',
        'footer_copyright' => '© 2025 MediCare+ Clinic. All rights reserved.',
    ],
    'ar' => [
        // Navigation
        'nav_home' => 'الرئيسية',
        'nav_services' => 'الخدمات',
        'nav_doctors' => 'الأطباء',
        'nav_contact' => 'اتصل بنا',
        'nav_book' => 'احجز الآن',
        // Page title
        'page_title' => 'سياسة الخصوصية - ميديكير+',
        // Main content
        'heading' => 'سياسة الخصوصية',
        'last_updated' => 'آخر تحديث: يناير 2025',
        'section1_title' => '١. المعلومات التي نجمعها',
        'section1_text' => 'نحن نجمع المعلومات الشخصية التي تقدمها لنا عند استخدام موقعنا الإلكتروني أو حجز المواعيد أو الاتصال بنا. قد يشمل ذلك اسمك وعنوان بريدك الإلكتروني ورقم هاتفك وأي معلومات أخرى تختار تقديمها.',
        'section2_title' => '٢. كيف نستخدم معلوماتك',
        'section2_text' => 'نستخدم معلوماتك من أجل:',
        'section2_list_item1' => 'توفير وإدارة مواعيدك',
        'section2_list_item2' => 'التواصل معك بخصوص احتياجاتك الصحية',
        'section2_list_item3' => 'تحسين موقعنا الإلكتروني وخدماتنا',
        'section2_list_item4' => 'الامتثال للالتزامات القانونية',
        'section3_title' => '٣. مشاركة معلوماتك',
        'section3_text' => 'نحن لا نبيع أو نؤجر معلوماتك الشخصية. قد نشاركها مع مقدمي الرعاية الصحية المشاركين مباشرة في رعايتك، أو حسبما يقتضي القانون.',
        'section4_title' => '٤. أمن البيانات',
        'section4_text' => 'نحن نطبق التدابير التقنية والتنظيمية المناسبة لحماية معلوماتك الشخصية من الوصول غير المصرح به أو التغيير أو التدمير.',
        'section5_title' => '٥. حقوقك',
        'section5_text' => 'لديك الحق في الوصول إلى معلوماتك الشخصية أو تصحيحها أو حذفها. لممارسة هذه الحقوق، يرجى الاتصال بنا على privacy@medicareplus.com.',
        'section6_title' => '٦. تغييرات هذه السياسة',
        'section6_text' => 'قد نقوم بتحديث سياسة الخصوصية هذه من وقت لآخر. سنخطرك بأي تغييرات عن طريق نشر السياسة الجديدة على هذه الصفحة.',
        'back_link' => 'العودة إلى الرئيسية',
        // Footer
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Font: Poppins (English) + Cairo (Arabic) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Main CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        .policy-container {
            max-width: 800px;
            margin: 60px auto;
            background: white;
            padding: 50px;
            border-radius: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.02);
        }
        .policy-container h1 {
            color: #1e3b3a;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .policy-container h2 {
            color: #0b6e4f;
            font-size: 1.8rem;
            margin: 30px 0 15px;
        }
        .policy-container p {
            color: #4a6365;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .policy-container ul {
            margin-left: 20px;
            margin-bottom: 20px;
            color: #4a6365;
        }
        .policy-container li {
            margin-bottom: 8px;
        }
        .back-home {
            display: inline-block;
            margin-top: 30px;
            color: #0b6e4f;
            text-decoration: none;
        }
        /* Language switcher styles */
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
        [dir="rtl"] .header-flex {
            flex-direction: row-reverse;
        }
        [dir="rtl"] .nav-menu {
            margin-right: auto;
            margin-left: 0;
        }
        [dir="rtl"] .lang-switcher {
            margin-left: 0;
            margin-right: 20px;
        }
        [dir="rtl"] .policy-container ul {
            margin-right: 20px;
            margin-left: 0;
        }
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
            <div class="policy-container">
                <h1><?= $lang['heading'] ?></h1>
                <p><?= $lang['last_updated'] ?></p>

                <h2><?= $lang['section1_title'] ?></h2>
                <p><?= $lang['section1_text'] ?></p>

                <h2><?= $lang['section2_title'] ?></h2>
                <p><?= $lang['section2_text'] ?></p>
                <ul>
                    <li><?= $lang['section2_list_item1'] ?></li>
                    <li><?= $lang['section2_list_item2'] ?></li>
                    <li><?= $lang['section2_list_item3'] ?></li>
                    <li><?= $lang['section2_list_item4'] ?></li>
                </ul>

                <h2><?= $lang['section3_title'] ?></h2>
                <p><?= $lang['section3_text'] ?></p>

                <h2><?= $lang['section4_title'] ?></h2>
                <p><?= $lang['section4_text'] ?></p>

                <h2><?= $lang['section5_title'] ?></h2>
                <p><?= $lang['section5_text'] ?></p>

                <h2><?= $lang['section6_title'] ?></h2>
                <p><?= $lang['section6_text'] ?></p>

                <a href="index.php" class="back-home"><i class="fas fa-arrow-left"></i> <?= $lang['back_link'] ?></a>
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