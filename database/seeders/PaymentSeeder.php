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
                'payment_date' => Carbon::now()->subDays(35)->format('Y-m-d H:i:s'),
                'discount' => '100000',
                'coupun_number' => '202306280001',
                'payment_type_id' => 1,
                'status_id' => 1,
            ],
            [
                'center_id' => 1,
                'student_id' => 3,
                'payment_date' => Carbon::now()->subDays(33)->format('Y-m-d H:i:s'),
                'discount' => '50000',
                'coupun_number' => '202306280002',
                'payment_type_id' => 1,
                'status_id' => 1,
            ],
            [
                'center_id' => 2,
                'student_id' => 2,
                'payment_type_id' => 1,
                'status_id' => 2,
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
