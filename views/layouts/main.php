<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Монохромная тема для всего сайта */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #f0f0f0 100%);
            min-height: 100vh;
        }

        /* Монохромный навбар */
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
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: -1;
        }

        .navbar-nav .nav-link:hover::before {
            width: 200px;
            height: 200px;
        }

        .navbar-nav .nav-link:hover {
            color: #000000 !important;
            background: rgba(0, 0, 0, 0.02);
            transform: translateY(-1px);
        }

        /* Активные ссылки */
        .navbar-nav .nav-item.active .nav-link {
            background: linear-gradient(135deg, #000000, #333333);
            color: white !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Бейдж для админки */
        .admin-badge {
            position: relative;
        }

        .admin-badge::after {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 10px;
            filter: grayscale(100%);
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.75rem 0;
            }

            .navbar-nav {
                padding-top: 1rem;
            }

            .navbar-nav .nav-link {
                margin: 2px 0;
            }

            .navbar-brand {
                font-size: 1.3rem;
                padding-left: 32px;
            }
        }

        /* Основной контейнер */
        .main-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 2rem 1rem;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Монохромные кнопки */
        .btn-custom {
            background: linear-gradient(135deg, #000000 0%, #333333 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #333333 0%, #555555 100%);
            color: white;
        }

        .btn-custom-outline {
            background: white;
            color: #333333;
            border: 1.5px solid #d4d4d4;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .btn-custom-outline:hover {
            background: #f5f5f5;
            border-color: #333333;
            color: #000000;
        }

        /* Улучшенные формы */
        .form-control:focus {
            border-color: #333333;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        /* Монохромные карточки */
        .card-custom {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        /* Кастомный скроллбар */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #c4c4c4, #a5a5a5);
            border-radius: 10px;
            border: 2px solid #f0f0f0;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #a5a5a5, #858585);
        }

        /* Подвал */
        .footer {
            margin-top: 4rem;
            padding: 2rem 0;
            border-top: 1px solid #d4d4d4;
            color: #666666;
            font-size: 0.9rem;
            text-align: center;
            background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        }

        .footer a {
            color: #333333;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #000000;
            text-decoration: underline;
        }

        /* Анимации для загрузки */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .slide-in {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Иконки в навбаре */
        .nav-icon {
            display: inline-block;
            width: 18px;
            height: 18px;
            margin-right: 6px;
            filter: grayscale(100%);
            opacity: 0.7;
            vertical-align: text-bottom;
        }

        .navbar-nav .nav-link:hover .nav-icon {
            opacity: 1;
            filter: brightness(0);
        }

        /* Мобильное меню */
        .navbar-toggler {
            border: 1px solid #d4d4d4;
            padding: 4px 8px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        }

        /* Отступы для контента */
        .content-wrapper {
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e5e5;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03);
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }

            .main-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="<?= Url::home() ?>">
            <span>Incident Tracker</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['site/login']) ?>">
                            Вход
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['site/register']) ?>">
                            Регистрация
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['incident/index']) ?>">
                            Личный кабинет
                        </a>
                    </li>


                    <?php if (Yii::$app->user->identity->isAdmin()): ?>
                        <li class="nav-item admin-badge">
                            <a class="nav-link" href="<?= Url::to(['admin/index']) ?>">
                                Админ
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['site/logout']) ?>" data-method="post">
                           Выход
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="main-container">
    <div class="content-wrapper fade-in">
        <?= $content ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Анимация активного пункта меню
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.parentElement.classList.add('active');
            }
        });

        // Плавное появление элементов
        const fadeElements = document.querySelectorAll('.fade-in');
        fadeElements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
        });

        // Подсветка навбара при скролле
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 4px 25px rgba(0, 0, 0, 0.08)';
            } else {
                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.05)';
            }
        });
    });

    // Обработка подтверждения выхода
    document.addEventListener('click', function(e) {
        if (e.target.closest('a[href*="logout"]')) {
            if (!confirm('Вы уверены, что хотите выйти?')) {
                e.preventDefault();
            }
        }
    });
</script>
</body>
</html>