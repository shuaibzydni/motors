<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            'seller',
            'buyer'
        ];

        $faqs = [
            [
                'question' => 'Lorem ipsum is a dummy text content in a paragraph?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ],
            [
                'question' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium?',
                'answer' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            ]
        ];

        foreach ($models as $model) {
            foreach ($faqs as $faq) {
                Faq::create([
                    'type' => $model,
                    'question' => $faq['question'],
                    'answer' => $faq['answer']
                ]);
            }
        }
    }
}
