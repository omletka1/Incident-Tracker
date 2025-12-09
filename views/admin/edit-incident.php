<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $incident app\models\Incident */

?>
<style>
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

    .incident-info-card {
        background: white;
        border-radius: 15px;
        padding: 32px;
        margin-bottom: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e5e5;
        animation: slideIn 0.5s ease-out;
        position: relative;
        overflow: hidden;
    }

    .incident-info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
    }

    .incident-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }

    .incident-info-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .info-label {
        font-size: 12px;
        font-weight: 600;
        color: #666666;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-label svg {
        width: 16px;
        height: 16px;
        stroke: #666666;
        filter: grayscale(100%);
    }

    .info-value {
        font-size: 16px;
        font-weight: 600;
        color: #000000;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        white-space: nowrap;
        gap: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
        color: #333333;
        border: 1px solid #d4d4d4;
    }

    .status-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #666666;
    }

    .priority-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 20px;
        white-space: nowrap;
        gap: 6px;
        background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
        color: #333333;
        border: 1px solid #d4d4d4;
    }

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

    .form-group {
        margin-bottom: 32px;
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

    textarea.form-control {
        min-height: 160px;
        resize: vertical;
        line-height: 1.6;
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

    .form-actions {
        display: flex;
        gap: 16px;
        justify-content: flex-start;
        padding-top: 40px;
        border-top: 1px solid #e5e5e5;
        margin-top: 40px;
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

    .form-control option {
        background: white;
        color: #000000;
    }

    .form-control option:checked {
        background: #333333 !important;
        color: white !important;
    }

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

        .incident-info-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
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

    .svg-icon {
        filter: grayscale(100%);
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
    <div class="page-header">
        <div class="page-title-section">
            <h1 class="page-title">Редактировать инцидент</h1>
            <p class="page-subtitle">Обновите информацию об инциденте ниже. Все изменения будут сохранены в системе.</p>
        </div>
        <div class="action-buttons">
            <?= Html::a('
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Назад к списку
            ', ['incidents'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <div class="incident-info-card">
        <div class="incident-info-grid">
            <div class="incident-info-item">
                <span class="info-label">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Автор
                </span>
                <span class="info-value">
                    <?= Html::encode($incident->user->name ?? 'Не указан') ?>
                </span>
            </div>

            <div class="incident-info-item">
                <span class="info-label">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Создан
                </span>
                <span class="info-value">
                    <?= Yii::$app->formatter->asDatetime($incident->created_at, 'php:d.m.Y H:i') ?>
                </span>
            </div>

            <div class="incident-info-item">
                <span class="info-label">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Обновлен
                </span>
                <span class="info-value">
                    <?= Yii::$app->formatter->asDatetime($incident->updated_at ?? $incident->created_at, 'php:d.m.Y H:i') ?>
                </span>
            </div>
        </div>
    </div>

    <div class="form-card">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'control-label'],
                'errorOptions' => ['class' => 'help-block'],
                'inputOptions' => ['class' => 'form-control'],
                'options' => ['class' => 'form-group']
            ]
        ]); ?>

        <?= $form->field($incident, 'title')->label('
            <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Заголовок инцидента
        ') ?>

        <?= $form->field($incident, 'description')->textarea(['rows' => 8])->label('
            <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Подробное описание
        ') ?>

        <div class="form-group fade-in-up">
            <label class="control-label" for="incident-status">
                <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Статус инцидента
            </label>
            <div class="select-wrapper">
                <?= $form->field($incident, 'status', [
                    'template' => "{input}\n{error}",
                    'options' => ['class' => '']
                ])->dropDownList(
                    \app\models\Incident::getStatusList(),
                    ['class' => 'form-control']
                )->label(false) ?>
            </div>
        </div>

        <div class="form-group fade-in-up">
            <label class="control-label" for="incident-priority">
                <svg class="svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Приоритет инцидента
            </label>
            <div class="select-wrapper">
                <?= $form->field($incident, 'priority', [
                    'template' => "{input}\n{error}",
                    'options' => ['class' => '']
                ])->dropDownList(
                    \app\models\Incident::getPriorityList(),
                    ['class' => 'form-control']
                )->label(false) ?>
            </div>
        </div>

        <div class="form-actions fade-in-up">
            <?= Html::submitButton('
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Сохранить изменения
            ', ['class' => 'btn btn-success']) ?>

            <?= Html::a('
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Отмена
            ', ['incidents'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Фокус на первое поле при загрузке
        const firstInput = document.querySelector('.form-control');
        if (firstInput && !firstInput.value) {
            firstInput.focus();
        }

        const descriptionField = document.querySelector('textarea[name*="description"]');
        if (descriptionField) {
            const charCounter = document.createElement('div');
            charCounter.className = 'char-counter';
            descriptionField.parentNode.appendChild(charCounter);

            function updateCharCount() {
                const length = descriptionField.value.length;
                charCounter.textContent = `${length} символов`;

                if (length > 1000) {
                    charCounter.className = 'char-counter error';
                } else if (length > 800) {
                    charCounter.className = 'char-counter warning';
                } else {
                    charCounter.className = 'char-counter';
                }
            }

            descriptionField.addEventListener('input', updateCharCount);
            updateCharCount();
        }

        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const titleField = document.querySelector('input[name*="title"]');
                const descriptionField = document.querySelector('textarea[name*="description"]');
                const priorityField = document.querySelector('select[name*="priority"]');
                const statusField = document.querySelector('select[name*="status"]');
                let isValid = true;

                if (titleField && !titleField.value.trim()) {
                    showFieldError(titleField, 'Заголовок обязателен для заполнения');
                    isValid = false;
                }

                if (descriptionField && !descriptionField.value.trim()) {
                    showFieldError(descriptionField, 'Описание обязательно для заполнения');
                    isValid = false;
                }

                if (priorityField && !priorityField.value) {
                    showFieldError(priorityField, 'Выберите приоритет инцидента');
                    isValid = false;
                }

                if (statusField && !statusField.value) {
                    showFieldError(statusField, 'Выберите статус инцидента');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    const firstError = document.querySelector('.has-error');
                    if (firstError) {
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
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

        document.querySelectorAll('.form-group').forEach((group, index) => {
            group.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            group.classList.add('fade-in-up');
        });

        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.background = 'linear-gradient(90deg, rgba(0,0,0,0.02), transparent)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.background = '';
            });
        });

        let formChanged = false;

        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', () => formChanged = true);
        });

        window.addEventListener('beforeunload', (e) => {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = 'У вас есть несохраненные изменения. Вы уверены, что хотите покинуть страницу?';
            }
        });

        if (form) {
            form.addEventListener('submit', () => formChanged = false);
        }
    });
</script>