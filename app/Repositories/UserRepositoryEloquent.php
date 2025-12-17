<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\Contracts\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepositoryEloquent implements UserRepository
{
    public function create(array $attributes): User
    {
        return User::create($attributes);
    }

    public function searchActiveUsers(array $filters): LengthAwarePaginator
    {
        $search = $filters['search'] ?? null;
        $sortBy = $filters['sortBy'] ?? 'created_at';
        $sortDirection = $filters['sortDirection'] ?? 'desc';
        $page = $filters['page'] ?? 1;
        $perPage = $filters['perPage'] ?? 15;

        $query = User::query()
            ->where('active', true)
            ->when($search, function (Builder $q) use ($search) {
                $q->where(function (Builder $q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy($sortBy, $sortDirection);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}
