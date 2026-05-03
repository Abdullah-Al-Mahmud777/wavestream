
Wavestream - Music Streaming Platform

Wavestream is a modern music streaming platform built with Laravel and Bootstrap. It allows users to upload, stream, and manage their music collection.
 Features

Music Upload & Streaming
Beautiful Modern UI
Responsive Design
User Authentication
Playlist Management
User Feedback System
Audio Player with Controls
Search Functionality
User Profiles

Technologies Used

Backend:
   PHP 8.0+
   Laravel 12.x
   MySQL Database
   getID3 Library (for audio metadata)

Frontend:
    HTML5
    CSS3
    JavaScript
    Bootstrap 5
    Font Awesome Icons

 Requirements

- PHP >= 8.0
- Composer
- MySQL
- Node.js & NPM
- XAMPP/WAMP/MAMP (for local development)

## Installation




2. Install PHP dependencies:**
    bash
   composer install
   

3. Install Node.js dependencies:**
   bash
   npm install


4. Create environment file:
   bash
   cp .env.example .env
   

5. Generate application key:**
   bash
   php artisan key:generate
   


     

6. Run migrations:
   bash
   php artisan migrate
   

7. Create storage link:
   bash
   php artisan storage:link
   

8. Start the development server:
    bash
   php artisan serve
   




 Key Features Implementation

Music Upload
Supports MP3 and WAV formats
Automatic metadata extraction
Cover image upload
File size validation

 Playlist Management
 Create custom playlists
 Add/remove songs
 Edit playlist details
 Delete playlists

 User Features
 Registration and login
 Profile management
 Song favorites
 Playlist creation

 Audio Player
 Play/pause functionality
 Progress bar
 Volume control
 Now playing information


