<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'default_quantity',
        'max_quantity',
        'tax_category',
        'image_url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'default_quantity' => 'integer',
        'max_quantity' => 'integer',
    ];

    // يمكنك إزالة الـ client relationship إذا لم تعد تحتاجها
    // أو الاحتفاظ بها إذا كنت ستضيفها لاحقاً

    // public function client()
    // {
    //     return $this->belongsTo(Client::class);
    // }
}
