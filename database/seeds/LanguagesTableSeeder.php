<?php

use Illuminate\Database\Seeder;
use ScaryLayer\Hush\Models\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code' => 'en',
                'name' => 'English'
            ],
            [
                'code' => 'ru',
                'name' => 'Русский'
            ],
            [
                'code' => 'ua',
                'name' => 'Українська'
            ],
        ];

        foreach ($data as $item) {
            Language::create($item);
        }
    }
}