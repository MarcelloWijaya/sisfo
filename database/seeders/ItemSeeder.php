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
                'price' => 10,
                'description' => 'Book A description',
                'image' => 'book_a.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Book B',
                'price' => 15,
                'description' => 'Book B description',
                'image' => 'book_b.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Book C',
                'price' => 12,
                'description' => 'Book C description',
                'image' => 'book_c.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Book D',
                'price' => 18,
                'description' => 'Book D description',
                'image' => 'book_d.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Book E',
                'price' => 20,
                'description' => 'Book E description',
                'image' => 'book_e.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Book F',
                'price' => 25,
                'description' => 'Book F description',
                'image' => 'book_f.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Book G',
                'price' => 22,
                'description' => 'Book G description',
                'image' => 'book_g.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Book H',
                'price' => 30,
                'description' => 'Book H description',
                'image' => 'book_h.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Pendaftaran Set',
                'price' => 50,
                'description' => 'Pendaftaran Set description',
                'image' => 'pendaftaran_set.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Binder',
                'price' => 8,
                'description' => 'Binder description',
                'image' => 'binder.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Kaos',
                'price' => 15,
                'description' => 'Kaos description',
                'image' => 'kaos.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Tas',
                'price' => 40,
                'description' => 'Tas description',
                'image' => 'tas.jpg',
                'quantity' => 50,
            ],
            [
                'name' => 'Pensil Segitiga',
                'price' => 5,
                'description' => 'Pensil Segitiga description',
                'image' => 'pensil_segitiga.jpg',
                'quantity' => 50,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
