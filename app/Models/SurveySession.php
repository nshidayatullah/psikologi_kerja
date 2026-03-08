<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class SurveySession extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'uuid', 'is_active', 'recommendations', 'pic1_name', 'pic1_role', 'pic2_name', 'pic2_role', 'reviewer_name', 'reviewer_role', 'follow_up_plan', 'pic1_signature', 'pic2_signature', 'reviewer_signature'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
