<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CenterPayment;

class CenterPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $centerPayments = [
            [
                'center_id' => 1,
                'registration_fee_old' => 50000,
                'equipment_fee_old' => 100000,
                'course_fee_old' => 200000,
                'registration_fee_new' => 60000,
                'equipment_fee_new' => 120000,
                'course_fee_new' => 250000,
            ],
            [
                'center_id' => 2,
                'registration_fee_old' => 45000,
                'equipment_fee_old' => 90000,
                'course_fee_old' => 180000,
                'registration_fee_new' => 60000,
                'equipment_fee_new' => 100000,
                'course_fee_new' => 200000,
            ],
        ];

        foreach ($centerPayments as $payment) {
            CenterPayment::create($payment);
        }
    }
}
