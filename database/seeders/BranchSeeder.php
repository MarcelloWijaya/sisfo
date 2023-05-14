<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class branchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('branchs')->insert([
            [
                'center_name' => 'Taman Semanan Indah',
                'owner' => 'Jeanny Widjaja',
                'address' => 'Ruko blok F no.7 Taman Semanan Indah Duri Kosambi, Cengkareng Jakarta Barat 11750',
                'phone_number' => '08151642307',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
        DB::table('branchs')->insert([
            [
                'center_name' => 'Taman Permata Buana',
                'owner' => 'Jeanny Widjaja',
                'address' => 'Ruko blok A ext 1 no.22 Perum Kosambi Baru Duri Kosambi, Cengkareng Jakarta Barat',
                'phone_number' => '08151642306',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
        DB::table('branchs')->insert([
            [
                'center_name' => 'Perumahan Kosambi Baru',
                'owner' => 'Jeanny Widjaja',
                'address' => 'Ruko blok B9 no.22 Taman Permata Buana Kembangan Utara, Kembangan Jakarta Barat',
                'phone_number' => '083876428833',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
        DB::table('branchs')->insert([
            [
                'center_name' => 'Green Lake City',
                'owner' => 'Jeanny Widjaja',
                'address' => 'Ruko Wallstreet blok B/05 Green Lake City, Tangerang',
                'phone_number' => '087870009678',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
        DB::table('branchs')->insert([
            [
                'center_name' => 'Lippo Mall Puri',
                'owner' => 'Jeanny Widjaja',
                'address' => 'Jl. Puri Indah Raya, RT.3/RW.2, Kembangan Sel., Kec. Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11610',
                'phone_number' => '085700991800',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
