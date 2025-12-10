<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Админ-панель';
?>

<style>
    .interface-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 48px 32px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: linear-gradient(135deg, #f5f5f5 0%, #f0f0f0 100%);
        min-height: 100vh;
        color: #333333;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideIn {
        from { transform: translateX(-20px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .fade-in-up {
        animation: fadeIn 0.8s ease-out forwards;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 48px;
        padding: 0 8px;
        animation: fadeIn 0.6s ease-out;
    }

    .page-title-section {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .page-title {
        font-size: 40px;
        font-weight: 800;
        color: #000000;
        letter-spacing: -0.025em;
        margin: 0;
        position: relative;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
        border-radius: 2px;
    }

    .page-subtitle {
        font-size: 16px;
        color: #666666;
        font-weight: 400;
        margin: 0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
        background: white;
        padding: 12px 20px;
        border-radius: 10px;
        border: 1px solid #d4d4d4;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        animation: fadeIn 0.5s ease-out;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #000000, #333333);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .user-name {
        font-weight: 600;
        color: #000000;
        font-size: 14px;
    }

    .user-role {
        font-size: 12px;
        color: #666666;
        background: #f5f5f5;
        padding: 2px 8px;
        border-radius: 10px;
        display: inline-block;
        border: 1px solid #d4d4d4;
    }

    .admin-welcome {
        background: white;
        border-radius: 15px;
        padding: 48px;
        margin-bottom: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e5e5;
        animation: slideIn 0.5s ease-out;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .admin-welcome::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
    }

    .admin-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 24px;
        display: block;
        opacity: 0.5;
        filter: grayscale(100%);
        animation: float 3s ease-in-out infinite;
    }

    .welcome-title {
        font-size: 28px;
        font-weight: 700;
        color: #000000;
        margin: 0 0 16px 0;
    }

    .welcome-text {
        font-size: 16px;
        color: #666666;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto 32px;
    }

    .admin-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        max-width: 800px;
        margin: 0 auto;
    }

    .stat-card {
        background: #f5f5f5;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #d4d4d4;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #666666, #333333);
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: left;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border-color: #333333;
        background: #f0f0f0;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #000000;
        margin-bottom: 8px;
        font-family: 'JetBrains Mono', monospace;
    }

    .stat-label {
        font-size: 14px;
        color: #666666;
        font-weight: 500;
    }

    .admin-functions {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e5e5;
        animation: fadeIn 0.7s ease-out;
        position: relative;
        overflow: hidden;
    }

    .admin-functions::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #666666, #333333);
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #000000;
        margin: 0 0 32px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(180deg, #333333, #666666);
        border-radius: 2px;
    }

    .functions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }

    .function-card {
        background: #f5f5f5;
        border-radius: 12px;
        padding: 32px;
        border: 1px solid #d4d4d4;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: block;
        position: relative;
        overflow: hidden;
    }

    .function-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #333333, #666666);
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: left;
    }

    .function-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        background: white;
        border-color: #333333;
    }

    .function-card:hover::before {
        transform: scaleX(1);
    }

    .function-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #000000, #333333);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        filter: grayscale(100%);
    }

    .function-card:hover .function-icon {
        background: linear-gradient(135deg, #333333, #555555);
        transform: scale(1.1);
    }

    .function-icon svg {
        width: 28px;
        height: 28px;
        stroke: white;
        filter: grayscale(100%);
    }

    .function-title {
        font-size: 18px;
        font-weight: 700;
        color: #000000;
        margin: 0 0 12px 0;
        transition: color 0.3s ease;
    }

    .function-card:hover .function-title {
        color: #333333;
    }

    .function-description {
        font-size: 14px;
        color: #666666;
        line-height: 1.6;
        margin: 0;
    }

    .quick-actions {
        display: flex;
        gap: 16px;
        margin-top: 32px;
        padding-top: 32px;
        border-top: 1px solid #e5e5e5;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #000000 0%, #333333 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #333333 0%, #555555 100%);
    }

    .btn-secondary {
        background: white;
        color: #333333;
        border: 1.5px solid #d4d4d4;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .btn-secondary:hover {
        background: #f5f5f5;
        border-color: #333333;
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        color: #000000;
    }

    .btn-danger {
        background: linear-gradient(135deg, #333333 0%, #000000 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-danger:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #444444 0%, #222222 100%);
    }

    .btn-icon {
        width: 16px;
        height: 16px;
        filter: brightness(0) invert(1);
    }

    .btn-secondary .btn-icon {
        filter: brightness(0);
    }

    .svg-icon {
        filter: grayscale(100%);
    }

    @media (max-width: 1200px) {
        .interface-container {
            padding: 32px 24px;
        }

        .page-title {
            font-size: 32px;
        }

        .admin-welcome {
            padding: 32px 24px;
        }
    }

    @media (max-width: 768px) {
        .interface-container {
            padding: 24px 16px;
        }

        .page-header {
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
        }

        .page-title {
            font-size: 28px;
        }

        .admin-functions {
            padding: 24px 16px;
        }

        .functions-grid {
            grid-template-columns: 1fr;
        }

        .admin-stats {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .admin-welcome {
            padding: 24px 16px;
        }

        .function-card {
            padding: 24px 16px;
        }

        .welcome-title {
            font-size: 24px;
        }
    }

    [data-tooltip] {
        position: relative;
    }

    [data-tooltip]::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 8px 12px;
        background: #000000;
        color: white;
        font-size: 12px;
        font-weight: 500;
        border-radius: 6px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        z-index: 1000;
        margin-bottom: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        filter: grayscale(100%);
    }

    [data-tooltip]::before {
        content: '';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 6px solid transparent;
        border-top-color: #000000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        z-index: 1000;
        margin-bottom: -4px;
    }

    [data-tooltip]:hover::after,
    [data-tooltip]:hover::before {
        opacity: 1;
        visibility: visible;
    }

    .stat-card,
    .function-card {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }

    .function-card:nth-child(1) { animation-delay: 0.1s; }
    .function-card:nth-child(2) { animation-delay: 0.2s; }
    .function-card:nth-child(3) { animation-delay: 0.3s; }

    .stat-value {
        position: relative;
    }

    .stat-value::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #333333, transparent);
        opacity: 0.5;
    }

    .function-card:active,
    .stat-card:active {
        transform: translateY(-2px);
    }

    .function-card:focus-visible {
        outline: 2px solid #333333;
        outline-offset: 2px;
    }

    .current-time {
        display: inline-block;
        margin-left: 8px;
        font-family: 'JetBrains Mono', monospace;
        color: #666666;
        font-weight: 500;
    }
</style>

<div class="interface-container">
    <div class="page-header">
        <div class="page-title-section">
            <h1 class="page-title"><?= $this->title ?></h1>
            <p class="page-subtitle">Панель управления системой инцидентов</p>
        </div>

        <div class="user-info fade-in-up" style="animation-delay: 0.2s">
            <div class="user-avatar">
                <?= strtoupper(substr(Yii::$app->user->identity->name, 0, 1)) ?>
            </div>
            <div class="user-details">
                <div class="user-name"><?= Html::encode(Yii::$app->user->identity->name) ?></div>
                <div class="user-role">Администратор</div>
            </div>
        </div>
    </div>

    <div class="admin-welcome fade-in-up" style="animation-delay: 0.1s">
        <svg class="admin-icon svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>

        <h2 class="welcome-title">Добро пожаловать, <?= Html::encode(Yii::$app->user->identity->name) ?>! 👋</h2>
        <p class="welcome-text">
            Вы находитесь в административной панели системы управления инцидентами.
            Используйте предоставленные инструменты для эффективного управления системой.
        </p>

        <div class="admin-stats">
            <div class="stat-card" data-tooltip="Всего зарегистрированных инцидентов">
                <div class="stat-value"><?= $totalIncidents ?></div>
                <div class="stat-label">Всего инцидентов</div>
            </div>

            <div class="stat-card" data-tooltip="Активные инциденты в работе">
                <div class="stat-value"><?= $activeIncidents ?></div>
                <div class="stat-label">В работе</div>
            </div>

            <div class="stat-card" data-tooltip="Зарегистрированные пользователи">
                <div class="stat-value"><?= $usersCount ?></div>
                <div class="stat-label">Пользователи</div>
            </div>
        </div>
    </div>

    <div class="admin-functions fade-in-up" style="animation-delay: 0.2s">
        <h2 class="section-title">Функции управления</h2>

        <div class="functions-grid">
            <a href="<?= \yii\helpers\Url::to(['admin/incidents']) ?>" class="function-card">
                <div class="function-icon">
                    <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="function-title">Управление инцидентами</h3>
                <p class="function-description">
                    Просмотр, редактирование и управление всеми инцидентами в системе.
                    Фильтрация, поиск.
                </p>
            </a>

            <a href="<?= \yii\helpers\Url::to(['admin/users']) ?>" class="function-card">
                <div class="function-icon">
                    <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13-1.157V21m0 0h-6m6 0h6"/>
                    </svg>
                </div>
                <h3 class="function-title">Управление пользователями</h3>
                <p class="function-description">
                    Просмотр всех пользователей в системе.
                </p>
            </a>
        </div>

        <div class="quick-actions">
            <?= Html::a('
                <svg class="btn-icon svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Вернуться на главную
            ', ['site/index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Анимация загрузки статистики
        const statValues = document.querySelectorAll('.stat-value');
        statValues.forEach(stat => {
            const originalValue = stat.textContent;
            stat.textContent = '0';

            let counter = 0;
            const target = parseInt(originalValue);
            const increment = target / 30;

            const timer = setInterval(() => {
                counter += increment;
                if (counter >= target) {
                    stat.textContent = target;
                    clearInterval(timer);
                } else {
                    stat.textContent = Math.floor(counter);
                }
            }, 50);
        });

        const functionCards = document.querySelectorAll('.function-card');
        functionCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.zIndex = '10';
                const icon = this.querySelector('.function-icon');
                if (icon) {
                    icon.style.filter = 'grayscale(0%)';
                }
            });

            card.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
                const icon = this.querySelector('.function-icon');
                if (icon) {
                    icon.style.filter = 'grayscale(100%)';
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

        document.querySelectorAll('.function-card, .stat-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(el);
        });

        function updateTime() {
            const timeElement = document.querySelector('.current-time');
            if (timeElement) {
                const now = new Date();
                const timeString = now.toLocaleTimeString('ru-RU', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                timeElement.textContent = timeString;
            }
        }

        const timeContainer = document.querySelector('.page-subtitle');
        if (timeContainer) {
            const timeElement = document.createElement('span');
            timeElement.className = 'current-time';
            timeContainer.appendChild(document.createTextNode(' • '));
            timeContainer.appendChild(timeElement);

            updateTime();
            setInterval(updateTime, 1000);
        }

        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(1px)';
            });

            btn.addEventListener('mouseup', function() {
                this.style.transform = '';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        document.querySelectorAll('.function-card, .stat-card').forEach(card => {
            card.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(2px)';
            });

            card.addEventListener('mouseup', function() {
                this.style.transform = '';
            });
        });

        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;

            const welcomeCard = document.querySelector('.admin-welcome');
            if (welcomeCard) {
                welcomeCard.style.backgroundPosition = 'center ' + (rate + 50) + 'px';
            }
        });

        const pageTitle = document.querySelector('.page-title');
        if (pageTitle) {
            pageTitle.style.animationDelay = '0.1s';
            pageTitle.classList.add('fade-in-up');
        }

        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('click', function() {
                this.style.boxShadow = '0 0 0 2px #333333';
                setTimeout(() => {
                    this.style.boxShadow = '';
                }, 300);
            });
        });
    });
</script>
