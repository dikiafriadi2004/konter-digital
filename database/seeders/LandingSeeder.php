<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('landing')->insert([
            [
                'title' => 'Selamat Datang di Aplikasi Kami',
                'subtitle' => 'Aplikasi server pulsa dan e-wallet terbaik untuk kebutuhanmu.',
                'cta_google_play' => 'https://play.google.com/store/apps/details?id=com.example.app',
                'image' => 'front/asset/img/konterdigital.png', // pastikan path sesuai folder public/storage
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
