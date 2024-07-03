<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $guarded = false;

    public function getImageFileUrlAttribute()
    {
        return url('storage/' . $this->file_path);
    }
}
