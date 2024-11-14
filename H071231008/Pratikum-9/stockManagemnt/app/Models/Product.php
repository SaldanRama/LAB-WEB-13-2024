<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'stock'
    ];

    public function Category(): BelongsTo
    {
        return $this->BelongsTo(Categories::class,'category_id');
    }

    public function InventoryLog()
    {
        return $this->hasMany(inventoryLog::class, 'product_id');
    }
}
