<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blueprint extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'description',
        'tone', 'target_platform', 'max_length',
        'structure_rules', 'style_rules', 'hashtag_strategy',
    ];

    protected $casts = [
        'structure_rules' => 'array',
        'style_rules' => 'array',
        'hashtag_strategy' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
