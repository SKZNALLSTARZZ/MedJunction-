<?php
namespace Modules\Prescription\Repositories;

use Carbon\Carbon;
use Modules\Prescription\Entities\Prescription;

class PrescriptionRepository
{
    protected $model;

    public function __construct(Prescription $prescription)
    {
        $this->model = $prescription;
    }

    public function totalPrescriptionCount()
{
    $monthlyCounts = [];

    for ($i = 0; $i < 12; $i++) {
        $count = Prescription::whereYear('created_at', Carbon::now()->subMonths($i)->year)
                             ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                             ->count();
        $monthlyCounts[] = $count;
    }

    $monthlyCounts = array_reverse($monthlyCounts);


    $currentMonthCount = $monthlyCounts[count($monthlyCounts) - 1];
    $previousMonthCount = $monthlyCounts[count($monthlyCounts) - 2];

    if ($previousMonthCount != 0) {
        $percentageChange = (($currentMonthCount - $previousMonthCount) / $previousMonthCount) * 100;
    } else {
        $percentageChange = $currentMonthCount * 100;
    }
    $percentageChange = number_format($percentageChange, 2);
    $totalCount = Prescription::count();

    return [
        'monthlyCounts' => $monthlyCounts,
        'percentageChange' => $percentageChange,
        'totalCount' => $totalCount,
    ];
}
}
