<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        $payments = [
            [
                'center_id' => 1,
                'student_id' => 1,
                'payment_date' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'),
                'status' => 'Paid',
            ],
            [
                'center_id' => 2,
                'student_id' => 2,
                'payment_date' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
                'status' => 'Unpaid',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
