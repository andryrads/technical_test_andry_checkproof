<?php

namespace App\Repositories;

use App\Models\Order;
use App\Services\Contracts\OrderReadRepository;
use Illuminate\Support\Facades\DB;

class OrderReadRepositoryEloquent implements OrderReadRepository
{
    public function getCountsForUsers(array $userIds): array
    {
        if (empty($userIds)) {
            return [];
        }

        return Order::query()
            ->select('user_id', DB::raw('count(*) as aggregate'))
            ->whereIn('user_id', $userIds)
            ->groupBy('user_id')
            ->pluck('aggregate', 'user_id')
            ->toArray();
    }
}
