<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'name' => 'ABT Taman Semanan',
                'code' => 'ABT001',
                'phone' => '+62 815 1642 307',
            ],

            [
                'name' => 'ABT Kosambi Baru',
                'code' => 'ABT002',
                'phone' => '+62 838 7642 8833',
            ],

            [
                'name' => 'ABT Green Lake City',
                'code' => 'ABT003',
                'phone' => '+62 878 7000 9678',
            ],

            [
                'name' => 'ABT Lippo Mall Puri',
                'code' => 'ABT004',
                'phone' => '+62 857 0099 1800',
            ],

            [
                'name' => 'ABT Permata Buana',
                'code' => 'ABT005',
                'phone' => '+62 815 1642 306',
            ],

            [
                'name' => 'ABT Citra 2 Extension',
                'code' => 'ABT006',
                'phone' => '+62 857 0099 3800',
            ],

            [
                'name' => 'ABT Tokyo Hub PIK 2',
                'code' => 'ABT007',
                'phone' => '+62 857 0099 5100',
            ],

            [
                'name' => 'ABT Lippo Plaza Bogor',
                'code' => 'ABT008',
                'phone' => '+62 857 0099 4100',
            ],

            [
                'name' => 'ABT ITC Depok',
                'code' => 'ABT009',
                'phone' => '+62 815 3333 6899',
            ],
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                [
                    'code' => $branch['code'],
                ],
                [
                    'name' => $branch['name'],

                    'phone' => $branch['phone'],

                    'address' => null,

                    'email' => null,

                    'operational_hours' => [
                        'monday_friday' => [
                            'open' => '10:00',
                            'close' => '18:30',
                        ],

                        'saturday' => [
                            'open' => '08:00',
                            'close' => '14:00',
                        ],
                    ],

                    'status' => 'active',
                ],
            );
        }
    }
}
