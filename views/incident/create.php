<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<style>
    /* Основные стили в черно-белой гамме */
    .interface-container {
        max-width: 1200px;
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

    .action-buttons {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .btn {
        padding: 14px 28px;
        border-radius: 10px;
        font-size: 15px;
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

    .btn-success {
        background: linear-gradient(135deg, #000000 0%, #333333 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-success:hover {
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

    .btn-icon {
        width: 18px;
        height: 18px;
        filter: brightness(0) invert(1);
    }

    .btn-secondary .btn-icon {
        filter: brightness(0);
    }

    /* Карточка формы */
    .form-card {
        background: white;
        border-radius: 15px;
        padding: 48px;
        margin-bottom: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e5e5;
        animation: slideIn 0.5s ease-out;
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 32px 24px;
        }
    }

    /* Группы полей формы */
    .form-group {
        margin-bottom: 32px;
        position: relative;
        padding: 16px;
        border-radius: 8px;
        background: linear-gradient(90deg, rgba(0,0,0,0.01), transparent);
    }

    .form-group:nth-child(even) {
        background: linear-gradient(90deg, transparent, rgba(0,0,0,0.01));
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    /* Лейблы полей */
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

    /* Поля ввода */
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

    /* Текстовое поле */
    textarea.form-control {
        min-height: 160px;
        resize: vertical;
        line-height: 1.6;
    }

    /* Селекты */
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

    /* Сообщения об ошибках */
    .help-block {
        display: block;
        margin-top: 8px;
        font-size: 13px;
        color: #b91c1c;
        font-weight: 500;
        padding-left: 20px;
        position: relative;
    }

    .help-block::before {
        position: absolute;
        left: 0;
        top: 0;
        font-size: 12px;
        filter: grayscale(100%);
    }

    .has-error .form-control {
        border-color: #b91c1c;
        background: linear-gradient(135deg, #f5f5f5, #f0f0f0);
    }

    .has-error .form-control:focus {
        box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.1);
    }

    /* Действия формы */
    .form-actions {
        display: flex;
        gap: 16px;
        justify-content: flex-start;
        padding-top: 40px;
        border-top: 1px solid #e5e5e5;
        margin-top: 40px;
    }

    /* Стили для страницы создания */
    .creation-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 32px;
        display: block;
        opacity: 0.5;
        filter: grayscale(100%);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .creation-intro {
        text-align: center;
        margin-bottom: 48px;
        color: #666666;
        font-size: 16px;
        line-height: 1.6;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .required-mark {
        color: #b91c1c;
        margin-left: 2px;
        font-weight: 700;
    }

    /* Монохромные иконки */
    .svg-icon {
        filter: grayscale(100%);
    }

    /* Счетчик символов */
    .char-counter {
        text-align: right;
        font-size: 12px;
        color: #666666;
        margin-top: 4px;
        font-family: 'JetBrains Mono', monospace;
        transition: color 0.3s;
    }

    .char-counter.warning {
        color: #92400e;
    }

    .char-counter.error {
        color: #b91c1c;
        font-weight: 600;
    }

    /* Адаптивность */
    @media (max-width: 1200px) {
        .interface-container {
            padding: 32px 24px;
        }

        .page-title {
            font-size: 32px;
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

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .form-group {
            padding: 12px;
        }
    }

    @media (max-width: 480px) {
        .form-card {
            padding: 24px 16px;
        }

        .form-control {
            padding: 14px 16px;
            font-size: 15px;
        }
    }

    /* Кастомный скроллбар для textarea */
    textarea::-webkit-scrollbar {
        width: 8px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #c4c4c4, #a5a5a5);
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #a5a5a5, #858585);
    }

    /* Общее сообщение об ошибках */
    .form-error-alert {
        background: linear-gradient(135deg, #f5f5f5, #f0f0f0);
        border: 1px solid #d4d4d4;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        color: #000000;
        font-size: 14px;
        line-height: 1.5;
        border-left: 4px solid #b91c1c;
    }

    .form-error-alert ul {
        margin: 8px 0 0 0;
        padding-left: 20px;
        color: #666666;
    }

    .form-error-alert li {
        margin-bottom: 4px;
    }

    /* Монохромные опции для селекта приоритета */
    select.form-control option[value="low"] {
        background: #fafafa !important;
        color: #666666 !important;
    }

    select.form-control option[value="medium"] {
        background: #e5e5e5 !important;
        color: #333333 !important;
    }

    select.form-control option[value="high"] {
        background: #333333 !important;
        color: white !important;
    }

    /* Анимация для полей формы */
    .form-group {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
</style>

<div class="interface-container">
    <div class="page-header">
        <div class="page-title-section">
            <h1 class="page-title">Создание инцидента</h1>
            <p class="page-subtitle">Заполните форму для регистрации нового инцидента в системе</p>
        </div>
        <div class="action-buttons">
            <?= Html::a('
                <svg class="btn-icon svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Назад к списку
            ', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <div class="form-card fade-in-up" style="animation-delay: 0.1s">
        <svg class="creation-icon svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>

        <p class="creation-intro">
            Пожалуйста, подробно опишите возникшую проблему. Чем более детальным будет описание,
            тем быстрее мы сможем оказать помощь. Все поля, отмеченные <span class="required-mark">*</span>,
            обязательны для заполнения.
        </p>

        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'control-label'],
                'errorOptions' => ['class' => 'help-block'],
                'inputOptions' => ['class' => 'form-control'],
                'options' => ['class' => 'form-group']
            ]
        ]); ?>

        <!-- Поле заголовка -->
        <?= $form->field($model, 'title')->label('
            <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Заголовок инцидента
            <span class="required-mark">*</span>
        ') ?>

        <!-- Поле описания -->
        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('
            <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Подробное описание проблемы
            <span class="required-mark">*</span>
        ') ?>

        <!-- Поле приоритета -->
        <div class="form-group">
            <label class="control-label" for="incident-priority">
                <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Уровень приоритета
                <span class="required-mark">*</span>
            </label>
            <div class="select-wrapper">
                <?= $form->field($model, 'priority', [
                    'template' => "{input}\n{error}",
                    'options' => ['class' => '']
                ])->dropDownList(
                    \app\models\Incident::getPriorityList(),
                    [
                        'class' => 'form-control',
                        'prompt' => 'Выберите приоритет обработки...',
                        'data-tooltip' => 'Определите срочность решения проблемы'
                    ]
                )->label(false) ?>
            </div>
        </div>

        <!-- Поле статуса (только для админов) -->
        <?php if (Yii::$app->user->identity->isAdmin()): ?>
            <div class="form-group">
                <label class="control-label" for="incident-status">
                    <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Начальный статус
                </label>
                <div class="select-wrapper">
                    <?= $form->field($model, 'status', [
                        'template' => "{input}\n{error}",
                        'options' => ['class' => '']
                    ])->dropDownList(
                        \app\models\Incident::getStatusList(),
                        [
                            'class' => 'form-control',
                            'data-tooltip' => 'Установите начальный статус инцидента'
                        ]
                    )->label(false) ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Кнопки действий -->
        <div class="form-actions fade-in-up" style="animation-delay: 0.5s">
            <?= Html::submitButton('
                <svg class="btn-icon svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Создать инцидент
            ', ['class' => 'btn btn-success']) ?>

            <?= Html::a('
                <svg class="btn-icon svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Отмена
            ', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Фокус на поле заголовка при загрузке
        const titleField = document.querySelector('input[name*="title"]');
        if (titleField) {
            titleField.focus();
        }

        // Подсчет символов для поля описания
        const descriptionField = document.querySelector('textarea[name*="description"]');
        if (descriptionField) {
            const charCounter = document.createElement('div');
            charCounter.className = 'char-counter';
            descriptionField.parentNode.appendChild(charCounter);

            function updateCharCount() {
                const length = descriptionField.value.length;
                charCounter.textContent = `${length} символов`;

                if (length > 2000) {
                    charCounter.className = 'char-counter error';
                    charCounter.innerHTML += ' ⚠️ Максимум 2000 символов';
                } else if (length > 1500) {
                    charCounter.className = 'char-counter warning';
                } else if (length < 50) {
                    charCounter.className = 'char-counter error';
                    charCounter.innerHTML += ' Минимум 10 символов';
                } else {
                    charCounter.className = 'char-counter';
                }
            }

            descriptionField.addEventListener('input', updateCharCount);
            updateCharCount(); // Инициализация

            // Подсказка при фокусе
            descriptionField.addEventListener('focus', function() {
                this.setAttribute('placeholder',
                    'Опишите проблему максимально подробно:\n• Что произошло?\n• Когда возникла проблема?\n• Какие действия были предприняты?\n• Каков ожидаемый результат?'
                );
            });

            descriptionField.addEventListener('blur', function() {
                if (!this.value) {
                    this.setAttribute('placeholder', 'Введите подробное описание проблемы...');
                }
            });
        }

        // Подсказки для поля заголовка
        if (titleField) {
            titleField.addEventListener('focus', function() {
                this.setAttribute('placeholder', 'Краткое и понятное название проблемы (например: "Не работает печать на принтере HP")');
            });

            titleField.addEventListener('blur', function() {
                if (!this.value) {
                    this.setAttribute('placeholder', 'Введите заголовок инцидента...');
                }
            });
        }

        // Валидация формы при отправке
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const titleField = document.querySelector('input[name*="title"]');
                const descriptionField = document.querySelector('textarea[name*="description"]');
                const priorityField = document.querySelector('select[name*="priority"]');
                let isValid = true;
                let errors = [];

                // Валидация заголовка
                if (titleField && !titleField.value.trim()) {
                    errors.push('Заголовок обязателен для заполнения');
                    showFieldError(titleField, 'Заголовок обязателен для заполнения');
                    isValid = false;
                } else if (titleField && titleField.value.trim().length < 5) {
                    errors.push('Заголовок должен содержать минимум 5 символов');
                    showFieldError(titleField, 'Заголовок должен содержать минимум 5 символов');
                    isValid = false;
                }

                // Валидация описания
                if (descriptionField && !descriptionField.value.trim()) {
                    errors.push('Описание обязательно для заполнения');
                    showFieldError(descriptionField, 'Описание обязательно для заполнения');
                    isValid = false;
                } else if (descriptionField && descriptionField.value.trim().length < 10) {
                    errors.push('Описание должно содержать минимум 10 символов');
                    showFieldError(descriptionField, 'Описание должно содержать минимум 10 символов');
                    isValid = false;
                }

                // Валидация приоритета
                if (priorityField && !priorityField.value) {
                    errors.push('Необходимо выбрать приоритет');
                    showFieldError(priorityField, 'Необходимо выбрать приоритет');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();

                    // Показать общее сообщение об ошибке
                    if (errors.length > 0) {
                        let errorAlert = document.querySelector('.form-error-alert');
                        if (!errorAlert) {
                            errorAlert = document.createElement('div');
                            errorAlert.className = 'form-error-alert';
                            form.insertBefore(errorAlert, form.firstChild);
                        }

                        errorAlert.innerHTML = `
                            <strong>⚠️ Необходимо исправить следующие ошибки:</strong>
                            <ul>
                                ${errors.map(error => `<li>${error}</li>`).join('')}
                            </ul>
                        `;

                        // Прокрутка к ошибке
                        const firstError = document.querySelector('.has-error');
                        if (firstError) {
                            firstError.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    }
                }
            });
        }

        function showFieldError(field, message) {
            const formGroup = field.closest('.form-group');
            if (!formGroup) return;

            formGroup.classList.add('has-error');

            let errorDiv = formGroup.querySelector('.help-block');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'help-block';
                formGroup.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
        }

        // Удаление ошибок при вводе
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                const formGroup = this.closest('.form-group');
                if (formGroup) {
                    formGroup.classList.remove('has-error');
                    const errorDiv = formGroup.querySelector('.help-block');
                    if (errorDiv) {
                        errorDiv.textContent = '';
                    }
                }

                // Удалить общее сообщение об ошибке
                const errorAlert = document.querySelector('.form-error-alert');
                if (errorAlert) {
                    errorAlert.remove();
                }
            });
        });

        // Стили для опций селекта приоритета

        document.head.appendChild(style);

        // Добавляем анимацию для полей формы
        document.querySelectorAll('.form-group').forEach((group, index) => {
            group.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            group.classList.add('fade-in-up');
        });

        // Подсветка активного поля
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.background = 'linear-gradient(90deg, rgba(0,0,0,0.02), transparent)';
                this.parentElement.style.borderLeft = '3px solid #333333';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.background = '';
                this.parentElement.style.borderLeft = '';
            });
        });

        // Предупреждение при закрытии страницы с несохраненными данными
        let formChanged = false;

        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', () => {
                formChanged = true;

                // Изменение цвета поля при редактировании
                const formGroup = input.closest('.form-group');
                if (formGroup) {
                    formGroup.style.borderLeft = '3px solid #666666';
                }
            });
        });

        window.addEventListener('beforeunload', (e) => {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = 'У вас есть несохраненные изменения. Вы уверены, что хотите покинуть страницу?';
            }
        });

        // Очистка флага при отправке формы
        if (form) {
            form.addEventListener('submit', () => {
                formChanged = false;

                // Изменение цвета всех полей при отправке
                document.querySelectorAll('.form-group').forEach(group => {
                    group.style.borderLeft = '3px solid #333333';
                });
            });
        }

        // Анимация для кнопок
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
    });
</script>