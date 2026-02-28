<?php
session_start();

// Language handling
$languages = ['en', 'ar'];
$default_lang = 'en';

// Get language from URL, session, or default
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
        'hero_title' => 'Compassionate care, <span>close to home.</span>',
        'hero_desc' => 'Expert doctors, modern facilities, and a healing environment for you and your family.',
        'hero_btn_appointment' => 'Make an appointment',
        'hero_btn_learn' => 'Learn more',
        'services_title' => 'Our Medical Services',
        'services_subtitle' => 'Comprehensive healthcare under one roof',
        'doctors_title' => 'Meet Our Specialists',
        'doctors_subtitle' => 'Experienced doctors dedicated to your well-being',
        'contact_title' => 'Get in touch',
        'contact_subtitle' => "We're here to answer your questions",
        'contact_info_title' => 'Contact information',
        'contact_name_placeholder' => 'Full name',
        'contact_email_placeholder' => 'Email address',
        'contact_message_placeholder' => 'Your message...',
        'contact_send_btn' => 'Send message',
        'footer_tagline' => 'Your trusted partner in health.',
        'footer_quick_links' => 'Quick links',
        'footer_legal' => 'Legal',
        'footer_privacy' => 'Privacy policy',
        'footer_terms' => 'Terms of use',
        'footer_copyright' => '© 2026 MediCare+ Clinic. All rights reserved.',
        'no_services' => 'No services available at the moment. Please check back later.',
    ],
    'ar' => [
        'nav_home' => 'الرئيسية',
        'nav_services' => 'الخدمات',
        'nav_doctors' => 'الأطباء',
        'nav_contact' => 'اتصل بنا',
        'nav_book' => 'احجز الآن',
        'hero_title' => 'رعاية متعاطفة، <span>قريبة من المنزل.</span>',
        'hero_desc' => 'أطباء خبراء، مرافق حديثة، وبيئة علاجية لك ولعائلتك.',
        'hero_btn_appointment' => 'احجز موعدًا',
        'hero_btn_learn' => 'اعرف المزيد',
        'services_title' => 'خدماتنا الطبية',
        'services_subtitle' => 'رعاية صحية شاملة تحت سقف واحد',
        'doctors_title' => 'تعرف على أطبائنا',
        'doctors_subtitle' => 'أطباء ذوو خبرة مكرسون لراحتك',
        'contact_title' => 'تواصل معنا',
        'contact_subtitle' => 'نحن هنا للإجابة على أسئلتك',
        'contact_info_title' => 'معلومات الاتصال',
        'contact_name_placeholder' => 'الاسم الكامل',
        'contact_email_placeholder' => 'البريد الإلكتروني',
        'contact_message_placeholder' => 'رسالتك...',
        'contact_send_btn' => 'أرسل الرسالة',
        'footer_tagline' => 'شريكك الموثوق في الصحة.',
        'footer_quick_links' => 'روابط سريعة',
        'footer_legal' => 'قانوني',
        'footer_privacy' => 'سياسة الخصوصية',
        'footer_terms' => 'شروط الاستخدام',
        'footer_copyright' => '© 2026 عيادة ميديكير+. جميع الحقوق محفوظة.',
        'no_services' => 'لا توجد خدمات متاحة حاليًا. يرجى التحقق لاحقًا.',
    ]
];

