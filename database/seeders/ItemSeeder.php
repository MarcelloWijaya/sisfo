<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Book A',
                'quantity' => 50,
                'price' => 100000,
                'description' => 'Book A description',
                'image' => 'book-a.png',
            ],
            [
                'name' => 'Book B',
                'quantity' => 50,
                'price' => 150000,
                'description' => 'Book B description',
                'image' => 'book-b.png',
            ],
            [
                'name' => 'Book C',
                'quantity' => 50,
                'price' => 120000,
                'description' => 'Book C description',
                'image' => 'book-c.png',
            ],
            [
                'name' => 'Book D',
                'quantity' => 50,
                'price' => 180000,
                'description' => 'Book D description',
                'image' => 'book-d.png',
            ],
            [
                'name' => 'Book E',
                'quantity' => 50,
                'price' => 200000,
                'description' => 'Book E description',
                'image' => 'book-e.png',
            ],
            [
                'name' => 'Book F',
                'quantity' => 50,
                'price' => 250000,
                'description' => 'Book F description',
                'image' => 'book-f.png',
            ],
            [
                'name' => 'Book G',
                'quantity' => 50,
                'price' => 220000,
                'description' => 'Book G description',
                'image' => 'book-g.png',
            ],
            [
                'name' => 'Book H',
                'quantity' => 50,
                'price' => 300000,
                'description' => 'Book H description',
                'image' => 'book-h.png',
            ],
            [
                'name' => 'Pendaftaran Set',
                'quantity' => 50,
                'price' => 500000,
                'description' => 'Pendaftaran Set description',
                'image' => 'pendaftaran-set.png',
            ],
            [
                'name' => 'Binder',
                'price' => 800000,
                'description' => 'Binder description',
                'image' => 'binder.png',
                'quantity' => 50,
            ],
            [
                'name' => 'Kaos',
                'quantity' => 50,
                'price' => 150000,
                'description' => 'Kaos description',
                'image' => 'kaos.png',
            ],
            [
                'name' => 'Tas',
                'quantity' => 50,
                'price' => 400000,
                'description' => 'Tas description',
                'image' => 'tas.png',
            ],
            [
                'name' => 'Pensil Segitiga',
                'quantity' => 50,
                'price' => 50000,
                'description' => 'Pensil Segitiga description',
                'image' => 'pensil-segitiga.png',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
