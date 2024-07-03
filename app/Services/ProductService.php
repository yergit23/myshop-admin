<?php

namespace App\Services;

use App\Models\ProductImage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function update($data, $product)
    {
        try {
            DB::beginTransaction();
            if (isset($data['tags'])) {
                $tagIds = $data['tags'];
                unset($data['tags']);
            }

            if (isset($data['colors'])) {
                $colorIds = $data['colors'];
                unset($data['colors']);
            }

            if (isset($data['preview_image'])) {
                Storage::disk('public')->delete($product->preview_image);
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }

            if (isset($data['product_images'])) {
                $productImages = $data['product_images'];
                unset($data['product_images']);
            }

            if (isset($data['product_image_id'])) {
                $productImageIds = $data['product_image_id'];
                unset($data['product_image_id']);
            }

            if (isset($productImages)) {
                $filterImages = array_keys($productImages);
                $filterImageIds = array_keys($productImageIds);

                $imageWithoutIds = array_diff($filterImageIds, $filterImages);
                $foundImageIds = Arr::except($productImageIds, $imageWithoutIds);

                foreach ($foundImageIds as $foundImageId) {

                    $currentImage = ProductImage::where('id', $foundImageId)->first();

                    Storage::disk('public')->delete($currentImage->file_path);

                    ProductImage::where('id', $foundImageId)->delete();
                }

                foreach ($productImages as $productImage) {

                    $filePath = Storage::disk('public')->put('/fileImg', $productImage);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'file_path' => $filePath,
                    ]);
                }
            }

            $product->update($data);

            if (isset($tagIds)) {
                $product->tags()->sync($tagIds);
            }
            if (isset($colorIds)) {
                $product->colors()->sync($colorIds);
            }
            DB::commit();
        } catch (\Exception $exceprion) {
            DB::rollBack();
            abort(500);
        }

        return $product;
    }
}
