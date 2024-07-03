<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class DeleteController extends BaseController
{
    public function __invoke(Product $product)
    {
        $productImageIds = ProductImage::where('product_id', $product->id)->get();

        foreach ($productImageIds as $productImageId) {
            Storage::disk('public')->delete($productImageId->file_path);
        }

        ProductImage::where('id', $product->id)->delete();

        Storage::disk('public')->delete($product->preview_image);
        $product->delete();

        return redirect()->route('product.index');
    }
}
