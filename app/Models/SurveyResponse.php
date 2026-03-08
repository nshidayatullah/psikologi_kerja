<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_session_id',
        'batch',
        'date',
        'company',
        'department',
        'position',
        'name',
        'total_score'
    ];

    public function session()
    {
        return $this->belongsTo(SurveySession::class, 'survey_session_id');
    }

    public function answers()
    {
        return $this->hasMany(SurveyResponseAnswer::class);
    }
}
