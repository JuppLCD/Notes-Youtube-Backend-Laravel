<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\NoteList;

class NoteListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NoteList::factory()->create([
            'title' => 'All Notes (default)',
            'description' => "Note list created by default"
        ]);

        NoteList::factory()->create([
            'title' => 'Programming',
        ]);

        NoteList::factory()->create([
            'title' => 'Maths',
        ]);
    }
}
