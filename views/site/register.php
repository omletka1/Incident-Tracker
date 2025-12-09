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

    /* Заголовок */
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

    .select-wrapper {
        position: relative;
    }

    .select-wrapper::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M6 8L10 12L14 8' stroke='%23444444' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        pointer-events: none;
        z-index: 1;
        filter: grayscale(100%);
    }

    select.form-control {
        appearance: none;
        padding-right: 52px;
        background: #f5f5f5;
        cursor: pointer;
        position: relative;
        z-index: 2;
    }

    select.form-control option {
        padding: 12px 20px;
        font-size: 15px;
        color: #000000;
        background: white;
    }

    select.form-control option:hover {
        background: #f0f0f0 !important;
    }

    select.form-control option:checked {
        background: #e0e0e0 !important;
        color: #000000;
        font-weight: 600;
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
        content: '⚠️';
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

        select.form-control {
            background-position: right 16px center;
            padding-right: 46px;
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
            <h1 class="login-title">Регистрация</h1>
            <p class="login-subtitle">Создайте новую учетную запись</p>
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

        <?= $form->field($model, 'name')->label('
            <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Имя
        ') ?>

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

        <div class="form-group fade-in-up">
            <label class="control-label" for="user-role">
                <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Роль
            </label>
            <div class="select-wrapper">
                <?= $form->field($model, 'role', [
                    'template' => "{input}\n{error}",
                    'options' => ['class' => '']
                ])->dropDownList(
                    [0 => 'Сотрудник', 1 => 'Админ'],
                    ['class' => 'form-control', 'prompt' => 'Выберите роль...']
                )->label(false) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Зарегистрироваться
            ', ['class' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameField = document.querySelector('input[name*="name"]');
        if (nameField && !nameField.value) {
            nameField.focus();
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

        const selectField = document.querySelector('select[name*="role"]');
        if (selectField) {
            selectField.addEventListener('change', function() {
                if (this.value !== '') {
                    this.style.color = '#000000';
                    this.style.background = '#f5f5f5';
                } else {
                    this.style.color = '#666666';
                }
            });

            if (selectField.value === '') {
                selectField.style.color = '#666666';
            } else {
                selectField.style.color = '#000000';
            }
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

        document.querySelectorAll('.form-group').forEach((group, index) => {
            group.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            group.classList.add('fade-in-up');
        });
    });
</script>