<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryLog extends Model
{

    protected $fillable = [
        'type',
        'product_id',
        'quantity',
        'created_at'
    ];

    use HasFactory;
    
    public function Product(): BelongsTo
    {

        return $this->BelongsTo(Product::class,'product_id');
    }
    
}
