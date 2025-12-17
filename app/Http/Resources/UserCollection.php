<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        $paginator = $this->resource;

        return [
            'page' => method_exists($paginator, 'currentPage') ? $paginator->currentPage() : 1,
            'per_page' => method_exists($paginator, 'perPage') ? $paginator->perPage() : $this->collection->count(),
            'total' => method_exists($paginator, 'total') ? $paginator->total() : $this->collection->count(),
            'users' => $this->collection,
        ];
    }
}
