<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteList extends Model
{
    use HasFactory;

    protected  $fillable = [
        "title",
        "description",
        "user_id"
    ];

    protected $hidden = [
        'user_id',
    ];

    protected $table = 'lists';

    public function notes()
    {
        return $this->belongsToMany(Note::class, 'list_note', 'list_id', 'note_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
