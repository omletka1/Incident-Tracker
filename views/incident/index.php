<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
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

    @keyframes slideIn {
        from { transform: translateX(-20px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }



    @keyframes pulse {

        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
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

    .filter-card {
        background: white;
        border-radius: 15px;
        padding: 40px 30px;
        margin-bottom: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e5e5;
        animation: slideIn 0.5s ease-out;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .filter-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #333333, #666666);
    }

    .filter-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .filter-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #000000;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-title::before {
        content: '';
        width: 4px;
        height: 20px;
        background: linear-gradient(180deg, #333333, #666666);
        border-radius: 2px;
    }

    .filter-toggle {
        background: #f5f5f5;
        border: 1.5px solid #d4d4d4;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 14px;
        color: #666666;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
        filter: grayscale(100%);
    }

    .filter-toggle:hover {
        background: #e5e5e5;
        border-color: #333333;
        color: #000000;
    }

    .filter-form {
        margin: 0;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 768px) {
        .filter-grid {
            grid-template-columns: 1fr;
        }
    }

    .filter-group {
        margin: 0;
    }

    .filter-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #444444;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 6px;
        filter: grayscale(100%);
    }

    .filter-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, #d4d4d4, transparent);
        margin-left: 8px;
    }

    .filter-input {
        width: 100%;
        padding: 14px 16px;
        font-size: 15px;
        color: #000000;
        background: #f5f5f5;
        border: 1.5px solid #d4d4d4;
        border-radius: 8px;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
    }

    .filter-input:focus {
        outline: none;
        border-color: #333333;
        background: white;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 6L8 10L12 6' stroke='%23444444' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        pointer-events: none;
        z-index: 1;
        filter: grayscale(100%);
    }

    .filter-select {
        appearance: none;
        padding-right: 48px;
        background: #f5f5f5;
        cursor: pointer;
        position: relative;
        z-index: 2;
    }

    .date-wrapper {
        position: relative;
    }

    .date-wrapper::after {
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M15 3H5C3.89543 3 3 3.89543 3 5V15C3 16.1046 3.89543 17 5 17H15C16.1046 17 17 16.1046 17 15V5C17 3.89543 16.1046 3 15 3Z' stroke='%23444444' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M3 7H17' stroke='%23444444' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M7 1V3' stroke='%23444444' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M13 1V3' stroke='%23444444' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        pointer-events: none;
        z-index: 1;
        filter: grayscale(100%);
    }

    .date-input {
        font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        font-size: 14px;
        color: #000000;
        padding-right: 48px;
        cursor: pointer;
        background: #f5f5f5;
    }

    .filter-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 30px;
        border-top: 1px solid #e5e5e5;
    }

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

    .cell-title {
        font-weight: 600;
        color: #000000;
        max-width: 320px;
    }

    .cell-title a {
        color: inherit;
        text-decoration: none;
        display: block;
        position: relative;
        padding-left: 24px;
        transition: all 0.3s;
    }

    .cell-title a::before {
        position: absolute;
        left: 0;
        opacity: 0.5;
        transition: opacity 0.3s;
        filter: grayscale(100%);
    }

    .cell-title a:hover {
        color: #333333;
    }

    .cell-title a:hover::before {
        opacity: 1;
    }

    .cell-author {
        font-weight: 500;
        color: #444444;
    }

    .cell-created {
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        color: #666666;
        white-space: nowrap;
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

    .priority-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 20px;
        white-space: nowrap;
        gap: 6px;
    }

    .priority-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #000000;
    }

    .priority-low {
        background: linear-gradient(135deg, #fafafa, #f0f0f0);
        color: #666666;
        border: 1px solid #e5e5e5;
    }

    .priority-low::before {
        background: #666666;
    }

    .priority-medium {
        background: linear-gradient(135deg, #e5e5e5, #d4d4d4);
        color: #333333;
        border: 1px solid #c4c4c4;
    }

    .priority-medium::before {
        background: #333333;
    }

    .priority-high {
        background: linear-gradient(135deg, #333333, #000000);
        color: white;
        border: 1px solid #000000;
    }

    .priority-high::before {
        background: white;
    }

    .action-cell {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .action-link {
        font-size: 13px;
        font-weight: 600;
        color: #444444;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s;
        border: 1.5px solid #d4d4d4;
        background: white;
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        filter: grayscale(100%);
    }

    .action-link:hover {
        background: #333333;
        color: white;
        border-color: #333333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        filter: none;
    }

    .action-view:hover {
        background: #555555;
        border-color: #555555;
    }

    .action-update:hover {
        background: #666666;
        border-color: #666666;
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
        border-radius: 8px;
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
        border-radius: 8px;
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

        .filter-card {
            padding: 30px 20px;
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

        .filter-actions {
            flex-direction: column;
        }

        .action-cell {
            flex-direction: column;
            align-items: flex-end;
        }

        .action-link {
            width: 100%;
            justify-content: center;
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

    .svg-icon {
        filter: grayscale(100%);
    }

    body {
        background: linear-gradient(135deg, #f5f5f5 0%, #f0f0f0 100%);
    }
</style>

<div class="interface-container">
    <div class="page-header">
        <div class="page-title-section">
            <h1 class="page-title">Управление инцидентами</h1>
            <p class="page-subtitle">Отслеживайте и управляйте своими инцидентами в системе</p>
        </div>
        <div class="action-buttons">
            <div class="stats-badge" data-tooltip="Всего инцидентов в системе">
                Всего: <?= $dataProvider->getTotalCount() ?>
            </div>
            <?= Html::a('
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Новый инцидент
            ', ['incident/create'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="filter-card fade-in-up" ">
        <div class="filter-header">
            <div class="filter-title">Фильтры и поиск</div>
            <button class="filter-toggle" id="filterToggle">
                <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Показать/скрыть
            </button>
        </div>

        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => Url::to(['incident/index']),
            'options' => ['class' => 'filter-form']
        ]); ?>

        <div class="filter-grid">
            <div class="filter-group fade-in-up" ">
                <label class="filter-label">
                    <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Поиск
                </label>
                <?= $form->field($searchModel, 'q', [
                    'template' => "{input}",
                    'options' => ['class' => '']
                ])->textInput([
                    'class' => 'filter-input',
                    'placeholder' => 'Введите заголовок, описание или ID...',
                    'data-tooltip' => 'Поиск по всем текстовым полям'
                ])->label(false) ?>
            </div>

            <div class="filter-group fade-in-up">
                <label class="filter-label">
                    <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Статус
                </label>
                <div class="select-wrapper">
                    <?= $form->field($searchModel, 'status', [
                        'template' => "{input}",
                        'options' => ['class' => '']
                    ])->dropDownList([
                        '' => 'Все статусы',
                        'new' => '🆕 Новый',
                        'in_progress' => '⚙️ В работе',
                        'closed' => '✅ Закрыт'
                    ], [
                        'class' => 'filter-input filter-select',
                        'data-tooltip' => 'Фильтр по статусу инцидента'
                    ])->label(false) ?>
                </div>
            </div>

            <div class="filter-group fade-in-up">
                <label class="filter-label">
                    <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    Приоритет
                </label>
                <div class="select-wrapper">
                    <?= $form->field($searchModel, 'priority', [
                        'template' => "{input}",
                        'options' => ['class' => '']
                    ])->dropDownList([
                        '' => 'Все приоритеты',
                        'low' => '📉 Низкий',
                        'medium' => '📊 Средний',
                        'high' => '📈 Высокий'
                    ], [
                        'class' => 'filter-input filter-select',
                        'data-tooltip' => 'Фильтр по уровню приоритета'
                    ])->label(false) ?>
                </div>
            </div>

            <div class="filter-group fade-in-up">
                <label class="filter-label">
                    <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    С даты
                </label>
                <div class="date-wrapper">
                    <?= $form->field($searchModel, 'date_from', [
                        'template' => "{input}",
                        'options' => ['class' => '']
                    ])->input('date', [
                        'class' => 'filter-input date-input',
                        'placeholder' => 'Выберите дату начала',
                        'data-tooltip' => 'Фильтр по дате создания от'
                    ])->label(false) ?>
                </div>
            </div>

            <div class="filter-group fade-in-up" >
                <label class="filter-label">
                    <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    По дату
                </label>
                <div class="date-wrapper">
                    <?= $form->field($searchModel, 'date_to', [
                        'template' => "{input}",
                        'options' => ['class' => '']
                    ])->input('date', [
                        'class' => 'filter-input date-input',
                        'placeholder' => 'Выберите дату окончания',
                        'data-tooltip' => 'Фильтр по дате создания до'
                    ])->label(false) ?>
                </div>
            </div>
        </div>

        <div class="filter-actions fade-in-up" >
            <?= Html::submitButton('
                <svg class="svg-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Применить фильтры
            ', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('
                <svg class="svg-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Сбросить фильтры
            ', ['incident/index'], ['class' => 'btn btn-secondary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="data-table-container fade-in-up">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'data-table'],
                'layout' => "{items}\n<div class='pagination-container'>{pager}</div>",
                'emptyText' => '
                    <div class="empty-state">
                        <div class="empty-state-icon">📋</div>
                        <div class="empty-state-title">Индидентов не найдено</div>
                        <div class="empty-state-text">Попробуйте изменить параметры фильтрации или создайте новый инцидент</div>
                        ' . Html::a('Создать первый инцидент', ['incident/create'], ['class' => 'btn btn-primary']) . '
                    </div>
                ',
                'rowOptions' => ['class' => 'table-row'],
                'headerRowOptions' => ['class' => 'table-header'],
                'columns' => [
                    [
                        'attribute' => 'title',
                        'header' => 'ЗАГОЛОВОК ИНЦИДЕНТА',
                        'headerOptions' => ['class' => 'table-header-cell header-title'],
                        'contentOptions' => ['class' => 'table-cell cell-title'],
                        'format' => 'html',
                        'value' => function($model) {
                            $title = Html::encode($model->title);
                            $truncated = mb_strlen($title) > 80 ? mb_substr($title, 0, 77) . '...' : $title;
                            return Html::a($truncated, ['incident/view', 'id' => $model->id], [
                                'title' => $title,
                                'data-tooltip' => 'Нажмите для просмотра деталей'
                            ]);
                        }
                    ],
                    [
                        'attribute' => 'user_id',
                        'label' => 'АВТОР',
                        'value' => function($model) {
                            return $model->user ? Html::encode($model->user->name) : 'Не указан';
                        },
                        'headerOptions' => ['class' => 'table-header-cell header-author'],
                        'contentOptions' => ['class' => 'table-cell cell-author']
                    ],
                    [
                        'attribute' => 'status',
                        'header' => 'СТАТУС',
                        'headerOptions' => ['class' => 'table-header-cell header-status'],
                        'contentOptions' => ['class' => 'table-cell cell-status'],
                        'value' => function($model) {
                            $status = $model->getStatusText();
                            $class = 'status-badge ';
                            switch($model->status) {
                                case 'new': $class .= 'status-new'; break;
                                case 'in_progress': $class .= 'status-in-progress'; break;
                                case 'closed': $class .= 'status-closed'; break;
                            }
                            return Html::tag('span', $status, ['class' => $class]);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'priority',
                        'header' => 'ПРИОРИТЕТ',
                        'headerOptions' => ['class' => 'table-header-cell header-priority'],
                        'contentOptions' => ['class' => 'table-cell cell-priority'],
                        'value' => function($model) {
                            $priority = $model->getPriorityText();
                            $class = 'priority-badge ';
                            switch($model->priority) {
                                case 'low': $class .= 'priority-low'; break;
                                case 'medium': $class .= 'priority-medium'; break;
                                case 'high': $class .= 'priority-high'; break;
                            }
                            return Html::tag('span', $priority, ['class' => $class]);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'created_at',
                        'header' => 'ДАТА СОЗДАНИЯ',
                        'headerOptions' => ['class' => 'table-header-cell header-created'],
                        'contentOptions' => ['class' => 'table-cell cell-created'],
                        'format' => ['date', 'php:d.m.Y H:i'],
                        'headerOptions' => ['data-tooltip' => 'Дата и время создания инцидента']
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => 'incident',
                        'template' => '<div class="action-cell">{view} {update}</div>',
                        'header' => 'ДЕЙСТВИЯ',
                        'headerOptions' => ['class' => 'table-header-cell header-actions'],
                        'contentOptions' => ['class' => 'table-cell cell-actions'],
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a('
                                    <svg class="svg-icon" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Просмотр
                                ', $url, ['class' => 'action-link action-view']);
                            },
                            'update' => function($url, $model) {
                                return Html::a('
                                    <svg class="svg-icon" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Редактировать
                                ', $url, ['class' => 'action-link action-update']);
                            },
                        ]
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('filterToggle')?.addEventListener('click', function(e) {
        e.preventDefault();
        const filterGrid = document.querySelector('.filter-grid');
        const filterActions = document.querySelector('.filter-actions');

        if (filterGrid.style.display === 'none') {
            filterGrid.style.display = 'grid';
            filterActions.style.display = 'flex';
            this.innerHTML = `
                <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Скрыть фильтры
            `;
        } else {
            filterGrid.style.display = 'none';
            filterActions.style.display = 'none';
            this.innerHTML = `
                <svg class="svg-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Показать фильтры
            `;
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.table-row');
        const counter = document.querySelector('.stats-badge');

        if (counter && rows.length > 0) {
            const newCount = rows.length;
            counter.innerHTML = `Всего: ${newCount}`;
        }

        document.querySelectorAll('.table-row').forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
            row.classList.add('fade-in-up');
        });
    });

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

    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.interface-container');
        if (window.scrollY > 50) {
            navbar.style.transform = 'translateY(-2px)';
        } else {
            navbar.style.transform = 'translateY(0)';
        }
    });

    document.querySelectorAll('[data-tooltip]').forEach(element => {
        element.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = this.getAttribute('data-tooltip');
            tooltip.style.position = 'absolute';
            tooltip.style.background = '#000000';
            tooltip.style.color = 'white';
            tooltip.style.padding = '8px 12px';
            tooltip.style.borderRadius = '6px';
            tooltip.style.fontSize = '12px';
            tooltip.style.fontWeight = '500';
            tooltip.style.whiteSpace = 'nowrap';
            tooltip.style.zIndex = '1000';
            tooltip.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
            tooltip.style.filter = 'grayscale(100%)';

            const rect = this.getBoundingClientRect();
            tooltip.style.top = (rect.top - 40) + 'px';
            tooltip.style.left = (rect.left + rect.width / 2) + 'px';
            tooltip.style.transform = 'translateX(-50%)';

            document.body.appendChild(tooltip);
            this._tooltip = tooltip;
        });

        element.addEventListener('mouseleave', function() {
            if (this._tooltip) {
                this._tooltip.remove();
                delete this._tooltip;
            }
        });
    });
</script>