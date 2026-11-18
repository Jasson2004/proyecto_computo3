<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:200'],
            'category_id' => ['required', 'exists:categories,id'],
            'activity_date' => ['required', 'date'],
            'excerpt' => ['nullable', 'string', 'max:350'],
            'content' => ['required', 'string', 'min:30'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'authors' => ['required', 'array', 'min:1'],
            'authors.*' => ['exists:users,id'],
            'action' => ['required', 'in:draft,published'],
            'evidences' => ['nullable', 'array'],
            'evidences.*.file' => ['required_with:evidences', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'evidences.*.participant_name' => ['required_with:evidences', 'string', 'max:120'],
            'evidences.*.evidence_type' => ['required_with:evidences', 'in:fotografia,constancia,asistencia'],
            'evidences.*.caption' => ['nullable', 'string', 'max:255'],
        ];
    }
}