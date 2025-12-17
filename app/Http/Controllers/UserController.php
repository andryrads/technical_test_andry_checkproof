<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ListUsersRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\UseCases\CreateUser;
use App\Services\UseCases\ListUsers;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly CreateUser $createUser,
        private readonly ListUsers $listUsers
    ) {
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->createUser->handle($request->toPayload());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function index(ListUsersRequest $request): UserCollection
    {
        $result = $this->listUsers->handle($request->filters());

        return new UserCollection($result);
    }
}
