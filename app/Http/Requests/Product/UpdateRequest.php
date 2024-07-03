<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required',
            'content' => 'required',
            'preview_image' => 'nullable',
            'price' => 'required|integer',
            'price_old' => 'required|integer',
            'count' => 'required',
            'is_published' => 'nullable',
            'category_id' => 'nullable',
            'group_id' => 'nullable',
            'tags' => 'nullable|array',
            'colors' => 'nullable|array',
            'product_images' => 'nullable|array',
            'product_image_id' => 'nullable|array',
        ];
    }

}
