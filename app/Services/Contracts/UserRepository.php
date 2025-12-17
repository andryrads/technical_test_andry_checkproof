<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository
{
    /**
     * Persist a new user. Password should be hashed before persisting.
     */
    public function create(array $attributes): User;

    /**
     * Fetch active users with optional search and sorting.
     *
     * @param array{
     *     search?: string|null,
     *     sortBy?: string|null,
     *     sortDirection?: 'asc'|'desc'|null,
     *     page?: int|null,
     *     perPage?: int|null
     * } $filters
     */
    public function searchActiveUsers(array $filters): LengthAwarePaginator;
}
