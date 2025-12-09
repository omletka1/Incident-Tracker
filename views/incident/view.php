<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
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

    .fade-in-up {
        animation: fadeIn 0.8s ease-out forwards;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 48px;
        padding: 0 8px;
        animation: fadeIn 0.6s ease-out;
        flex-wrap: wrap;
        gap: 24px;
    }

    .page-title-section {
        flex: 1;
        min-width: 300px;
    }

    .page-title {
        font-size: 32px;
        font-weight: 800;
        color: #000000;
        letter-spacing: -0.025em;
        margin: 0 0 8px 0;
        line-height: 1.3;
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
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 20px;
        white-space: nowrap;
        gap: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .status-badge {
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .status-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #000000;
    }

    .status-new {
        background: linear-gradient(135deg, #f0f0f0, #e5e5e5);
        color: #000000;
        border: 1px solid #d4d4d4;
    }

    .status-new::before {
        background: #000000;
        animation: pulse 2s infinite;
    }

    .status-in-progress {
        background: linear-gradient(135deg, #e5e5e5, #d4d4d4);
        color: #000000;
        border: 1px solid #c4c4c4;
    }

    .status-closed {
        background: linear-gradient(135deg, #f5f5f5, #e5e5e5);
        color: #333333;
        border: 1px solid #d4d4d4;
    }

    /* Монохромные приоритеты */
    .priority-low {
        background: linear-gradient(135deg, #fafafa, #f0f0f0);
        color: #666666;
        border: 1px solid #e5e5e5;
    }

    .priority-medium {
        background: linear-gradient(135deg, #e5e5e5, #d4d4d4);
        color: #333333;
        border: 1px solid #c4c4c4;
    }

    .priority-high {
        background: linear-gradient(135deg, #333333, #000000);
        color: white;
        border: 1px solid #000000;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        align-items: center;
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
    .btn-edit::before {
        display: none !important;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
        color: #000000;
        border: 1.5px solid #d4d4d4;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        background: linear-gradient(135deg, #f5f5f5 0%, #e5e5e5 100%);
        border-color: #333333;
        color: #000000 !important;
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

    .btn-icon {
        width: 16px;
        height: 16px;
        filter: brightness(0) invert(1);
    }

    .btn-secondary .btn-icon,
    .btn-edit .btn-icon {
        filter: brightness(0);
    }

    .incident-card {
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

    .incident-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #000000;
        margin: 0 0 24px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 20px;
        background: linear-gradient(180deg, #333333, #666666);
        border-radius: 2px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .detail-item {
        margin: 0;
        padding: 16px;
        border-radius: 8px;
        background: linear-gradient(90deg, rgba(0,0,0,0.01), transparent);
    }

    .detail-item:nth-child(even) {
        background: linear-gradient(90deg, transparent, rgba(0,0,0,0.01));
    }

    .detail-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #444444;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .detail-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, #d4d4d4, transparent);
        margin-left: 8px;
    }

    .detail-label svg {
        filter: grayscale(100%);
    }

    .detail-value {
        font-size: 15px;
        color: #000000;
        line-height: 1.6;
        padding: 12px 0;
        font-weight: 500;
    }

    .description-box {
        background: #f5f5f5;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #d4d4d4;
        line-height: 1.8;
        color: #333333;
        white-space: pre-line;
        font-size: 15px;
        margin-top: 8px;
    }

    .comments-section {
        background: white;
        border-radius: 15px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e5e5;
        animation: fadeIn 0.7s ease-out;
        position: relative;
        overflow: hidden;
    }

    .comments-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #666666, #333333);
    }

    .comments-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .comments-count {
        background: #f5f5f5;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        color: #444444;
        border: 1px solid #d4d4d4;
    }

    .comments-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 32px;
    }

    .comment-card {
        background: #f5f5f5;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #d4d4d4;
        transition: all 0.3s ease;
        position: relative;
    }

    .comment-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(180deg, #333333, #666666);
        border-radius: 2px 0 0 2px;
    }

    .comment-card:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        background: #f0f0f0;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .comment-author {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #000000;
        font-size: 15px;
    }

    .comment-author::before {
        content: '';
        width: 6px;
        height: 6px;
        background: #333333;
        border-radius: 50%;
    }

    .comment-date {
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        color: #666666;
        white-space: nowrap;
    }

    .comment-content {
        color: #333333;
        line-height: 1.6;
        white-space: pre-line;
        margin-bottom: 12px;
        padding-left: 12px;
        border-left: 2px solid #d4d4d4;
    }

    .comment-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 16px;
    }

    .btn-link {
        background: none;
        border: none;
        color: #666666;
        font-size: 13px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        filter: grayscale(100%);
    }

    .btn-link:hover {
        background: #e5e5e5;
        color: #000000;
        transform: translateY(-1px);
    }

    .add-comment-form {
        background: #f5f5f5;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #d4d4d4;
        position: relative;
        overflow: hidden;
    }

    .add-comment-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #333333, #666666);
    }

    .form-group {
        margin: 0 0 16px 0;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        font-size: 15px;
        color: #000000;
        background: white;
        border: 1.5px solid #d4d4d4;
        border-radius: 8px;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
        resize: vertical;
        min-height: 100px;
    }

    .form-control:focus {
        outline: none;
        border-color: #333333;
        background: white;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .svg-icon {
        filter: grayscale(100%);
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

    @media (max-width: 1200px) {
        .interface-container {
            padding: 32px 24px;
        }

        .page-title {
            font-size: 28px;
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
            font-size: 24px;
        }

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .incident-card,
        .comments-section {
            padding: 24px 16px;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .comments-header {
            flex-direction: column;
            align-items: stretch;
        }

        .form-actions {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .page-subtitle {
            flex-direction: column;
            align-items: flex-start;
        }
    }
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #c4c4c4, #a5a5a5);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #a5a5a5, #858585);
    }

    .incident-card .detail-item {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }

    .incident-card .detail-item:nth-child(1) { animation-delay: 0.1s; }
    .incident-card .detail-item:nth-child(2) { animation-delay: 0.2s; }
    .incident-card .detail-item:nth-child(3) { animation-delay: 0.3s; }
    .incident-card .detail-item:nth-child(4) { animation-delay: 0.4s; }

    .comment-card {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }

    .char-counter {
        text-align: right;
        font-size: 12px;
        color: #666666;
        margin-top: 4px;
        font-family: 'JetBrains Mono', monospace;
    }

    .char-counter.warning {
        color: #92400e;
    }

    .char-counter.error {
        color: #b91c1c;
        font-weight: 600;
    }
</style>

<div class="interface-container">
    <div class="page-header">
        <div class="page-title-section">
            <h1 class="page-title"><?= Html::encode($model->title) ?></h1>
            <div class="page-subtitle">
                <span>ID: #<?= $model->id ?></span>
                <span class="badge status-badge <?= 'status-' . $model->status ?>">
                    <?= Html::encode($model->getStatusText()) ?>
                </span>
                <span class="badge priority-<?= $model->priority ?>">
                    <?= Html::encode($model->getPriorityText()) ?>
                </span>
            </div>
        </div>

        <div class="action-buttons">
            <?= Html::a('
                <svg class="btn-icon svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Назад к списку
            ', ['incident/index'], ['class' => 'btn btn-secondary']) ?>

            <?php if (Yii::$app->user->identity->id == $model->user_id || Yii::$app->user->identity->isAdmin()): ?>
                <?= Html::a('
                    <svg class="btn-icon svg-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Редактировать
                ', ['incident/update', 'id' => $model->id], [
                    'class' => 'btn btn-edit',
                    'data-tooltip' => 'Редактирование доступно автору и администраторам'
                ]) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="incident-card fade-in-up" style="animation-delay: 0.1s">
        <h2 class="section-title">Детали инцидента</h2>

        <div class="details-grid">
            <div class="detail-item">
                <span class="detail-label">
                    <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Автор
                </span>
                <div class="detail-value">
                    <?= $model->user ? Html::encode($model->user->name) : 'Не указан' ?>
                </div>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Дата создания
                </span>
                <div class="detail-value" style="font-family: 'JetBrains Mono', monospace;">
                    <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i') ?>
                </div>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Дата обновления
                </span>
                <div class="detail-value" style="font-family: 'JetBrains Mono', monospace;">
                    <?= Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i') ?>
                </div>
            </div>
        </div>

        <div class="detail-item">
            <span class="detail-label">
                <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Описание
            </span>
            <div class="description-box">
                <?= nl2br(Html::encode($model->description)) ?>
            </div>
        </div>
    </div>

    <div class="comments-section fade-in-up" style="animation-delay: 0.2s">
        <div class="comments-header">
            <h2 class="section-title">Комментарии</h2>
            <div class="comments-count">
                <?= count($model->comments) ?> комментариев
            </div>
        </div>

        <div class="comments-list">
            <?php if (empty($model->comments)): ?>
                <div class="comment-card" style="text-align: center; color: #666666;">
                    <svg class="svg-icon" width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="opacity: 0.5; margin-bottom: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <p>Комментариев пока нет. Будьте первым!</p>
                </div>
            <?php else: ?>
                <?php foreach ($model->comments as $index => $c): ?>
                    <div class="comment-card" id="comment-<?= $c->id ?>" style="animation-delay: <?= 0.1 + ($index * 0.05) ?>s;">
                        <div class="comment-header">
                            <div class="comment-author">
                                <?= Html::encode($c->user->name) ?>
                            </div>
                            <div class="comment-date">
                                <?= Yii::$app->formatter->asDatetime($c->created_at, 'php:d.m.Y H:i') ?>
                            </div>
                        </div>

                        <div class="comment-content">
                            <?= nl2br(Html::encode($c->comment)) ?>
                        </div>

                        <?php if ($c->user_id == Yii::$app->user->id || Yii::$app->user->identity->isAdmin()): ?>
                            <div class="comment-actions">
                                <?= Html::beginForm(['comment/delete', 'id' => $c->id], 'post', [
                                    'style' => 'display:inline',
                                    'onsubmit' => 'return confirm("Удалить комментарий?");'
                                ]) ?>
                                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                                <button type="submit" class="btn-link">
                                    <svg class="svg-icon" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Удалить
                                </button>
                                <?= Html::endForm(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="add-comment-form">
            <h3 class="section-title">Добавить комментарий</h3>
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['comment/add', 'incident_id' => $model->id]),
                'options' => ['class' => '']
            ]); ?>

            <div class="form-group">
                <?= $form->field(new \app\models\Comment(), 'comment')
                    ->textarea([
                        'rows' => 4,
                        'class' => 'form-control',
                        'placeholder' => 'Введите ваш комментарий...',
                        'data-tooltip' => 'Максимальная длина комментария: 1000 символов'
                    ])->label(false) ?>
                <div class="char-counter" id="commentCharCounter">0 символов</div>
            </div>

            <div class="form-actions">
                <?= Html::submitButton('
                    <svg class="btn-icon svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Отправить комментарий
                ', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash) {
            const target = document.querySelector(window.location.hash);
            if (target) {
                setTimeout(() => {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 100);
            }
        }

        const commentCards = document.querySelectorAll('.comment-card');
        commentCards.forEach(card => {
            card.addEventListener('click', function() {
                this.style.backgroundColor = '#e0e0e0';
                setTimeout(() => {
                    this.style.backgroundColor = '';
                }, 1000);
            });
        });

        const commentField = document.querySelector('textarea[name*="comment"]');
        const charCounter = document.getElementById('commentCharCounter');

        if (commentField && charCounter) {
            function updateCharCount() {
                const length = commentField.value.length;
                charCounter.textContent = `${length} символов`;

                if (length > 1000) {
                    charCounter.className = 'char-counter error';
                } else if (length > 800) {
                    charCounter.className = 'char-counter warning';
                } else {
                    charCounter.className = 'char-counter';
                }
            }

            commentField.addEventListener('input', updateCharCount);
            updateCharCount(); // Инициализация
        }

        document.querySelectorAll('.detail-item').forEach((item, index) => {
            item.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            item.classList.add('fade-in-up');
        });

        document.querySelectorAll('.detail-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px)';
                this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.08)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });

        const commentForm = document.querySelector('.add-comment-form form');
        if (commentForm) {
            commentForm.addEventListener('submit', function(e) {
                const commentText = commentField.value.trim();
                if (commentText.length === 0) {
                    e.preventDefault();
                    alert('Введите текст комментария');
                    commentField.focus();
                    return false;
                }

                if (commentText.length > 1000) {
                    e.preventDefault();
                    alert('Комментарий не должен превышать 1000 символов');
                    commentField.focus();
                    return false;
                }
            });
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
    });
</script>