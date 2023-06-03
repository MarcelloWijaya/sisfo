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
                'registration_fee' => 50000,
                'equipment_fee' => 100000,
                'course_fee' => 200000,
            ],
            [
                'center_id' => 1,
                'registration_fee' => 60000,
                'equipment_fee' => 120000,
                'course_fee' => 250000,
            ],
            [
                'center_id' => 2,
                'registration_fee' => 45000,
                'equipment_fee' => 90000,
                'course_fee' => 180000,
            ],
            // Tambahkan data biaya pusat untuk cabang lain jika diperlukan
        ];

        foreach ($centerPayments as $payment) {
            CenterPayment::create($payment);
        }
    }
}
