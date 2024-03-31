<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $fillable = [
      'stage_names'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
//        'tax_type' => TaxType::class
    ];
}
