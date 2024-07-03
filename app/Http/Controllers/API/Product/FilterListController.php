<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Color\ColorResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Tag;

class FilterListController extends Controller
{
    public function __invoke(Product $product)
    {

        $result = [
            'categories' => CategoryResource::collection(Category::all()),
            'colors' => ColorResource::collection(Color::all()),
            'tags' => TagResource::collection(Tag::all()),
            'price' => [
                'max' => Product::max('price'),
                'min' => Product::min('price'),
            ],
        ];

        return response()->json($result);
    }
}
