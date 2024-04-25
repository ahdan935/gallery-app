<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => "admin@example.com",
        ]);

        User::factory()->create([
            'email' => "user@example.com",
        ]);

        Album::factory(20)->create([
            'user_id' => 2,
        ]);

        for ($i=1; $i <= 20; $i++) {
            Photo::factory()->create([
                'path' => 'gallery/1/' . $i . '.jpg',
                'album_id' => 1,
                'user_id' => 2
            ]);
            Like::factory()->create([
                'photo_id' => $i,
                'user_id' => 1,
            ]);
        }

        File::deleteDirectory(storage_path('app\\gallery'));

        File::copyDirectory(public_path('seed'), storage_path('app\\gallery\\1'));

        Comment::factory(10)->create([
            'photo_id' => 1,
            'user_id' => 1
        ]);

        Comment::factory(5)->create([
            'photo_id' => 1,
            'user_id' => 2
        ]);
    }
}
