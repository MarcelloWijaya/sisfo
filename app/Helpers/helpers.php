<?php

if (!function_exists('getMenuIcon')) {
    function getMenuIcon($menuName)
    {
        $icons = [
            'Dashboard' => 'fa-tachometer-alt',
            'Master Data' => 'fa-database',
            'Academic' => 'fa-book',
            'Finance' => 'fa-money-bill-wave',
            'Reports' => 'fa-chart-line',
            'Settings' => 'fa-cog',
            'HR Management' => 'fa-users',
            'Students' => 'fa-user-graduate',
            'Teachers' => 'fa-chalkboard-teacher',
            'Classes' => 'fa-school',
            'Attendance' => 'fa-clipboard-list',
            'Payments' => 'fa-credit-card',
            'Invoices' => 'fa-file-invoice',
            'Schedule' => 'fa-calendar-alt',
            'Roles' => 'fa-user-tie',
            'Centers' => 'fa-building',
            'Fees' => 'fa-money-bill',
        ];

        return $icons[$menuName] ?? 'fa-circle';
    }
}

if (!function_exists('lang_url')) {
    function lang_url($locale)
    {
        return route('lang.switch', ['locale' => $locale]);
    }
}

if (!function_exists('current_locale')) {
    function current_locale()
    {
        return app()->getLocale();
    }
}