$lang = $translations[$current_lang];
?>
<!DOCTYPE html>
<html lang="<?= $current_lang ?>" dir="<?= $current_lang == 'ar' ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare+ | Clinic Website</title>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Font: Poppins (for English) and Cairo/Tajawal for Arabic fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* Success/error message styling */
        .flash-message {
            padding: 15px 20px;
            border-radius: 50px;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 500;
        }
        .flash-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .flash-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
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
        /* RTL adjustments */
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
        [dir="rtl"] .hero-content h2 span {
            display: inline-block; /* Fix for RTL spans */
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
                <a href="index.php#home" class="active"><?= $lang['nav_home'] ?></a>
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
        <!-- HERO / HOME -->
        <section id="home" class="hero">
            <div class="container hero-grid">
                <div class="hero-content">
                    <h2><?= $lang['hero_title'] ?></h2>
                    <p><?= $lang['hero_desc'] ?></p>
                    <div class="hero-buttons">
                        <a href="appointment.php" class="btn-primary"><i class="fas fa-calendar-check" style="margin-right: 8px;"></i><?= $lang['hero_btn_appointment'] ?></a>
                        <a href="#services" class="btn-outline"><?= $lang['hero_btn_learn'] ?></a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="image5.jpg" alt="Modern clinic building illustration">
                </div>
            </div>
        </section>

        <!-- SERVICES SECTION -->
        <section id="services" class="container" style="padding: 70px 0;">
            <div class="section-title">
                <h3><?= $lang['services_title'] ?></h3>
                <p><?= $lang['services_subtitle'] ?></p>
            </div>
            <div class="services-grid">
                <?php
                // Fetch services from database
                require_once 'config.php';
                $stmt = $pdo->query("SELECT * FROM services ORDER BY display_order ASC");
                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($services) > 0):
                    foreach ($services as $service):
                ?>
                <div class="service-card">
                    <div class="service-icon"><i class="fas <?= htmlspecialchars($service['icon_class']) ?>"></i></div>
                    <h4><?= htmlspecialchars($service['title']) ?></h4>
                    <p><?= htmlspecialchars($service['description']) ?></p>
                </div>
                <?php
                    endforeach;
                else:
                ?>
                <p><?= $lang['no_services'] ?></p>
                <?php endif; ?>
            </div>
        </section>

        <!-- DOCTORS SECTION -->
        <section id="doctors" class="doctors-section">
            <div class="container">
                <div class="section-title">
                    <h3><?= $lang['doctors_title'] ?></h3>
                    <p><?= $lang['doctors_subtitle'] ?></p>
                </div>
                <div class="doctors-grid">
                    <div class="doctor-card">
                        <img src="imag1.jpeg" alt="Doctor Sarah">
                        <h4>Dr. Zaker Chen</h4>
                        <div class="specialty">Cardiologist</div>
                        <p>15+ years experience in interventional cardiology.</p>
                        <div class="social-icons">
                            <a href="https://in.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="doctor-card">
                        <img src="image2.jpg" alt="Doctor James">
                        <h4>Dr. James Okonkwo</h4>
                        <div class="specialty">Pediatrician</div>
                        <p>Passionate about child health and development.</p>
                        <div class="social-icons">
                            <a href="https://in.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="doctor-card">
                        <img src="image3.jpg" alt="Doctor Maria">
                        <h4>Dr. Maike Garcia</h4>
                        <div class="specialty">Orthopedic surgeon</div>
                        <p>Specializes in minimally invasive procedures.</p>
                        <div class="social-icons">
                            <a href="https://in.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTACT SECTION -->
        <section id="contact" class="contact-section">
            <div class="container">
                <div class="section-title">
                    <h3><?= $lang['contact_title'] ?></h3>
                    <p><?= $lang['contact_subtitle'] ?></p>
                </div>

                <!-- Display flash messages -->
                <?php if (isset($_GET['contact']) && $_GET['contact'] == 'success'): ?>
                    <div class="flash-message flash-success">Thank you! Your message has been sent.</div>
                <?php elseif (isset($_GET['contact']) && $_GET['contact'] == 'error'): ?>
                    <div class="flash-message flash-error">Sorry, something went wrong. Please try again later.</div>
                <?php endif; ?>

                <div class="contact-grid">
                    <div class="contact-info">
                        <h4><?= $lang['contact_info_title'] ?></h4>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>123 Wellness Avenue, Medical District, NY 10001</p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone-alt"></i>
                            <p>+1 (555) 234-5678</p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <p>care@medicareplus.com</p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <p>Mon-Fri: 8am - 8pm | Sat: 9am - 2pm</p>
                        </div>
                    </div>
                    <form class="contact-form" action="contact.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="full_name" placeholder="<?= $lang['contact_name_placeholder'] ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="<?= $lang['contact_email_placeholder'] ?>" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="5" placeholder="<?= $lang['contact_message_placeholder'] ?>" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn"><?= $lang['contact_send_btn'] ?></button>
                    </form>
                </div>
            </div>
        </section>
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
                        <li><a href="index.php#home"><?= $lang['nav_home'] ?></a></li>
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

    <!-- External JavaScript -->
    <script src="script.js"></script>
</body>
</html>