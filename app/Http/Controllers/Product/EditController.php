<?php

namespace App\Http\Controllers\Product;

use App\Models\Category;
use App\Models\Color;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;

class EditController extends BaseController
{
    public function __invoke(Product $product)
    {
        $tags = Tag::all();
        $colors = Color::all();
        $categories = Category::all();
        $groups = Group::all();
        $productImages = ProductImage::where('product_id', $product->id)->get();

        return view('product.edit', compact('product', 'tags', 'colors', 'categories', 'groups', 'productImages'));
    }
}
