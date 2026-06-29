<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id', 'configuration_id', 'title',
        'hook_proposal', 'body_points', 'suggested_hashtags',
        'technical_readability_score', 'tone_compliance_justification',
        'process_status', 'status', 'ai_payload',
    ];

    protected $casts = [
        'body_points' => 'array',
        'suggested_hashtags' => 'array',
        'ai_payload' => 'array',
    ];

    public function configuration(): BelongsTo
    {
        return $this->belongsTo(Configuration::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
