<?php
namespace Modules\Payment\Repositories;

use Carbon\Carbon;
use Modules\Payment\Entities\Payment;

class PaymentRepository
{
    protected $model;

    public function __construct(Payment $payment)
    {
        $this->model = $payment;
    }
    public function getPaymentsWithTotals()
{
    // Get the current date for calculating totals
    $currentDate = now();

    // Fetch all payments with the necessary joins and details
    $payments = Payment::join('invoices', 'payments.id', '=', 'invoices.payment_id')
        ->join('consultations', 'consultations.invoice_id', '=', 'invoices.id')
        ->join('appointments', 'appointments.id', '=', 'consultations.appointment_id')
        ->join('patients', 'patients.id', '=', 'appointments.patient_id')
        ->join('users', 'users.id', '=', 'patients.user_id')
        ->where('appointments.is_consulted', true)
        ->orderBy('payments.created_at', 'desc')
        ->select(
            'payments.id', 'payments.status', 'payments.payment_type',
            'payments.remarks', 'payments.amount', 'payments.created_at',
            'patients.name', 'patients.phone', 'users.img_url'
        )
        ->distinct()
        ->get();
        foreach ($payments as $payment) {
            $imageData = null;
            if ( $payment->img_url) {
                $imagePath = storage_path('app/public/uploads/' . basename($payment->img_url));
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                }else{
                    $imageData = "No DATA!";
                }
            }
            $payment->img_data = $imageData;
        }
    // Calculate total amount for the current day
    $totalAmountToday = Payment::whereDate('created_at', $currentDate->toDateString())
        ->sum('amount');

    // Calculate total amount for the current month
    $totalAmountMonth = Payment::whereMonth('created_at', $currentDate->month)
        ->whereYear('created_at', $currentDate->year)
        ->sum('amount');

    // Calculate total amount for the current year
    $totalAmountYear = Payment::whereYear('created_at', $currentDate->year)
        ->sum('amount');

    $totalAmountTodayFormatted = number_format($totalAmountToday,2);
    $totalAmountMonthFormatted = number_format($totalAmountMonth,2);
    $totalAmountYearFormatted = number_format($totalAmountYear,2);
    // Return the payments along with the totals
    return response()->json([
        'payments' => $payments,
        'totals' => [
            'today' => $totalAmountTodayFormatted,
            'month' => $totalAmountMonthFormatted,
            'year' => $totalAmountYearFormatted
        ]
    ]);
}
    public function getLastFivePayments()
    {
        $payments = Payment::join('invoices', 'payments.id', '=', 'invoices.payment_id')
        ->join('consultations', 'consultations.invoice_id', '=', 'invoices.id')
        ->join('appointments', 'appointments.id', '=', 'consultations.appointment_id')
        ->join('patients', 'patients.id', '=', 'appointments.patient_id')
        ->join('users', 'users.id', '=', 'patients.user_id')
        ->where('appointments.is_consulted', true)
        ->orderBy('payments.created_at','desc')
        ->select ('payments.id','payments.status','payments.payment_type','payments.remarks','payments.amount','payments.created_at','patients.name','patients.phone','users.img_url')
        ->distinct()
        ->take(5)
        ->get();
        foreach ($payments as $payment) {
            $imageData = null;
            if ( $payment->img_url) {
                $imagePath = storage_path('app/public/uploads/' . basename($payment->img_url));
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                }else{
                    $imageData = "No DATA!";
                }
            }
            $payment->img_data = $imageData;
        }
        return $payments ;
    }
    public function totalPaymentCount()
    {
        $monthlyAmounts = [];
        $monthNames = [];

        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths($i);
            $monthName = $month->format('M'); // Get month name like 'Jan', 'Feb', etc.
            $amount = Payment::where('status', 'paid')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');

            $monthNames[] = $monthName;
            $monthlyAmounts[] = $amount;
        }

        $monthlyAmounts = array_reverse($monthlyAmounts);
        $monthNames = array_reverse($monthNames);

        // Calculate the percentage change between the current month and the previous month
        $currentMonth = $monthlyAmounts[count($monthlyAmounts) - 1];
        $previousMonth = $monthlyAmounts[count($monthlyAmounts) - 2];

        if ($previousMonth != 0) {
            $percentageChange = (($currentMonth - $previousMonth) / $previousMonth) * 100;
        } else {
            $percentageChange = $currentMonth * 100; // if previous month is 0, just return current month as percentage
        }
        $percentageChange = number_format($percentageChange, 2);
        $totalAmount = Payment::where('status', 'paid')->sum('amount');

        return [
            'monthNames' => $monthNames,
            'monthlyAmounts' => $monthlyAmounts,
            'percentageChange' => $percentageChange,
            'totalAmount' => $totalAmount,
        ];
    }

}
