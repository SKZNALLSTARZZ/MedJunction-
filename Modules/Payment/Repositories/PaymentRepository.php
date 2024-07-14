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

    public function getLastFivePayments()
    {
        return Payment::join('invoices', 'payments.id', '=', 'invoices.payment_id')
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
