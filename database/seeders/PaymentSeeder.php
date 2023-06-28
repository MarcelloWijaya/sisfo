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
                'payment_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'status' => 'paid',
            ],
            [
                'center_id' => 2,
                'payment_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'status' => 'unpaid',
            ],
            [
                'center_id' => 3,
                'payment_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'status' => 'paid',
            ],
            [
                'center_id' => 4,
                'payment_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'status' => 'unpaid',
            ],
            [
                'center_id' => 5,
                'payment_date' => Carbon::now()->format('Y-m-d'),
                'status' => 'paid',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
