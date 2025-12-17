<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'name' => ['required', 'string', 'min:3', 'max:50'],
        ];
    }

    /**
     * Shape the validated payload for the create user use case.
     *
     * @return array{email:string,password:string,name:string}
     */
    public function toPayload(): array
    {
        $validated = $this->validated();

        return [
            'email' => $validated['email'],
            'password' => $validated['password'],
            'name' => $validated['name'],
        ];
    }

    /**
     * Response of Validation Error
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
