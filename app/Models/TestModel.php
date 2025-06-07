<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);

    }
}
