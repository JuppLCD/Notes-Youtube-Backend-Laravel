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
        "idYTVideo",
        "user_id"
    ];

    protected $hidden = [
        'user_id',
    ];

    protected $table = 'notes';

    public function lists()
    {
        return $this->belongsToMany('App\Models\NoteList', 'list_note',  'note_id', 'list_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
