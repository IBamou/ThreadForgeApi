<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BluePrintResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'user_id' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'tone' => $this->tone,
            'target_platform' => $this->target_platform,
            'max_length' => $this->max_length,
            'structure_rules' => $this->structure_rules,
            'style_rules' => $this->style_rules,
            'hashtag_strategy' => $this->hashtag_strategy,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
