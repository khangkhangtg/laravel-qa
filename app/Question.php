<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use VotableTrait;

    protected $fillable = ['title', 'body', 'user_id'];

    protected $appends = ['created_date'];

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
        return route('questions.show', $this->slug);
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
        if ($this->answers_count > 0) {
            return 'answered';
        }
        return 'unanswered';
    }

    public function getBodyHTMLAttribute() {
        return clean($this->bodyHtml());
    }

    private function bodyHtml () { // use Purifier
        return \Parsedown::instance()->text($this->body);
    }

    public function getExcerptAttribute () {
        return $this->excerpt(250);
    }

    public function excerpt ($length) { // prevent to XSS attack on index
        return str_limit(strip_tags($this->bodyHtml()), $length);
    }

    public function answers () {
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'desc');
    }

    public function acceptBestAnswer (Answer $answer) {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function isFavorited() {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute() {
        return $this->favorites()->count();
    }
}
