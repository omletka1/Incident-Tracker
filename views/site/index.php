<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Tracker - Главная</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #f0f0f0 100%);
            min-height: 100vh;
            color: #333333;
        }

        .navbar {
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            border-bottom: 1px solid #d4d4d4;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #000000 !important;
            letter-spacing: -0.025em;
            position: relative;
            padding-left: 40px;
        }

        .navbar-brand::before {
            position: absolute;
            left: 0;
            font-size: 1.3rem;
            filter: grayscale(100%);
        }

        .navbar-nav .nav-link {
            color: #444444 !important;
            font-weight: 500;
            padding: 8px 16px;
            margin: 0 4px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #000000 !important;
            background: rgba(0, 0, 0, 0.02);
            transform: translateY(-1px);
        }

        .hero-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            border-bottom: 1px solid #d4d4d4;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                    radial-gradient(circle at 20% 80%, rgba(0,0,0,0.03) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(0,0,0,0.03) 0%, transparent 50%);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #000000;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            letter-spacing: -0.025em;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #666666;
            margin-bottom: 2rem;
            line-height: 1.6;
            max-width: 600px;
        }

        .btn-custom {
            background: linear-gradient(135deg, #000000 0%, #333333 100%);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #333333 0%, #555555 100%);
            color: white;
        }

        .btn-custom-outline {
            background: white;
            color: #333333;
            border: 1.5px solid #d4d4d4;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .btn-custom-outline:hover {
            background: #f5f5f5;
            border-color: #333333;
            color: #000000;
        }

        .features-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #000000;
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #333333, #666666);
            border-radius: 1.5px;
        }

        .feature-card {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 15px;
            padding: 40px 30px;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #333333, #666666);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            filter: grayscale(100%);
            opacity: 0.9;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #000000;
            margin-bottom: 1rem;
        }

        .feature-text {
            color: #666666;
            line-height: 1.6;
        }

        .stats-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            border-top: 1px solid #d4d4d4;
            border-bottom: 1px solid #d4d4d4;
        }

        .stat-card {
            text-align: center;
            padding: 30px 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: #000000;
            margin-bottom: 0.5rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .stat-label {
            font-size: 1rem;
            color: #666666;
            font-weight: 500;
        }

        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #000000 0%, #333333 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                    radial-gradient(circle at 30% 30%, rgba(255,255,255,0.05) 0%, transparent 50%),
                    radial-gradient(circle at 70% 70%, rgba(255,255,255,0.05) 0%, transparent 50%);
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
        }

        .cta-text {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .cta-btn {
            background: white;
            color: #000000;
            border: none;
            padding: 16px 40px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .cta-btn:hover {
            background: #f5f5f5;
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            color: #000000;
        }


        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
            }

            .features-section,
            .stats-section,
            .cta-section {
                padding: 60px 0;
            }

            .feature-card {
                margin-bottom: 30px;
            }
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .text-gradient {
            background: linear-gradient(135deg, #000000, #333333);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body>


<section class="hero-section">
    <div class="container-custom">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title fade-in-up">
                    Управляйте инцидентами <span class="text-gradient">эффективно</span>
                </h1>
                <p class="hero-subtitle fade-in-up">
                    Современная система отслеживания и управления инцидентами.

                </p>
                <div class="fade-in-up">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="<?= Url::to(['site/register']) ?>" class="btn btn-custom me-3">
                            Начать бесплатно
                        </a>
                        <a href="#features" class="btn btn-custom-outline">
                            Узнать больше
                        </a>
                    <?php else: ?>
                        <a href="<?= Url::to(['incident/index']) ?>" class="btn btn-custom me-3">
                            Перейти в кабинет
                        </a>

                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="position-relative floating">
                    <div class="feature-card p-4" style="max-width: 500px; margin: 0 auto;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="feature-icon" style="font-size: 2rem;">📊</div>
                                <h4 class="feature-title mb-0 ms-2">Активные инциденты</h4>
                            </div>
                            <span class="badge bg-dark"><?= $activeIncidents ?></span>
                        </div>

                        <!-- Высокий приоритет -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Высокий приоритет</span>
                                <span><?= $highPriority ?></span>
                            </div>
                            <div class="progress" style="height: 6px; background: #e5e5e5;">
                                <div class="progress-bar bg-dark" style="width: <?= $highPriorityPercent ?>%"></div>
                            </div>
                        </div>

                        <!-- В работе -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>В работе</span>
                                <span><?= $inWork ?></span>
                            </div>
                            <div class="progress" style="height: 6px; background: #e5e5e5;">
                                <div class="progress-bar bg-secondary" style="width: <?= $inWorkPercent ?>%"></div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <small class="text-muted">Обновлено только что</small>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<section id="features" class="features-section">
    <div class="container-custom">
        <h2 class="section-title fade-in-up">Возможности системы</h2>
        <div class="row g-4">
            <div class="col-md-4 fade-in-up">
                <div class="feature-card">
                    <div class="feature-icon">📋</div>
                    <h3 class="feature-title">Управление инцидентами</h3>
                    <p class="feature-text">
                        Создавайте, отслеживайте и управляйте инцидентами в единой системе.
                    </p>
                </div>
            </div>
            <div class="col-md-4 fade-in-up">
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3 class="feature-title">Командная работа</h3>
                    <p class="feature-text">
                        Работайте вместе над решением проблем.
                    </p>
                </div>
            </div>
            <div class="col-md-4 fade-in-up">
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-title">Быстрое реагирование</h3>
                    <p class="feature-text">
                        Оперативно реагируйте на критические ситуации.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container-custom">
        <h2 class="cta-title fade-in-up">Готовы начать работу?</h2>
        <p class="cta-text fade-in-up">
            Присоединяйтесь к тысячам команд, которые уже используют наш Incident Tracker
            для эффективного управления инцидентами и улучшения рабочих процессов.
        </p>
        <div class="fade-in-up">
            <?php if (Yii::$app->user->isGuest): ?>
                <a href="<?= Url::to(['site/register']) ?>" class="btn cta-btn">
                    Зарегистрироваться бесплатно
                </a>
            <?php else: ?>
                <a href="<?= Url::to(['incident/create']) ?>" class="btn cta-btn">
                    Создать новый инцидент
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        const yearElement = document.querySelector('.footer-bottom p');
        if (yearElement) {
            yearElement.innerHTML = yearElement.innerHTML.replace('<?= date('Y') ?>', new Date().getFullYear());
        }

        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.parentElement.classList.add('active');
                link.style.background = 'rgba(0,0,0,0.1)';
            }
        });
    });

    window.addEventListener('scroll', function() {
        const heroSection = document.querySelector('.hero-section');
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;

        if (heroSection) {
            heroSection.style.backgroundPosition = 'center ' + (rate + 50) + 'px';
        }

        const navbar = document.querySelector('.navbar');
        if (scrolled > 50) {
            navbar.style.boxShadow = '0 4px 25px rgba(0, 0, 0, 0.1)';
            navbar.style.background = 'rgba(255, 255, 255, 0.95)';
        } else {
            navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.05)';
            navbar.style.background = 'linear-gradient(135deg, #ffffff 0%, #fafafa 100%)';
        }
    });
</script>
</body>
</html>