<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected  $fillable = [
        "title",
        "text",
        "idYTVideo"
    ];

    protected $table = 'notes';

    public function listsOfNotes()
    {
        return $this->belongsToMany('App\Models\NoteList');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
