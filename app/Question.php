<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute() {
        return route('questions.show', $this->id);
    }

    public function getCreatedDateAttribute() // it calls Mutator
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if (isset($this->best_answer_id)) {
            return 'answered-accepted';
        }
        if ($this->answers > 0) {
            return 'answered';
        }
        return 'unanswered';
    }
}