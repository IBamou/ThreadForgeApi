<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Input extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'raw_input',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
