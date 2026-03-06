<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question_category_id', 'number', 'body', 'is_active'];

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'question_category_id');
    }
}
