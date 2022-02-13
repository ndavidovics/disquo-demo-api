<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteComment extends Model
{
    //
    protected $fillable = ['comment','note_id'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
