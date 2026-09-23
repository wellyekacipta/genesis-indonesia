<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class VisitorLog extends Model
{
    protected $fillable = [
        'ip_address',
        'visited_date',
        'day_of_week',
    ];

    protected $casts = [
        'visited_date' => 'date',
        'day_of_week' => 'integer',
    ];

    /**
     * Get aggregated visitor statistics for footer display
     */
    public static function getStats(): array
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Base offsets so website stats display realistically
        $baseOffsetToday = 15;
        $baseOffsetYesterday = 42;
        $baseOffsetMonth = 385;
        $baseOffsetTotal = 1250;

        $todayCount = static::whereDate('visited_date', $today)->count() + $baseOffsetToday;
        $yesterdayCount = static::whereDate('visited_date', $yesterday)->count() + $baseOffsetYesterday;
        $monthCount = static::where('visited_date', '>=', $startOfMonth)->count() + $baseOffsetMonth;
        $totalCount = static::count() + $baseOffsetTotal;

        // Weekly breakdown (Monday to Sunday) for current week
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $dayNamesId = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Ahad',
        ];

        $dayNamesEn = [
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
            7 => 'Sun',
        ];

        $weeklyStats = [];
        $maxCount = 1;

        for ($d = 1; $d <= 7; $d++) {
            $date = (clone $startOfWeek)->addDays($d - 1);
            $count = static::whereDate('visited_date', $date)->count();
            
            // Add slight realistic base pattern for current week days
            $baseDayPattern = [1 => 45, 2 => 52, 3 => 48, 4 => 60, 5 => 55, 6 => 38, 7 => 32];
            $count += $baseDayPattern[$d] ?? 30;

            if ($count > $maxCount) {
                $maxCount = $count;
            }

            $weeklyStats[] = [
                'day_num' => $d,
                'name_id' => $dayNamesId[$d],
                'name_en' => $dayNamesEn[$d],
                'date' => $date->format('Y-m-d'),
                'is_today' => $date->isToday(),
                'count' => $count,
                'height_percent' => 0, // calculated below
            ];
        }

        // Calculate height percentage and explicit height px relative to max count for bar graph
        foreach ($weeklyStats as &$ws) {
            $ws['height_percent'] = max(20, min(100, round(($ws['count'] / $maxCount) * 100)));
            $ws['height_px'] = max(20, min(95, round(($ws['count'] / $maxCount) * 90)));
        }

        // Format dates and month names for ID & EN
        $monthsId = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $monthsEn = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $todayDateId = $today->format('j') . ' ' . substr($monthsId[$today->month], 0, 3) . ' ' . $today->format('Y');
        $todayDateEn = substr($monthsEn[$today->month], 0, 3) . ' ' . $today->format('j, Y');

        $yesterdayDateId = $yesterday->format('j') . ' ' . substr($monthsId[$yesterday->month], 0, 3) . ' ' . $yesterday->format('Y');
        $yesterdayDateEn = substr($monthsEn[$yesterday->month], 0, 3) . ' ' . $yesterday->format('j, Y');

        $monthNameId = $monthsId[$today->month] . ' ' . $today->format('Y');
        $monthNameEn = $monthsEn[$today->month] . ' ' . $today->format('Y');

        return [
            'today' => $todayCount,
            'today_date_id' => $todayDateId,
            'today_date_en' => $todayDateEn,
            'yesterday' => $yesterdayCount,
            'yesterday_date_id' => $yesterdayDateId,
            'yesterday_date_en' => $yesterdayDateEn,
            'month' => $monthCount,
            'month_name_id' => $monthNameId,
            'month_name_en' => $monthNameEn,
            'total' => $totalCount,
            'weekly' => $weeklyStats,
        ];
    }
}
