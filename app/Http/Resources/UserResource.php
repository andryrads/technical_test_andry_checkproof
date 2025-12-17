<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'email' => $this->resource->email,
            'name' => $this->resource->name,
            'role' => $this->resource->role,
            'created_at' => $this->when(
                $this->resource->created_at,
                $this->resource->created_at?->toIso8601String()
            ),
            'orders_count' => (int) ($this->resource->orders_count ?? 0),
            'can_edit' => (bool) ($this->resource->can_edit ?? false),
        ];
    }
}
