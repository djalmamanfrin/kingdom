<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $casts = ['date' => 'Timestamp'];
    protected $fillable = ['user_id', 'category_id', 'is_service', 'is_active', 'value', 'sale_value', 'quantity'];

    public function user(): User
    {
        $collection = $this->belongsTo(User::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('User collection is empty', 422);
        }
        return $collection->get(0);
    }

    public function category(): Category
    {
        $collection = $this->belongsTo(Category::class)->get();
        if ($collection->isEmpty()) {
            throw new InvalidArgumentException('Category collection is empty', 422);
        }
        return $collection->get(0);
    }

    public function projectView()
    {
        $product = parent::toArray();
        unset($product['user_id']);
        unset($product['category_id']);
        $product['category'] = $this->category()->name;
        return $product;
    }
}
