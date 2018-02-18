<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Questionnaire extends Model
{
    protected $fillable = ['user_id'];
    //
    public function answers() {
        return $this->hasMany(QuestionnaireAnswer::class, 'questionnaire_id');
    }

    public function user() {
        return $this->belongsTo(User::class(), 'user_id');
    }
}
