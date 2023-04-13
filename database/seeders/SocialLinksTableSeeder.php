<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socialLinks = [
            [
                'fa_icon' => 'facebook',
                'link' => ''
            ],
            [
                'fa_icon' => 'twitter',
                'link' => ''
            ],
            [
                'fa_icon' => 'linkedin',
                'link' => ''
            ],
            [
                'fa_icon' => 'google-plus',
                'link' => ''
            ],
        ];

        foreach ($socialLinks as $link) {
            SocialLink::create($link);
        }
    }
}
