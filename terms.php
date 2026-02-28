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
        // Page
        'page_title' => 'Terms of Use - MediCare+',
        'heading' => 'Terms of Use',
        'last_updated' => 'Last updated: January 2025',
        'section1_title' => '1. Acceptance of Terms',
        'section1_text' => 'By accessing or using the MediCare+ website, you agree to be bound by these Terms of Use. If you do not agree, please do not use our site.',
        'section2_title' => '2. Medical Disclaimer',
        'section2_text' => 'The information provided on this website is for general informational purposes only and is not a substitute for professional medical advice. Always consult a qualified healthcare provider for any medical concerns.',
        'section3_title' => '3. Appointment Booking',
        'section3_text' => 'Booking an appointment through our site does not guarantee immediate availability. We will contact you to confirm your appointment. MediCare+ reserves the right to cancel or reschedule appointments.',
        'section4_title' => '4. User Responsibilities',
        'section4_text' => 'You agree to provide accurate and complete information when using our services. You are responsible for maintaining the confidentiality of any account credentials.',
        'section5_title' => '5. Intellectual Property',
        'section5_text' => 'All content on this website (text, graphics, logos, images) is the property of MediCare+ and protected by copyright laws. You may not reproduce, distribute, or modify any content without written permission.',
        'section6_title' => '6. Limitation of Liability',
        'section6_text' => 'MediCare+ shall not be liable for any damages arising from your use of this website or inability to book an appointment.',
        'section7_title' => '7. Changes to Terms',
        'section7_text' => 'We may revise these terms at any time. Continued use of the site constitutes acceptance of the updated terms.',
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
        // Page
        'page_title' => 'شروط الاستخدام - ميديكير+',
        'heading' => 'شروط الاستخدام',
        'last_updated' => 'آخر تحديث: يناير 2025',
        'section1_title' => '١. قبول الشروط',
        'section1_text' => 'باستخدامك لموقع ميديكير+، فإنك توافق على الالتزام بشروط الاستخدام هذه. إذا كنت لا توافق، يرجى عدم استخدام موقعنا.',
        'section2_title' => '٢. إخلاء المسؤولية الطبية',
        'section2_text' => 'المعلومات المقدمة على هذا الموقع هي لأغراض إعلامية عامة فقط وليست بديلاً عن الاستشارة الطبية المهنية. استشر دائمًا مقدم رعاية صحية مؤهل لأي مخاوف طبية.',
        'section3_title' => '٣. حجز المواعيد',
        'section3_text' => 'حجز موعد من خلال موقعنا لا يضمن التوفر الفوري. سنتصل بك لتأكيد موعدك. يحتفظ ميديكير+ بالحق في إلغاء أو إعادة جدولة المواعيد.',
        'section4_title' => '٤. مسؤوليات المستخدم',
        'section4_text' => 'أنت توافق على تقديم معلومات دقيقة وكاملة عند استخدام خدماتنا. أنت مسؤول عن الحفاظ على سرية أي بيانات اعتماد للحساب.',
        'section5_title' => '٥. الملكية الفكرية',
        'section5_text' => 'جميع المحتويات على هذا الموقع (النصوص والرسومات والشعارات والصور) هي ملك لميديكير+ ومحمية بموجب قوانين حقوق النشر. لا يجوز لك إعادة إنتاج أو توزيع أو تعديل أي محتوى دون إذن كتابي.',
        'section6_title' => '٦. تحديد المسؤولية',
        'section6_text' => 'ميديكير+ لن يكون مسؤولاً عن أي أضرار ناشئة عن استخدامك لهذا الموقع أو عدم القدرة على حجز موعد.',
        'section7_title' => '٧. تغييرات الشروط',
        'section7_text' => 'قد نراجع هذه الشروط في أي وقت. الاستمرار في استخدام الموقع يشكل قبولاً للشروط المحدثة.',
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .terms-container {
            max-width: 800px;
            margin: 60px auto;
            background: white;
            padding: 50px;
            border-radius: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.02);
        }
        .terms-container h1 {
            color: #1e3b3a;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .terms-container h2 {
            color: #0b6e4f;
            font-size: 1.8rem;
            margin: 30px 0 15px;
        }
        .terms-container p {
            color: #4a6365;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .back-home {
            display: inline-block;
            margin-top: 30px;
            color: #0b6e4f;
            text-decoration: none;
        }
        /* Language switcher (same as before) */
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
            <div class="terms-container">
                <h1><?= $lang['heading'] ?></h1>
                <p><?= $lang['last_updated'] ?></p>

                <h2><?= $lang['section1_title'] ?></h2>
                <p><?= $lang['section1_text'] ?></p>

                <h2><?= $lang['section2_title'] ?></h2>
                <p><?= $lang['section2_text'] ?></p>

                <h2><?= $lang['section3_title'] ?></h2>
                <p><?= $lang['section3_text'] ?></p>

                <h2><?= $lang['section4_title'] ?></h2>
                <p><?= $lang['section4_text'] ?></p>

                <h2><?= $lang['section5_title'] ?></h2>
                <p><?= $lang['section5_text'] ?></p>

                <h2><?= $lang['section6_title'] ?></h2>
                <p><?= $lang['section6_text'] ?></p>

                <h2><?= $lang['section7_title'] ?></h2>
                <p><?= $lang['section7_text'] ?></p>

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