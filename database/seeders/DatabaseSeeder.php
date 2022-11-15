<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Note;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $notes = Note::factory(7)->create([
            'user_id' => $user->id,
        ]);

        $this->call(NoteListSeeder::class);

        foreach ($notes as $note) {
            $note->lists()->attach(rand(1, 3));
        }
    }
}
