<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $students = [
            [
                'card_id' => 'X4pHnRb5mdARU014zdKA',
                'name' => 'Valentina Banyu Bening',
                'customer_id' => '18067',
                'phone_number' => '085956522252',
                'email' => 'Valentina Banyu Bening@gmail.com',
            ],
            [
                'card_id' => 'LVNQZPif9a1SjKPmX5GQ',
                'name' => 'Verena Inez Mirari Koentjoro',
                'customer_id' => '18006',
                'phone_number' => '082213511122',
                'email' => 'Verena Inez Mirari Koentjoro@gmail.com',
            ],
            [
                'card_id' => 'DIKNfa9MGaB5d6xhT7Bt',
                'name' => 'Wihelmina Alni Putri',
                'customer_id' => '18007',
                'phone_number' => '081328495986',
                'email' => 'Valentina Banyu Bening@gmail.com',
            ],
            [
                'card_id' => '8UD4O11oAfTBSbodEJmn',
                'name' => 'Yudith Valentino Pratama Putra',
                'customer_id' => '18008',
                'phone_number' => '082153663451',
                'email' => 'Yudith Valentino Pratama Putra@gmail.com',
            ],
        ];

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($students as $student) {
            $student['created_at'] = $now;
            $student['updated_at'] = $now;
            DB::table('students')->insert($student);
        }
    }
}
