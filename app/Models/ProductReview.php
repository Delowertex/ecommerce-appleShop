<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $table = 'product_reviews';
    public function profile(): BelongsTo
    {
        return $this->belongsTo(CustomerProfile::class,'customer_id');
    }
    protected $fillable = ['description','rating','customer_id','product_id'];
}
