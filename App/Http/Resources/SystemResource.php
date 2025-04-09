<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SystemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'icon' => asset("storage/icons/{$this->icon}"),
            'entry_point' => $this->entry_point,
            'is_active' => $this->is_active,
            'is_public' => $this->is_public,
            'access' => $this->whenLoaded('pivot', [
                'role' => $this->pivot->role,
                'permissions' => json_decode($this->pivot->permissions, true)
            ]),
            'created_at' => $this->created_at,
        ];
    }
}