<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\StackableContent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'remember_token' => 'zl9dSoPU8k',
         ]);

         $stackableContent = StackableContent::create([
             'title' => 'Test Content',
         ]);

         $stackableContent->content_blocks()->create([
             'block_type' => 'rich-editor-block',
         ]);

         $stackableContent->content_blocks()->create([
             'block_type' => 'basic-text-block',
         ]);

        $stackableContent->content_blocks()->create([
            'block_type' => 'rich-editor-block',
        ]);
    }
}
