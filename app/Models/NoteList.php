<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteList extends Model
{
    use HasFactory;

    protected  $fillable = [
        "name",
        "description",
    ];

    protected $table = 'lists';

    public function notes()
    {
        return $this->belongsToMany('App\Models\Notes');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
