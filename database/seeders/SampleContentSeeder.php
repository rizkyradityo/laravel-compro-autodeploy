<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Service;
use Illuminate\Database\Seeder;

class SampleContentSeeder extends Seeder
{
    public function run(): void
    {
        Page::create([
            'type' => 'home',
            'title' => 'Welcome',
            'slug' => 'home',
            'content' => 'Quality services',
            'published' => true,
        ]);

        Service::create([
            'name' => 'Web Development',
            'slug' => 'web-dev',
            'description' => 'Web development services',
            'published' => true,
        ]);

        $this->command?->info('Sample content seeded!');
    }
}

