<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

//    protected $attributes = [
//        'item_name',
//        'rod_diameter',
//        'unit_weight',
//        'unit_price',
//        'quantity',
//        'total',
//        "uuid"
//    ];


    protected $fillable = [
        'item_name',
        'rod_diameter',
        'unit_weight',
        'unit_price',
        'quantity',
        'total',
        "uuid"
    ];
}
