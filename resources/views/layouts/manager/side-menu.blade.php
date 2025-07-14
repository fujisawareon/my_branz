<?php
$route_num = 0;
$route_name = Route::currentRouteName();

switch ($route_name) {
    case 'manager_dashboard':
        $route_num = 1;
        break;
    case str_starts_with($route_name, 'manager_building'):
        $route_num = 2;
        break;
    case str_starts_with($route_name, 'manager_user'):
        $route_num = 3;
        break;
    case str_starts_with($route_name, 'manager_customer'):
        $route_num = 4;
        break;
    case str_starts_with($route_name, 'manager_access_log'):
        $route_num = 5;
        break;
        break;
    case str_starts_with($route_name, 'manager_score_import'):
        $route_num = 6;
        break;
}

?>

<div class="side-menu-area">
    <a href="{{ route('manager_dashboard') }}" class="@if ($route_num === 1) active @endif">
        <div class="side-menu-item">ダッシュボード</div>
    </a>
    <a href="{{ route('manager_dashboard') }}" class="@if ($route_num === 2) active @endif">
        <div class="side-menu-item">物件</div>
    </a>
    <a href="{{ route('manager_dashboard') }}" class="@if ($route_num === 3) active @endif">
        <div class="side-menu-item">業務ユーザー</div>
    </a>
    <a href="{{ route('manager_dashboard') }}" class="@if ($route_num === 4) active @endif">
        <div class="side-menu-item">顧客ユーザー</div>
    </a>
    <a href="{{ route('manager_dashboard') }}" class="@if ($route_num === 5) active @endif">
        <div class="side-menu-item">アクセスログ</div>
    </a>
    <a href="{{ route('manager_dashboard') }}" class="@if ($route_num === 6) active @endif">
        <div class="side-menu-item">スコアインポート</div>
    </a>
</div>
