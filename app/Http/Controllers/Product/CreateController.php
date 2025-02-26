<?php

namespace App\Http\Controllers\Product;

use App\Models\Category;
use App\Models\Color;
use App\Models\Tag;

class CreateController extends BaseController
{
    public function __invoke()
    {
        $tags = Tag::all();
        $colors = Color::all();
        $categories = Category::all();
        return view('product.create', compact('tags', 'colors', 'categories'));
    }
}
