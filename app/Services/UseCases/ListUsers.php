<?php

namespace App\Services\UseCases;

use App\Services\Contracts\CurrentUserProvider;
use App\Services\Contracts\OrderReadRepository;
use App\Services\Contracts\UserRepository;
use App\Services\Support\UserPermissionService;
use Illuminate\Pagination\LengthAwarePaginator;

class ListUsers
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly OrderReadRepository $orderReads,
        private readonly CurrentUserProvider $currentUserProvider,
        private readonly UserPermissionService $permissionService
    ) {
    }

    /**
     * @param array{
     *     search?: string|null,
     *     page?: int|null,
     *     perPage?: int|null,
     *     sortBy?: string|null,
     *     sortDirection?: 'asc'|'desc'|null
     * } $filters
     */
    public function handle(array $filters): LengthAwarePaginator
    {
        $paginator = $this->users->searchActiveUsers($filters);

        $collection = $paginator->getCollection();
        $userIds = $collection->pluck('id')->all();

        $orderCounts = $userIds ? $this->orderReads->getCountsForUsers($userIds) : [];
        $currentUser = $this->currentUserProvider->getCurrentUser();

        $collection->transform(function ($user) use ($orderCounts, $currentUser) {
            $user->orders_count = $orderCounts[$user->id] ?? 0;
            $user->can_edit = $currentUser
                ? $this->permissionService->canEdit($currentUser, $user)
                : false;

            return $user;
        });

        return $paginator;
    }
}
