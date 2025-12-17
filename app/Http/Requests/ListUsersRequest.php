<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['sometimes', 'nullable', 'string', 'max:255'],
            'page' => ['sometimes', 'integer', 'min:1'],
            'perPage' => ['sometimes', 'integer', 'between:1,100'],
            'sortBy' => ['sometimes', 'string', Rule::in(['name', 'email', 'created_at'])],
            'sortDirection' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
        ];
    }

    /**
     * Prepare sanitized filters for the list users use case.
     *
     * @return array{
     *     search: string|null,
     *     page: int,
     *     perPage: int,
     *     sortBy: string,
     *     sortDirection: 'asc'|'desc'
     * }
     */
    public function filters(): array
    {
        $validated = $this->validated();

        return [
            'search' => $validated['search'] ?? null,
            'page' => $validated['page'] ?? 1,
            'perPage' => $validated['perPage'] ?? 15,
            'sortBy' => $validated['sortBy'] ?? 'created_at',
            'sortDirection' => $validated['sortDirection'] ?? 'desc',
        ];
    }
}
