<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $teachers = [
            [
                'center_id' => 1,
                'entry_date' => '2022-01-01',
                'name' => 'Natasya Zeniah Adini',
                'nickname' => 'Caca',
                'gender' => 'Wanita',
                'address' => 'Kp. Ketapang rt.01/rw.03 kec. Cipondoh Kota. Tangerang',
                'place_of_birth' => 'Tangerang',
                'date_of_birth' => '2003-07-15',
                'religion' => 'Islam',
                'phone_number' => '089506425185',
                'last_education' => 'SMA',
                'email' => null,
                'training_date' => '2021-09-01',
                'status_id' => 1,
            ],
            [
                'center_id' => 2,
                'entry_date' => '2022-01-01',
                'name' => 'Nurul Lidiawanti',
                'nickname' => 'Nurul',
                'gender' => 'Wanita',
                'address' => 'Jln. Humar bidong 1 rt03/04 ketapang cipondoh, tangerang selatan',
                'place_of_birth' => 'Ciamis',
                'date_of_birth' => '1995-05-11',
                'religion' => 'Islam',
                'phone_number' => '087744135696',
                'last_education' => 'Paket C',
                'email' => null,
                'training_date' => '2022-11-30',
                'status_id' => 1,
            ],
            [
                'center_id' => 3,
                'entry_date' => '2022-01-01',
                'name' => 'Maratul Lutfia',
                'nickname' => 'Fia',
                'gender' => 'Wanita',
                'address' => 'Jl.Pedongkelan belakang Blok F NO.61 kapuk cengkareng jak-bar',
                'place_of_birth' => 'Tangerang',
                'date_of_birth' => '2000-12-08',
                'religion' => 'Islam',
                'phone_number' => '0895383037755',
                'last_education' => 'SMK',
                'email' => null,
                'training_date' => '2021-09-01',
                'status_id' => 1,
            ],
            [
                'center_id' => 4,
                'entry_date' => '2022-01-01',
                'name' => 'Mia Widianingsih',
                'nickname' => 'Mia',
                'gender' => 'Wanita',
                'address' => 'Jl. Kapuk Muara RT 013 RW 004 Penjaringan, Jakarta Utara',
                'place_of_birth' => 'Cilacap',
                'date_of_birth' => '2003-11-23',
                'religion' => 'Islam',
                'phone_number' => '089654822502',
                'last_education' => 'SMK',
                'email' => 'miawidia03@gmail.com',
                'training_date' => '2022-11-30',
                'status_id' => 1,
            ],
            [
                'center_id' => 4,
                'entry_date' => '2022-01-01',
                'name' => 'Febriana Eka',
                'nickname' => 'Ana',
                'gender' => 'Wanita',
                'address' => 'JL.Sunter Muara RT 013 RW 005 Kel. Sunter Agung Kec. Tanjung Priok',
                'place_of_birth' => 'Madiun',
                'date_of_birth' => '2002-02-25',
                'religion' => 'Islam',
                'phone_number' => '0858-1123-9812',
                'last_education' => 'SMA',
                'email' => null,
                'training_date' => '2021-10-12',
                'status_id' => 1,
            ],
            [
                'center_id' => 5,
                'entry_date' => '2022-01-01',
                'name' => 'Okta Nur Fitriani',
                'nickname' => 'Tata',
                'gender' => 'Wanita',
                'address' => 'Jl Dharma wanita 1 RT. 011 RW 001 Rawa Buaya Cengkareng Jakarta Barat',
                'place_of_birth' => 'Purworejo',
                'date_of_birth' => '2002-10-19',
                'religion' => 'Islam',
                'phone_number' => '085601115950',
                'last_education' => 'SMK Akuntansi dan Keuangan Lembaga',
                'email' => null,
                'training_date' => '2022-08-08',
                'status_id' => 1,
            ],

        ];

        foreach ($teachers as $teacher) {
            DB::table('teachers')->insert($teacher);
        }
    }
}
