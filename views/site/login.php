<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<style>
    .interface-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 48px 32px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: linear-gradient(135deg, #f5f5f5 0%, #f0f0f0 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideIn {
        from { transform: translateX(-20px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    .fade-in-up {
        animation: fadeIn 0.8s ease-out forwards;
    }

    .login-card {
        background: white;
        border-radius: 15px;
        padding: 48px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e5e5;
        animation: slideIn 0.5s ease-out;
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
    }

    .login-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .login-title {
        font-size: 32px;
        font-weight: 800;
        color: #000000;
        letter-spacing: -0.025em;
        margin: 0 0 12px 0;
        position: relative;
    }

    .login-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
        border-radius: 2px;
    }

    .login-subtitle {
        font-size: 16px;
        color: #666666;
        font-weight: 400;
        margin: 0;
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 24px;
        position: relative;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .control-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #444444;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .control-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, #d4d4d4, transparent);
        margin-left: 12px;
    }

    .control-label svg {
        width: 18px;
        height: 18px;
        stroke: #666666;
        filter: grayscale(100%);
    }

    .form-control {
        width: 100%;
        padding: 16px 20px;
        font-size: 16px;
        color: #000000;
        background: #f5f5f5;
        border: 2px solid #d4d4d4;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
        line-height: 1.5;
    }

    .form-control:focus {
        outline: none;
        border-color: #333333;
        background: white;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }

    .field-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        pointer-events: none;
        z-index: 2;
        stroke: #666666;
        filter: grayscale(100%);
    }

    .help-block {
        display: block;
        margin-top: 8px;
        font-size: 13px;
        color: #b91c1c;
        font-weight: 500;
        padding-left: 20px;
        position: relative;
    }

    .has-error .form-control {
        border-color: #b91c1c;
        background: linear-gradient(135deg, #f5f5f5, #f0f0f0);
    }

    .has-error .form-control:focus {
        box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.1);
    }

    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        border: 2px solid transparent;
        font-size: 14px;
        line-height: 1.5;
        background: linear-gradient(135deg, #f5f5f5, #f0f0f0);
        border-color: #d4d4d4;
        color: #000000;
        animation: fadeIn 0.3s ease-out;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f5f5f5, #f0f0f0);
        border-color: #d4d4d4;
        color: #b91c1c;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert-danger li {
        margin-bottom: 4px;
        position: relative;
    }

    .alert-danger li::before {
        position: absolute;
        left: -20px;
        filter: grayscale(100%);
    }

    .alert-danger li:last-child {
        margin-bottom: 0;
    }

    .login-button {
        width: 100%;
        padding: 16px 28px;
        border-radius: 10px;
        font-size: 16px;
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
        margin-top: 8px;
        background: linear-gradient(135deg, #000000 0%, #333333 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .login-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #333333 0%, #555555 100%);
    }

    .login-button:active {
        transform: translateY(-1px);
    }

    .login-button::before {
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

    .login-button:hover::before {
        width: 300px;
        height: 300px;
    }

    .login-button svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        filter: brightness(0) invert(1);
    }

    .login-links {
        text-align: center;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid #e5e5e5;
    }

    .login-link {
        color: #333333;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        position: relative;
        padding-left: 20px;
    }

    .login-link::before {
        content: '→';
        position: absolute;
        left: 0;
        opacity: 0.5;
        transition: opacity 0.3s;
        filter: grayscale(100%);
    }

    .login-link:hover {
        color: #000000;
    }

    .login-link:hover::before {
        opacity: 1;
    }

    .svg-icon {
        filter: grayscale(100%);
    }

    @media (max-width: 768px) {
        .interface-container {
            padding: 24px 16px;
        }

        .login-card {
            padding: 32px 24px;
        }

        .login-title {
            font-size: 28px;
        }
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 24px 16px;
        }

        .form-control {
            padding: 14px 16px;
            font-size: 15px;
        }

        .login-title {
            font-size: 24px;
        }
    }

    .form-group:nth-child(odd) {
        background: linear-gradient(90deg, rgba(0,0,0,0.01), transparent);
        padding: 16px;
        border-radius: 8px;
        margin-left: -16px;
        margin-right: -16px;
    }

    .form-group:nth-child(even) {
        background: linear-gradient(90deg, transparent, rgba(0,0,0,0.01));
        padding: 16px;
        border-radius: 8px;
        margin-left: -16px;
        margin-right: -16px;
    }

    @keyframes highlight {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .form-control:focus {
        background-size: 200% 200%;
        animation: highlight 2s ease infinite;
    }
</style>

<div class="interface-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">Вход в систему</h1>
            <p class="login-subtitle">Введите ваши учетные данные для входа</p>
        </div>

        <?php if($model->hasErrors()): ?>
            <div class="alert alert-danger fade-in-up">
                <?= Html::errorSummary($model, ['header' => '']) ?>
            </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'control-label'],
                'errorOptions' => ['class' => 'help-block'],
                'inputOptions' => ['class' => 'form-control'],
                'options' => ['class' => 'form-group']
            ]
        ]); ?>

        <?= $form->field($model, 'email')->label('
            <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Email адрес
        ') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('
            <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Пароль
        ') ?>

        <div class="form-group">
            <?= Html::submitButton('
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Войти
            ', ['class' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailField = document.querySelector('input[name*="email"]');
        if (emailField && !emailField.value) {
            emailField.focus();
        }

        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                const formGroup = this.closest('.form-group');
                if (formGroup) {
                    formGroup.classList.remove('has-error');
                    const errorDiv = formGroup.querySelector('.help-block');
                    if (errorDiv && (errorDiv.textContent.includes('обязателен') ||
                        errorDiv.textContent.includes('Выберите'))) {
                        errorDiv.textContent = '';
                    }
                }
            });
        });

        const loginCard = document.querySelector('.login-card');
        if (loginCard) {
            loginCard.style.opacity = '0';
            loginCard.style.transform = 'translateY(20px)';

            setTimeout(() => {
                loginCard.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                loginCard.style.opacity = '1';
                loginCard.style.transform = 'translateY(0)';
            }, 100);
        }

        let formChanged = false;

        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', () => formChanged = true);
        });

        window.addEventListener('beforeunload', (e) => {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = 'У вас есть несохраненные данные. Вы уверены, что хотите покинуть страницу?';
            }
        });

        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', () => formChanged = false);
        }

        document.querySelectorAll('svg').forEach(svg => {
            if (!svg.classList.contains('btn-icon') && !svg.classList.contains('svg-icon')) {
                svg.classList.add('svg-icon');
            }
        });
    });
</script>