<?php

declare(strict_types=1);

namespace App\Enums;

enum ChartType: string
{
    case HOURS_ONE = 'one_hour';
    case HOURS_SIX = 'six_hours';
    case DAYS_ONE = 'one_day';
    case DAYS_THREE = 'three_days';
    case DAYS_SEVEN = 'seven_days';
    case MONTHS_ONE = 'one_month';
    case MONTHS_THREE = 'three_months';
    case YEARS_ONE = 'one_year';
    case YEARS_THREE = 'three_years';
}
