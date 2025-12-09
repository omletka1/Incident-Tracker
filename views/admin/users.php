<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $users app\models\User[] */

?>
<style>
    .interface-container {
        max-width: 1600px;
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

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
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

    .stats-badge {
        background: white;
        padding: 8px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        color: #444444;
        border: 1px solid #d4d4d4;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stats-badge::before {
        content: '';
        width: 8px;
        height: 8px;
        background: #555555;
        border-radius: 50%;
        animation: pulse 2s infinite;
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

    .btn-icon {
        width: 18px;
        height: 18px;
        filter: brightness(0) invert(1);
    }

    /* Главная таблица */
    .data-table-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e5e5;
        animation: fadeIn 0.7s ease-out;
        position: relative;
    }

    .data-table-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1000px;
    }

    .table-header {
        background: linear-gradient(135deg, #f5f5f5 0%, #f0f0f0 100%);
        border-bottom: 1px solid #d4d4d4;
    }

    .table-header-cell {
        padding: 20px 24px;
        font-size: 13px;
        font-weight: 700;
        color: #444444;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        text-align: left;
        white-space: nowrap;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
        position: relative;
    }

    .table-header-cell:hover {
        color: #000000;
        border-bottom-color: #333333;
    }

    .table-header-cell::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 20px;
        background: linear-gradient(180deg, transparent, #d4d4d4, transparent);
    }

    .table-header-cell:last-child::after {
        display: none;
    }

    .table-row {
        border-bottom: 1px solid #f5f5f5;
        transition: all 0.3s ease;
        position: relative;
    }

    .table-row:hover {
        background: linear-gradient(90deg, rgba(0, 0, 0, 0.02), rgba(51, 51, 51, 0.02));
        transform: translateX(4px);
        box-shadow: inset 4px 0 0 #333333;
    }

    .table-cell {
        padding: 22px 24px;
        font-size: 15px;
        color: #333333;
        vertical-align: middle;
        line-height: 1.5;
        transition: all 0.3s;
    }

    .cell-name {
        font-weight: 600;
        color: #000000;
    }

    .cell-email {
        font-weight: 500;
        color: #444444;
    }

    .cell-email a {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
        position: relative;
        padding-left: 24px;
    }

    .cell-email a::before {
        content: '✉️';
        position: absolute;
        left: 0;
        opacity: 0.5;
        transition: opacity 0.3s;
        filter: grayscale(100%);
    }

    .cell-email a:hover {
        color: #000000;
    }

    .cell-email a:hover::before {
        opacity: 1;
    }

    .cell-created {
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        color: #666666;
        white-space: nowrap;
    }

    .role-badge {
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
    }

    .role-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #000000;
    }

    .role-admin {
        background: linear-gradient(135deg, #333333, #000000);
        color: white;
        border: 1px solid #000000;
    }

    .role-admin::before {
        background: white;
        animation: pulse 2s infinite;
    }

    .role-employee {
        background: linear-gradient(135deg, #f0f0f0, #e5e5e5);
        color: #333333;
        border: 1px solid #d4d4d4;
    }

    .role-employee::before {
        background: #333333;
    }

    .empty-state {
        padding: 80px 24px;
        text-align: center;
        background: linear-gradient(135deg, #f5f5f5, #f0f0f0);
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 24px;
        opacity: 0.3;
        filter: grayscale(100%);
    }

    .empty-state-title {
        font-size: 24px;
        font-weight: 700;
        color: #000000;
        margin-bottom: 12px;
    }

    .empty-state-text {
        font-size: 16px;
        color: #666666;
        max-width: 400px;
        margin: 0 auto 32px;
        line-height: 1.6;
    }

    .pagination-container {
        background: linear-gradient(135deg, #f5f5f5, #f0f0f0);
        padding: 24px;
        border-top: 1px solid #d4d4d4;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .pagination .prev,
    .pagination .next {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        color: #444444;
        text-decoration: none;
        border-radius: 10px;
        border: 1.5px solid #d4d4d4;
        background: white;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 6px;
        filter: grayscale(100%);
    }

    .pagination .prev:hover:not(.disabled),
    .pagination .next:hover:not(.disabled) {
        background: #333333;
        color: white;
        border-color: #333333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        filter: none;
    }

    .pagination .prev.disabled,
    .pagination .next.disabled {
        opacity: 0.4;
        cursor: not-allowed;
        background: #f0f0f0;
    }

    .pagination ul {
        display: flex;
        gap: 6px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pagination li a,
    .pagination li span {
        display: block;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 600;
        color: #444444;
        text-decoration: none;
        border-radius: 10px;
        border: 1.5px solid transparent;
        background: white;
        min-width: 44px;
        text-align: center;
        transition: all 0.3s;
    }

    .pagination li a:hover {
        background: #f5f5f5;
        border-color: #d4d4d4;
        transform: translateY(-2px);
    }

    .pagination li.active span {
        background: linear-gradient(135deg, #000000, #333333);
        color: white;
        border-color: #000000;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .stats-badge {
            justify-content: center;
        }

        .page-title {
            font-size: 28px;
        }

        .table-cell {
            padding: 16px;
            font-size: 14px;
        }

        .table-header-cell {
            padding: 16px;
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .btn {
            padding: 12px 20px;
            font-size: 14px;
        }
    }

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

    body {
        background: linear-gradient(135deg, #f5f5f5 0%, #f0f0f0 100%);
    }

    .table-row {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }

    .table-row:nth-child(1) { animation-delay: 0.1s; }
    .table-row:nth-child(2) { animation-delay: 0.2s; }
    .table-row:nth-child(3) { animation-delay: 0.3s; }
    .table-row:nth-child(4) { animation-delay: 0.4s; }
    .table-row:nth-child(5) { animation-delay: 0.5s; }

    .table-row:focus-within {
        background: linear-gradient(90deg, rgba(0,0,0,0.05), rgba(51,51,51,0.05));
        box-shadow: inset 4px 0 0 #333333;
    }
</style>

<div class="interface-container">
    <div class="page-header">
        <div class="page-title-section">
            <h1 class="page-title">Пользователи</h1>
            <p class="page-subtitle">Список всех зарегистрированных пользователей в системе</p>
        </div>
        <div class="action-buttons">
            <div class="stats-badge" data-tooltip="Всего пользователей в системе">
                Всего: <?= count($users) ?>
            </div>
        </div>
    </div>

    <div class="data-table-container fade-in-up" style="animation-delay: 0.1s">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider([
                    'allModels' => $users,
                    'pagination' => [
                        'pageSize' => 20,
                        'pageParam' => 'page',
                        'pageSizeParam' => 'per-page',
                    ],
                    'sort' => [
                        'attributes' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                        'defaultOrder' => ['id' => SORT_DESC],
                    ],
                ]),
                'tableOptions' => ['class' => 'data-table'],
                'layout' => "{items}\n<div class='pagination-container'>{pager}</div>",
                'emptyText' => '
                    <div class="empty-state">
                        <div class="empty-state-icon">👥</div>
                        <div class="empty-state-title">Пользователи не найдены</div>
                        <div class="empty-state-text">В системе пока нет зарегистрированных пользователей</div>
                    </div>
                ',
                'rowOptions' => function($model, $key, $index, $grid) {
                    return ['class' => 'table-row'];
                },
                'headerRowOptions' => ['class' => 'table-header'],
                'columns' => [
                    [
                        'attribute' => 'id',
                        'header' => 'ID',
                        'headerOptions' => ['class' => 'table-header-cell header-id'],
                        'contentOptions' => ['class' => 'table-cell cell-id'],
                        'headerOptions' => ['data-tooltip' => 'Уникальный идентификатор пользователя']
                    ],
                    [
                        'attribute' => 'name',
                        'header' => 'ИМЯ ПОЛЬЗОВАТЕЛЯ',
                        'headerOptions' => ['class' => 'table-header-cell header-name'],
                        'contentOptions' => ['class' => 'table-cell cell-name'],
                        'value' => function($model) {
                            return Html::encode($model->name);
                        }
                    ],
                    [
                        'attribute' => 'email',
                        'header' => 'EMAIL',
                        'headerOptions' => ['class' => 'table-header-cell header-email'],
                        'contentOptions' => ['class' => 'table-cell cell-email'],
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a(Html::encode($model->email), 'mailto:' . $model->email, [
                                'data-tooltip' => 'Нажмите для отправки email',
                                'class' => ''
                            ]);
                        }
                    ],
                    [
                        'attribute' => 'role',
                        'header' => 'РОЛЬ',
                        'headerOptions' => ['class' => 'table-header-cell header-role'],
                        'contentOptions' => ['class' => 'table-cell cell-role'],
                        'value' => function($model) {
                            $roleText = $model->role == 1 ? 'Админ' : 'Сотрудник';
                            $class = $model->role == 1 ? 'role-admin' : 'role-employee';
                            return Html::tag('span', $roleText, ['class' => 'role-badge ' . $class]);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'created_at',
                        'header' => 'СОЗДАН',
                        'headerOptions' => ['class' => 'table-header-cell header-created'],
                        'contentOptions' => ['class' => 'table-cell cell-created'],
                        'format' => ['date', 'php:d.m.Y H:i'],
                        'headerOptions' => ['data-tooltip' => 'Дата и время регистрации']
                    ],
                    [
                        'attribute' => 'updated_at',
                        'header' => 'ОБНОВЛЕН',
                        'headerOptions' => ['class' => 'table-header-cell header-updated'],
                        'contentOptions' => ['class' => 'table-cell cell-created'],
                        'format' => ['date', 'php:d.m.Y H:i'],
                        'headerOptions' => ['data-tooltip' => 'Дата и время последнего обновления'],
                        'value' => function($model) {
                            return $model->updated_at ? Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i')
                                : Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i');
                        }
                    ],
                ],
                'pager' => [
                    'options' => ['class' => 'pagination'],
                    'prevPageLabel' => '
                        <svg class="svg-icon" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Назад
                    ',
                    'nextPageLabel' => '
                        Вперед
                        <svg class="svg-icon" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    ',
                    'disabledPageCssClass' => 'disabled',
                    'activePageCssClass' => 'active',
                ],
            ]) ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.table-row');
        const counter = document.querySelector('.stats-badge');

        if (counter && rows.length > 0) {
            const newCount = rows.length;
            counter.innerHTML = `Всего: ${newCount}`;

            const adminCount = document.querySelectorAll('.role-admin').length;
            const employeeCount = document.querySelectorAll('.role-employee').length;

            counter.setAttribute('data-tooltip',
                `Всего пользователей: ${newCount}\n` +
                `Администраторов: ${adminCount}\n` +
                `Сотрудников: ${employeeCount}`
            );
        }

        document.querySelectorAll('.table-row').forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
            row.classList.add('fade-in-up');
        });

        document.querySelectorAll('svg').forEach(svg => {
            if (!svg.classList.contains('btn-icon') && !svg.classList.contains('svg-icon')) {
                svg.classList.add('svg-icon');
            }
        });

        document.querySelectorAll('.table-row').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.cursor = 'default';
            });
        });

        document.querySelectorAll('.role-badge').forEach(badge => {
            badge.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
                this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.15)';
            });

            badge.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
            });
        });

        document.querySelectorAll('.cell-email a').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px)';
            });

            link.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        function updateLastUpdateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('ru-RU', {
                hour: '2-digit',
                minute: '2-digit'
            });

            const updateElement = document.querySelector('.stats-badge');
            if (updateElement) {
                const currentText = updateElement.getAttribute('data-tooltip');
                const baseText = currentText.split('\n')[0];
                updateElement.setAttribute('data-tooltip', `${baseText}\nОбновлено в ${timeString}`);
            }
        }

        updateLastUpdateTime();
    });
</script>