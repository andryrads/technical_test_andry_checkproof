<?php

namespace App\Services\Contracts;

interface OrderReadRepository
{
    /**
     * Return an associative array of user id to orders count.
     *
     * @param int[] $userIds
     * @return array<int,int>
     */
    public function getCountsForUsers(array $userIds): array;
}
