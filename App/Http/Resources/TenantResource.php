<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subdomain' => $this->subdomain,
            'status' => $this->status,
            'system' => [
                'id' => $this->system->id,
                'name' => $this->system->name,
                'icon' => $this->system->icon,
            ],
            'owner' => [
                'id' => $this->owner->id,
                'name' => $this->owner->name,
            ],
            'expires_at' => $this->expires_at,
            'created_at' => $this->created_at,
        ];
    }
}