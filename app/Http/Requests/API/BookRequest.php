<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'count' => 'required|integer|gt:0',
            'price' => 'required|integer|gt:0',
            'authors' => ((User::ROLE_AUTHOR != Auth::user()->role) ? 'required|array' : ''),
            'authors.*' => ((User::ROLE_AUTHOR != Auth::user()->role) ? 'integer' : '')
        ];
    }

    public function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 400));

    }

}