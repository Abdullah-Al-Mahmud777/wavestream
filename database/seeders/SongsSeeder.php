<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\Category;
use Illuminate\Database\Seeder;

class SongsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user
        $admin = \App\Models\User::where('is_admin', true)->first();
        
        if (!$admin) {
            $this->command->error('Admin user not found! Please run AdminUserSeeder first.');
            return;
        }

        // Create categories if they don't exist
        $hindi = Category::firstOrCreate(
            ['name' => 'Hindi'],
            [
                'name' => 'Hindi',
                'slug' => 'hindi',
                'description' => 'Hindi Songs',
                'is_active' => true
            ]
        );
        
        $english = Category::firstOrCreate(
            ['name' => 'English'],
            [
                'name' => 'English',
                'slug' => 'english',
                'description' => 'English Songs',
                'is_active' => true
            ]
        );
        
        $bangla = Category::firstOrCreate(
            ['name' => 'Bangla'],
            [
                'name' => 'Bangla',
                'slug' => 'bangla',
                'description' => 'Bangla Songs',
                'is_active' => true
            ]
        );

        // 10 Hindi Songs
        $hindiSongs = [
            [
                'title' => 'Tum Hi Ho',
                'artist' => 'Arijit Singh',
                'album' => 'Aashiqui 2',
                'duration' => 262, // 4:22
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Channa Mereya',
                'artist' => 'Arijit Singh',
                'album' => 'Ae Dil Hai Mushkil',
                'duration' => 289, // 4:49
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Kal Ho Naa Ho',
                'artist' => 'Sonu Nigam',
                'album' => 'Kal Ho Naa Ho',
                'duration' => 320, // 5:20
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Tere Naam',
                'artist' => 'Udit Narayan',
                'album' => 'Tere Naam',
                'duration' => 334, // 5:34
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Kabira',
                'artist' => 'Tochi Raina & Rekha Bhardwaj',
                'album' => 'Yeh Jawaani Hai Deewani',
                'duration' => 258, // 4:18
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Raabta',
                'artist' => 'Arijit Singh',
                'album' => 'Agent Vinod',
                'duration' => 243, // 4:03
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Pehla Nasha',
                'artist' => 'Udit Narayan',
                'album' => 'Jo Jeeta Wohi Sikandar',
                'duration' => 341, // 5:41
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Dil Diyan Gallan',
                'artist' => 'Atif Aslam',
                'album' => 'Tiger Zinda Hai',
                'duration' => 236, // 3:56
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Gerua',
                'artist' => 'Arijit Singh & Antara Mitra',
                'album' => 'Dilwale',
                'duration' => 267, // 4:27
                'category_id' => $hindi->id,
            ],
            [
                'title' => 'Kesariya',
                'artist' => 'Arijit Singh',
                'album' => 'Brahmastra',
                'duration' => 268, // 4:28
                'category_id' => $hindi->id,
            ],
        ];

        // 10 English Songs
        $englishSongs = [
            [
                'title' => 'Shape of You',
                'artist' => 'Ed Sheeran',
                'album' => 'Divide',
                'duration' => 233, // 3:53
                'category_id' => $english->id,
            ],
            [
                'title' => 'Blinding Lights',
                'artist' => 'The Weeknd',
                'album' => 'After Hours',
                'duration' => 200, // 3:20
                'category_id' => $english->id,
            ],
            [
                'title' => 'Someone Like You',
                'artist' => 'Adele',
                'album' => '21',
                'duration' => 285, // 4:45
                'category_id' => $english->id,
            ],
            [
                'title' => 'Perfect',
                'artist' => 'Ed Sheeran',
                'album' => 'Divide',
                'duration' => 263, // 4:23
                'category_id' => $english->id,
            ],
            [
                'title' => 'Levitating',
                'artist' => 'Dua Lipa',
                'album' => 'Future Nostalgia',
                'duration' => 203, // 3:23
                'category_id' => $english->id,
            ],
            [
                'title' => 'Stay',
                'artist' => 'The Kid LAROI & Justin Bieber',
                'album' => 'Stay',
                'duration' => 141, // 2:21
                'category_id' => $english->id,
            ],
            [
                'title' => 'Believer',
                'artist' => 'Imagine Dragons',
                'album' => 'Evolve',
                'duration' => 204, // 3:24
                'category_id' => $english->id,
            ],
            [
                'title' => 'Memories',
                'artist' => 'Maroon 5',
                'album' => 'Memories',
                'duration' => 189, // 3:09
                'category_id' => $english->id,
            ],
            [
                'title' => 'Happier',
                'artist' => 'Marshmello & Bastille',
                'album' => 'Happier',
                'duration' => 214, // 3:34
                'category_id' => $english->id,
            ],
            [
                'title' => 'Counting Stars',
                'artist' => 'OneRepublic',
                'album' => 'Native',
                'duration' => 257, // 4:17
                'category_id' => $english->id,
            ],
        ];

        // 10 Bangla Songs
        $banglaSongs = [
            [
                'title' => 'Tumi Jake Bhalobasho',
                'artist' => 'Kishore Kumar',
                'album' => 'Praktan',
                'duration' => 255, // 4:15
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Tomake Chai',
                'artist' => 'Arijit Singh',
                'album' => 'Gangster',
                'duration' => 282, // 4:42
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Ei Meghla Din',
                'artist' => 'Hemanta Mukherjee',
                'album' => 'Classic Bengali',
                'duration' => 238, // 3:58
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Chokher Bali',
                'artist' => 'Shreya Ghoshal',
                'album' => 'Chokher Bali',
                'duration' => 312, // 5:12
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Ami Je Tomar',
                'artist' => 'Shreya Ghoshal',
                'album' => 'Bhool Bhulaiyaa',
                'duration' => 275, // 4:35
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Bheegi Bheegi',
                'artist' => 'Anupam Roy',
                'album' => 'Piku',
                'duration' => 227, // 3:47
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Tomar Amar',
                'artist' => 'Arijit Singh',
                'album' => 'Praktan',
                'duration' => 268, // 4:28
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Phire Faqir',
                'artist' => 'Arijit Singh',
                'album' => 'Chotushkone',
                'duration' => 295, // 4:55
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Ekla Cholo Re',
                'artist' => 'Rabindranath Tagore',
                'album' => 'Rabindra Sangeet',
                'duration' => 222, // 3:42
                'category_id' => $bangla->id,
            ],
            [
                'title' => 'Amar Sonar Bangla',
                'artist' => 'Rabindranath Tagore',
                'album' => 'National Anthem',
                'duration' => 170, // 2:50
                'category_id' => $bangla->id,
            ],
        ];

        // Insert all songs
        foreach ($hindiSongs as $song) {
            $song['file_path'] = 'songs/dummy.mp3';
            $song['cover_image'] = 'https://via.placeholder.com/300x300/1db954/ffffff?text=Hindi+Song';
            $song['user_id'] = $admin->id;
            Song::updateOrCreate(
                ['title' => $song['title'], 'artist' => $song['artist']],
                $song
            );
        }

        foreach ($englishSongs as $song) {
            $song['file_path'] = 'songs/dummy.mp3';
            $song['cover_image'] = 'https://via.placeholder.com/300x300/3b82f6/ffffff?text=English+Song';
            $song['user_id'] = $admin->id;
            Song::updateOrCreate(
                ['title' => $song['title'], 'artist' => $song['artist']],
                $song
            );
        }

        foreach ($banglaSongs as $song) {
            $song['file_path'] = 'songs/dummy.mp3';
            $song['cover_image'] = 'https://via.placeholder.com/300x300/f59e0b/ffffff?text=Bangla+Song';
            $song['user_id'] = $admin->id;
            Song::updateOrCreate(
                ['title' => $song['title'], 'artist' => $song['artist']],
                $song
            );
        }

        $this->command->info('Successfully seeded 30 songs (10 Hindi, 10 English, 10 Bangla)!');
    }
}
