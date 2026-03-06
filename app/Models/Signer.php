<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signer extends Model
{
    protected $fillable = [
        'type',
        'label',
        'name',
        'role',
    ];
}
